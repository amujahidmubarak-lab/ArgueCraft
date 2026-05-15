<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SimulationResult;
use App\Models\InteractiveSession;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $standardResults = SimulationResult::where('user_id', $userId)->get();
        $interactiveResults = InteractiveSession::where('user_id', $userId)->get();

        $totalSimulations = $standardResults->count() + $interactiveResults->count();
        
        $allScores = collect();
        $allScores = $allScores->merge($standardResults->pluck('total_score'));
        $allScores = $allScores->merge($interactiveResults->pluck('total_score'));

        $avgScore = $allScores->count() > 0 ? round($allScores->average()) : 0;
        $highestScore = $allScores->count() > 0 ? $allScores->max() : 0;

        return view('dashboard', [
            'totalSimulations' => $totalSimulations,
            'avgScore' => $avgScore,
            'highestScore' => $highestScore
        ]);
    }

    public function stats()
    {
        $userId = Auth::id();

        // Standard Simulation Stats
        $standardResults = SimulationResult::where('user_id', $userId)->orderBy('created_at', 'asc')->get();
        // Interactive Session Stats
        $interactiveResults = InteractiveSession::where('user_id', $userId)->orderBy('created_at', 'asc')->get();

        $totalSimulations = $standardResults->count() + $interactiveResults->count();
        
        $allScores = collect();
        $allScores = $allScores->merge($standardResults->pluck('total_score'));
        $allScores = $allScores->merge($interactiveResults->pluck('total_score'));

        $avgScore = $allScores->count() > 0 ? round($allScores->average()) : 0;
        $highestScore = $allScores->count() > 0 ? $allScores->max() : 0;

        // Prepare Chart Data
        $combinedHistory = collect();
        foreach($standardResults as $r) {
            $combinedHistory->push(['date' => $r->created_at, 'score' => $r->total_score, 'type' => 'Standard']);
        }
        foreach($interactiveResults as $r) {
            $combinedHistory->push(['date' => $r->created_at, 'score' => $r->total_score, 'type' => 'Interactive']);
        }

        $chartData = $combinedHistory->sortBy('date')->take(-10)->values();
        $labels = $chartData->map(function($item, $index) { return 'Sesi ' . ($index + 1); });
        $scores = $chartData->map(function($item) { return $item['score']; });

        return view('statistics', [
            'totalSimulations' => $totalSimulations,
            'avgScore' => $avgScore,
            'highestScore' => $highestScore,
            'chartLabels' => $labels,
            'chartScores' => $scores,
            'recentHistory' => $combinedHistory->sortByDesc('date')->take(5)
        ]);
    }
}
