<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SimulationTopic;
use App\Models\InteractiveSession;
use App\Models\InteractiveMessage;
use App\Services\EvaluationService;
use Illuminate\Support\Facades\Auth;

class InteractiveSimulationController extends Controller
{
    private $evalService;

    public function __construct(EvaluationService $evalService)
    {
        $this->evalService = $evalService;
    }

    public function setup()
    {
        $topics = SimulationTopic::where('is_active', true)->get();
        return view('simulation.interactive_setup', ['topics' => $topics]);
    }

    public function start(Request $request)
    {
        $request->validate([
            'topic' => 'required|exists:simulation_topics,slug',
            'position' => 'required|in:pro,kontra',
            'mode' => 'required|in:normal,speed'
        ]);

        $topic = SimulationTopic::where('slug', $request->topic)->first();
        
        $session = InteractiveSession::create([
            'user_id' => Auth::id(),
            'topic_id' => $topic->id,
            'stance' => $request->position,
            'current_phase' => 1,
            'total_score' => 0,
            'mode' => $request->mode
        ]);

        $opponentRole = $request->position == 'pro' ? 'KONTRA' : 'PRO';
        $messageText = "Halo! Saya akan menjadi lawan debat Anda hari ini. Mosi kita adalah: " . $topic->title . ". Anda berada di posisi " . strtoupper($request->position) . ", sedangkan saya " . $opponentRole . ". Silakan sampaikan Opening Statement (Argumen Pembuka) Anda terlebih dahulu.";

        InteractiveMessage::create([
            'session_id' => $session->id,
            'sender_type' => 'system',
            'message' => $messageText,
            'phase' => 1
        ]);

        return redirect()->route('simulation.interactive.chat', ['session_id' => $session->id]);
    }

    public function chat($session_id)
    {
        $session = InteractiveSession::with(['topic', 'messages'])->findOrFail($session_id);
        
        // Ensure user owns session
        if ($session->user_id !== Auth::id()) abort(403);

        $phaseNum = $session->current_phase;
        $exampleText = $session->topic->example_arguments[$session->stance][$phaseNum] ?? null;

        // Transform messages for view compatibility
        $chat = $session->messages->map(function ($msg) {
            return [
                'sender' => $msg->sender_type,
                'message' => $msg->message
            ];
        })->toArray();

        return view('simulation.interactive', [
            'chat' => $chat,
            'phaseNum' => $phaseNum,
            'topic' => $session->topic->title,
            'position' => $session->stance,
            'exampleText' => $exampleText,
            'session_id' => $session->id,
            'mode' => $session->mode
        ]);
    }

    public function submit(Request $request, $session_id)
    {
        $request->validate(['argument' => 'required|string|min:50']);

        $session = InteractiveSession::with('topic')->findOrFail($session_id);
        if ($session->user_id !== Auth::id()) abort(403);

        $phaseNum = $session->current_phase;
        $position = $session->stance;
        $topicModel = $session->topic;
        
        $text = $request->argument;

        // Evaluate
        $eval = $this->evalService->evaluateArgumentText($text, $position, $topicModel, $phaseNum);

        // Save User Message
        InteractiveMessage::create([
            'session_id' => $session->id,
            'sender_type' => 'user',
            'message' => $text,
            'phase' => $phaseNum,
            'score' => $eval['score'],
            'feedback' => json_encode($eval), // Store detailed eval as JSON feedback for now
            'relevance_status' => $eval['status']
        ]);

        $nextPhase = $phaseNum + 1;
        
        if ($nextPhase <= 5) {
            $opponentArguments = $topicModel->opponent_arguments ?? [];
            $opponentResponse = $opponentArguments[$position][$phaseNum] ?? "Tanggapan yang menarik. Silakan lanjutkan argumen Anda.";
            $opponentRole = $position == 'pro' ? 'KONTRA' : 'PRO';

            InteractiveMessage::create([
                'session_id' => $session->id,
                'sender_type' => 'system',
                'message' => "Lawan Debat (" . $opponentRole . "): " . $opponentResponse,
                'phase' => $nextPhase
            ]);

            $session->update(['current_phase' => $nextPhase]);
            
            return redirect()->route('simulation.interactive.chat', ['session_id' => $session->id]);
        } else {
            // End of interactive debate
            $session->update(['current_phase' => 6]);
            // Maybe redirect to a specific interactive result page, or regular result
            return redirect()->route('simulation.interactive.result', ['session_id' => $session->id]);
        }
    }

