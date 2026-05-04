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

    public function topics()
    {
        $topics = SimulationTopic::all();
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

        SimulationTopic::create([
            'slug' => $request->slug,
            'title' => $request->title,
            'difficulty' => $request->difficulty,
            'is_active' => $request->has('is_active'),
            // Default empty json for now to keep form simple
            'stance_keywords' => ['pro' => [], 'kontra' => []],
            'opponent_arguments' => ['pro' => [], 'kontra' => []],
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

        $topic->update([
            'slug' => $request->slug,
            'title' => $request->title,
            'difficulty' => $request->difficulty,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.topics.index')->with('success', 'Topik berhasil diperbarui.');
    }

    public function topicDestroy(SimulationTopic $topic)
    {
        $topic->delete();
        return redirect()->route('admin.topics.index')->with('success', 'Topik berhasil dihapus.');
    }


    // --- RESULTS & USERS ---

    public function results()
    {
        $results = SimulationResult::with(['user', 'topic'])->latest()->get();
        return view('admin.results.index', compact('results'));
    }

    public function users()
    {
        $users = User::withCount('simulationResults')->get();
        return view('admin.users.index', compact('users'));
    }
}
