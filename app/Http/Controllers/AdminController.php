<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LearningModule;
use App\Models\SimulationTopic;
use App\Models\SimulationResult;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'users' => User::count(),
            'modules' => LearningModule::count(),
            'simulations' => SimulationResult::count(),
            'top_topic' => SimulationTopic::first()->title ?? 'Belum ada data'
        ];

        return view('admin.dashboard', compact('stats'));
    }

    // --- LEARNING MODULES CRUD ---

    public function modules()
    {
        $modules = LearningModule::all();
        return view('admin.modules.index', compact('modules'));
    }

    public function moduleCreate()
    {
        return view('admin.modules.form');
    }

    public function moduleStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'badge_icon' => 'required|string',
            'badge_color' => 'required|string',
            'sections' => 'required|json',
        ]);

        LearningModule::create([
            'title' => $request->title,
            'description' => $request->description,
            'badge_icon' => $request->badge_icon,
            'badge_color' => $request->badge_color,
            'sections' => json_decode($request->sections, true),
        ]);

        return redirect()->route('admin.modules.index')->with('success', 'Modul berhasil ditambahkan.');
    }

    public function moduleEdit(LearningModule $module)
    {
        return view('admin.modules.form', compact('module'));
    }

    public function moduleUpdate(Request $request, LearningModule $module)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'badge_icon' => 'required|string',
            'badge_color' => 'required|string',
            'sections' => 'required|json',
        ]);

        $module->update([
            'title' => $request->title,
            'description' => $request->description,
            'badge_icon' => $request->badge_icon,
            'badge_color' => $request->badge_color,
            'sections' => json_decode($request->sections, true),
        ]);

        return redirect()->route('admin.modules.index')->with('success', 'Modul berhasil diperbarui.');
    }

    public function moduleDestroy(LearningModule $module)
    {
        $module->delete();
        return redirect()->route('admin.modules.index')->with('success', 'Modul berhasil dihapus.');
    }


    // --- SIMULATION TOPICS CRUD ---

    public function topics(Request $request)
    {
        $query = SimulationTopic::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('difficulty')) {
            $query->where('difficulty', $request->difficulty);
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status == 'active');
        }

        $topics = $query->latest()->get();
        return view('admin.topics.index', compact('topics'));
    }

    public function topicCreate()
    {
        return view('admin.topics.form');
    }

    public function topicStore(Request $request)
    {
        $request->validate([
            'slug' => 'required|string|unique:simulation_topics,slug',
            'title' => 'required|string|max:255',
            'difficulty' => 'required|in:easy,medium,hard',
            'is_active' => 'boolean',
        ]);

        $stance_keywords = [
            'pro' => array_values(array_filter(array_map('trim', explode(',', $request->input('stance_keywords.pro', ''))))),
            'kontra' => array_values(array_filter(array_map('trim', explode(',', $request->input('stance_keywords.kontra', '')))))
        ];

        SimulationTopic::create([
            'slug' => $request->slug,
            'title' => $request->title,
            'difficulty' => $request->difficulty,
            'is_active' => $request->has('is_active'),
            'stance_keywords' => $stance_keywords,
            'opponent_arguments' => $request->input('opponent_arguments', ['pro' => [], 'kontra' => []]),
            'example_arguments' => $request->input('example_arguments', ['pro' => [], 'kontra' => []]),
        ]);

        return redirect()->route('admin.topics.index')->with('success', 'Topik berhasil ditambahkan.');
    }

    public function topicEdit(SimulationTopic $topic)
    {
        return view('admin.topics.form', compact('topic'));
    }

    public function topicUpdate(Request $request, SimulationTopic $topic)
    {
        $request->validate([
            'slug' => 'required|string|unique:simulation_topics,slug,' . $topic->id,
            'title' => 'required|string|max:255',
            'difficulty' => 'required|in:easy,medium,hard',
            'is_active' => 'boolean',
        ]);

        $stance_keywords = [
            'pro' => array_values(array_filter(array_map('trim', explode(',', $request->input('stance_keywords.pro', ''))))),
            'kontra' => array_values(array_filter(array_map('trim', explode(',', $request->input('stance_keywords.kontra', '')))))
        ];

        $topic->update([
            'slug' => $request->slug,
            'title' => $request->title,
            'difficulty' => $request->difficulty,
            'is_active' => $request->has('is_active'),
            'stance_keywords' => $stance_keywords,
            'opponent_arguments' => $request->input('opponent_arguments', ['pro' => [], 'kontra' => []]),
            'example_arguments' => $request->input('example_arguments', ['pro' => [], 'kontra' => []]),
        ]);

        return redirect()->route('admin.topics.index')->with('success', 'Topik berhasil diperbarui.');
    }

    public function topicDestroy(SimulationTopic $topic)
    {
        $topic->delete();
        return redirect()->route('admin.topics.index')->with('success', 'Topik berhasil dihapus.');
    }


    // --- RESULTS & USERS ---

    public function results(Request $request)
    {
        $query = SimulationResult::with(['user', 'topic']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($uq) use ($search) {
                    $uq->where('name', 'like', '%' . $search . '%');
                })->orWhereHas('topic', function($tq) use ($search) {
                    $tq->where('title', 'like', '%' . $search . '%');
                });
            });
        }

        if ($request->filled('stance')) {
            $query->where('stance', $request->stance);
        }

        $sort = $request->input('sort', 'latest');
        if ($sort == 'highest_score') {
            $query->orderBy('total_score', 'desc');
        } elseif ($sort == 'lowest_score') {
            $query->orderBy('total_score', 'asc');
        } elseif ($sort == 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->latest();
        }

        $results = $query->get();
        return view('admin.results.index', compact('results'));
    }

    public function users(Request $request)
    {
        $query = User::withCount('simulationResults');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $sort = $request->input('sort', 'newest');
        if ($sort == 'most_simulations') {
            $query->orderBy('simulation_results_count', 'desc');
        } elseif ($sort == 'least_simulations') {
            $query->orderBy('simulation_results_count', 'asc');
        } elseif ($sort == 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $users = $query->get();
        return view('admin.users.index', compact('users'));
    }
}