    public function result($session_id)
    {
        $session = InteractiveSession::with(['topic', 'messages'])->findOrFail($session_id);
        if ($session->user_id !== Auth::id()) abort(403);

        // Calculate scores similar to standard simulation
        // For now, we will reuse the result.blade.php but pass reconstructed $answers
        $answers = [];
        $totalQualityScore = 0;
        $contradictionCount = 0;
        $scores = ['struktur' => 0, 'kedalaman' => 0, 'konsistensi' => 0, 'variasi_logika' => 0];
        $allUsedKeywords = [];
        $phasePerformances = [];

        foreach ($session->messages as $msg) {
            if ($msg->sender_type == 'user') {
                $ans = json_decode($msg->feedback, true);
                if ($ans) {
                    $answers[$msg->phase] = $ans;
                    
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

                    $phasePerformances[$msg->phase] = ['name' => $ans['phase'], 'score' => $phaseScore, 'status' => $ans['status'] ?? 'Lemah'];
                    
                    $allUsedKeywords = array_merge($allUsedKeywords, $ans['used_keywords'] ?? []);
                    if ($ans['contradiction'] ?? false) $contradictionCount++;
                }
            }
        }

        $overallQuality = count($answers) > 0 ? round($totalQualityScore / count($answers)) : 1;

        uasort($phasePerformances, function($a, $b) { return $b['score'] <=> $a['score']; });
        $strongest = count($phasePerformances) > 0 ? reset($phasePerformances) : ['name' => '-', 'score' => 0];
        $weakest = count($phasePerformances) > 0 ? end($phasePerformances) : ['name' => '-', 'score' => 0];

        $isUniformlyLow = true;
        foreach($phasePerformances as $p) { if($p['score'] > 40) $isUniformlyLow = false; }
        if($isUniformlyLow) {
            $strongest = ['name' => 'Belum ada fase yang menonjol', 'score' => 0];
        }

        $totalScore = min(100, array_sum($scores));

        $session->update(['total_score' => round($totalScore)]);

        $feedbackParts = [];
        if ($overallQuality == 1) {
            $feedbackParts[] = "Maaf, argumen Anda belum dapat dianalisis secara mendalam. Jawaban terdeteksi sangat singkat atau tidak relevan dengan topik debat.";
        } elseif ($overallQuality == 2) {
            $feedbackParts[] = "Performa dasar yang cukup baik. Anda sudah mulai menggunakan alasan, namun argumen Anda masih bisa diperkuat dengan data atau contoh nyata agar lebih meyakinkan.";
        } else {
            $feedbackParts[] = "Luar biasa! Argumen Anda sangat terstruktur dan meyakinkan. Anda menunjukkan kualitas seorang debater yang kritis dan mampu mempertahankan posisi dengan baik.";
        }

        $allUsedKeywords = array_unique($allUsedKeywords);
        $targetKeywords = $session->topic->stance_keywords[$session->stance] ?? [];
        $missingKeywords = array_diff($targetKeywords, $allUsedKeywords);

        return view('simulation.result', [
            'topic' => $session->topic->title,
            'position' => $session->stance,
            'answers' => $answers,
            'score' => round($totalScore),
            'scores' => $scores,
            'strongest' => $strongest,
            'weakest' => $weakest,
            'feedback' => implode(" ", $feedbackParts),
            'missingKeywords' => $missingKeywords,
            'overallQuality' => $overallQuality,
            'exampleArguments' => $session->topic->example_arguments[$session->stance] ?? [],
            'result_id' => $session->id,
            'is_interactive' => true
        ]);
    }
}
