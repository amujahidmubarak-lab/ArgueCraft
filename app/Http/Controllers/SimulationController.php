<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SimulationTopic;
use App\Models\SimulationResult;
use App\Models\SimulationPhaseResult;
use App\Services\EvaluationService;
use Illuminate\Support\Facades\Auth;

class SimulationController extends Controller
{
    private $evalService;

    public function __construct(EvaluationService $evalService)
    {
        $this->evalService = $evalService;
    }

    private $phases = [
        1 => ['name' => 'Opening', 'instruction' => 'Tuliskan argumen pembuka Anda. Berikan klaim utama beserta alasannya.'],
        2 => ['name' => 'Challenge', 'instruction' => 'Sistem: "Bisa Anda jelaskan lebih detail dengan contoh nyata yang mendukung klaim tersebut?"'],
        3 => ['name' => 'Rebuttal', 'instruction' => 'Sistem (Argumen Lawan): "Tetapi, hal tersebut memiliki dampak negatif yang signifikan terhadap biaya atau efisiensi." Bantah argumen ini!'],
        4 => ['name' => 'Defense', 'instruction' => 'Sistem: "Bukankah solusi alternatif lebih masuk akal?" Pertahankan argumen Anda dan tunjukkan mengapa solusi Anda tetap yang terbaik.'],
        5 => ['name' => 'Closing', 'instruction' => 'Tuliskan kesimpulan penutup untuk menegaskan kembali posisi Anda secara kuat.']
    ];

    public function setup()
    {
        session()->forget(['sim_topic_id', 'sim_topic', 'sim_position', 'sim_answers', 'sim_phase', 'sim_topic_key', 'sim_result_id']);
        $topics = SimulationTopic::where('is_active', true)->get();
        return view('simulation.setup', ['topics' => $topics]);
    }

    public function start(Request $request)
    {
        $request->validate([
            'topic' => 'required|exists:simulation_topics,slug',
            'position' => 'required|in:pro,kontra'
        ]);

        $topic = SimulationTopic::where('slug', $request->topic)->first();

        $result = SimulationResult::create([
            'user_id' => Auth::id(),
            'topic_id' => $topic->id,
            'stance' => $request->position,
            'total_score' => 0
        ]);

        session([
            'sim_result_id' => $result->id,
            'sim_topic_id' => $topic->id,
            'sim_topic_key' => $topic->slug,
            'sim_topic' => $topic->title,
            'sim_position' => $request->position,
            'sim_phase' => 1,
            'sim_answers' => []
        ]);

        return redirect()->route('simulation.phase');
    }

    public function phase()
    {
        $phaseNum = session('sim_phase');
        if (!$phaseNum) {
            return redirect()->route('simulation.setup');
        }

        if ($phaseNum > 5) {
            return redirect()->route('simulation.result');
        }

        $topicModel = SimulationTopic::where('slug', session('sim_topic_key'))->first();
        $exampleText = $topicModel->example_arguments[session('sim_position')][$phaseNum] ?? null;

        return view('simulation.phase', [
            'topic' => session('sim_topic'),
            'position' => session('sim_position'),
            'phase' => $this->phases[$phaseNum],
            'phaseNum' => $phaseNum,
            'totalPhases' => count($this->phases),
            'exampleText' => $exampleText,
            'keywords' => $topicModel->stance_keywords[session('sim_position')] ?? []
        ]);
    }

    public function submitPhase(Request $request)
    {
        $request->validate([
            'argument' => 'required|string|min:50'
        ]);

        $answers = session('sim_answers', []);
        $phaseNum = session('sim_phase');
        $topicKey = session('sim_topic_key');
        $position = session('sim_position');
        $resultId = session('sim_result_id');

        if (!$phaseNum || !isset($this->phases[$phaseNum]) || !$resultId) {
            return redirect()->route('simulation.setup');
        }

        $text = $request->argument;
        $topicModel = SimulationTopic::where('slug', $topicKey)->first();
        
        $eval = $this->evalService->evaluateArgumentText($text, $position, $topicModel, $phaseNum);
        $answers[$phaseNum] = $eval;

        SimulationPhaseResult::create([
            'simulation_result_id' => session('sim_result_id'),
            'phase_name' => $this->phases[$phaseNum]['name'],
            'user_argument' => $text,
            'score' => $eval['score'],
            'feedback' => json_encode($eval),
            'relevance_status' => $eval['status']
        ]);

        session(['sim_answers' => $answers, 'sim_phase' => $phaseNum + 1]);

        if ($phaseNum >= 5) {
            return redirect()->route('simulation.result');
        }
        return redirect()->route('simulation.phase');
    }

    public function result()
    {
        $answers = session('sim_answers');
        if (!$answers) {
            return redirect()->route('simulation.setup');
        }

        $scores = ['struktur' => 0, 'kedalaman' => 0, 'konsistensi' => 0, 'variasi_logika' => 0];
        $phasePerformances = [];

        $allUsedKeywords = [];
        $contradictionCount = 0;
        $totalQualityScore = 0;

        foreach ($answers as $num => $ans) {
            $phaseScore = $ans['score'] ?? 0;
            $totalQualityScore += ($ans['quality_level'] ?? 1);
            $keywordCount = count($ans['used_keywords'] ?? []);
            
            $strukturScore = 0;
            if ($ans['has_reason']) $strukturScore += 2.5;
            if ($ans['has_example']) $strukturScore += 2.5;
            $strukturScore += min(3, $keywordCount * 1.5);
            $scores['struktur'] += min(6, $strukturScore);

            $lenScore = $ans['length'] > 150 ? 5 : ($ans['length'] > 80 ? 3 : 1);
            $lenScore += min(2, $keywordCount);
            $scores['kedalaman'] += min(5, $lenScore);

            if ($ans['is_consistent']) $scores['konsistensi'] += 5;

            $varScore = min(4, ($ans['connective_variety'] ?? 0) * 1.5);
            if ($varScore == 0 && $keywordCount > 0) $varScore = 2;
            $scores['variasi_logika'] += min(4, $varScore);

            $phasePerformances[$num] = ['name' => $ans['phase'], 'score' => $phaseScore, 'status' => $ans['status'] ?? 'Lemah'];
            
            $allUsedKeywords = array_merge($allUsedKeywords, $ans['used_keywords'] ?? []);
            if ($ans['contradiction'] ?? false) $contradictionCount++;
        }

        $overallQuality = round($totalQualityScore / count($answers));

        uasort($phasePerformances, function($a, $b) { return $b['score'] <=> $a['score']; });
        $strongest = reset($phasePerformances);
        $weakest = end($phasePerformances);

        // If all phases are low quality, don't show strongest
        $isUniformlyLow = true;
        foreach($phasePerformances as $p) { if($p['score'] > 40) $isUniformlyLow = false; }
        if($isUniformlyLow) {
            $strongest = ['name' => 'Belum ada fase yang menonjol', 'score' => 0];
        }

        $totalScore = min(100, array_sum($scores));

        $topicModel = SimulationTopic::where('slug', session('sim_topic_key'))->first();
        $progressFeedback = "";

        $feedbackParts = [];
        
        if ($overallQuality == 1) {
            $feedbackParts[] = "Maaf, argumen Anda belum dapat dianalisis secara mendalam. Jawaban terdeteksi sangat singkat atau tidak relevan dengan topik debat. Cobalah menulis argumen yang lebih jelas dan terstruktur di sesi berikutnya.";
        } elseif ($overallQuality == 2) {
            $feedbackParts[] = "Performa dasar yang cukup baik. Anda sudah mulai menggunakan alasan, namun argumen Anda masih bisa diperkuat dengan data atau contoh nyata agar lebih meyakinkan.";
            $feedbackParts[] = "Fase terkuat Anda adalah " . $strongest['name'] . ".";
        } else {
            $feedbackParts[] = "Luar biasa! Argumen Anda sangat terstruktur dan meyakinkan. Anda menunjukkan kualitas seorang debater yang kritis dan mampu mempertahankan posisi dengan baik.";
            $feedbackParts[] = "Analisis mendalam menunjukkan Anda paling unggul pada fase " . $strongest['name'] . ".";
        }

        if ($overallQuality > 1 && $contradictionCount > 0) {
            $feedbackParts[] = "Catatan: Tetap konsisten pada posisi Anda agar tidak mudah dipatahkan lawan.";
        }

        $allUsedKeywords = array_unique($allUsedKeywords);
        $targetKeywords = $topicModel->stance_keywords[session('sim_position')] ?? [];
        $missingKeywords = array_diff($targetKeywords, $allUsedKeywords);

        if ($overallQuality > 1 && count($missingKeywords) > 0) {
            $suggested = array_slice($missingKeywords, 0, 3);
            $feedbackParts[] = "💡 Tips: Gunakan istilah kunci seperti '" . implode("', '", $suggested) . "' untuk memperkuat relevansi materi.";
        }

        $feedbackStr = implode(" ", $feedbackParts);

        // UPDATE RESULT
        if (session()->has('sim_result_id')) {
            $result = SimulationResult::find(session('sim_result_id'));
            if ($result) {
                $result->update([
                    'total_score' => round($totalScore),
                    'feedback_summary' => $feedbackStr
                ]);
            }
        }

        return view('simulation.result', [
            'topic' => session('sim_topic'),
            'position' => session('sim_position'),
            'answers' => $answers,
            'score' => round($totalScore),
            'scores' => $scores,
            'strongest' => $strongest,
            'weakest' => $weakest,
            'feedback' => $feedbackStr,
            'missingKeywords' => $missingKeywords,
            'overallQuality' => $overallQuality,
            'exampleArguments' => $topicModel->example_arguments[session('sim_position')] ?? [],
            'result_id' => session('sim_result_id'),
            'is_interactive' => false
        ]);
    }
}

