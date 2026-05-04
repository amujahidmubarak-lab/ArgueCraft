<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SimulationTopic;
use App\Models\SimulationResult;
use Illuminate\Support\Facades\Auth;

class SimulationController extends Controller
{
    private $phases = [
        1 => ['name' => 'Opening', 'instruction' => 'Tuliskan argumen pembuka Anda. Berikan klaim utama beserta alasannya.'],
        2 => ['name' => 'Challenge', 'instruction' => 'Sistem: "Bisa Anda jelaskan lebih detail dengan contoh nyata yang mendukung klaim tersebut?"'],
        3 => ['name' => 'Rebuttal', 'instruction' => 'Sistem (Argumen Lawan): "Tetapi, hal tersebut memiliki dampak negatif yang signifikan terhadap biaya atau efisiensi." Bantah argumen ini!'],
        4 => ['name' => 'Defense', 'instruction' => 'Sistem: "Bukankah solusi alternatif lebih masuk akal?" Pertahankan argumen Anda dan tunjukkan mengapa solusi Anda tetap yang terbaik.'],
        5 => ['name' => 'Closing', 'instruction' => 'Tuliskan kesimpulan penutup untuk menegaskan kembali posisi Anda secara kuat.']
    ];

    public function setup()
    {
        session()->forget(['sim_topic_id', 'sim_topic', 'sim_position', 'sim_answers', 'sim_phase', 'sim_topic_key', 'sim_mode', 'sim_chat']);
        $topics = SimulationTopic::where('is_active', true)->get();
        return view('simulation.setup', ['topics' => $topics]);
    }

    public function interactiveSetup()
    {
        session()->forget(['sim_topic_id', 'sim_topic', 'sim_position', 'sim_answers', 'sim_phase', 'sim_topic_key', 'sim_mode', 'sim_chat']);
        $topics = SimulationTopic::where('is_active', true)->get();
        return view('simulation.interactive_setup', ['topics' => $topics]);
    }

    public function interactiveStart(Request $request)
    {
        $request->validate([
            'topic' => 'required|exists:simulation_topics,slug',
            'position' => 'required|in:pro,kontra'
        ]);

        $topic = SimulationTopic::where('slug', $request->topic)->first();
        $opponentRole = $request->position == 'pro' ? 'KONTRA' : 'PRO';

        $chat = [
            [
                'sender' => 'system',
                'message' => "Halo! Saya akan menjadi lawan debat Anda hari ini. Mosi kita adalah: " . $topic->title . ". Anda berada di posisi " . strtoupper($request->position) . ", sedangkan saya " . $opponentRole . ". Silakan sampaikan Opening Statement (Argumen Pembuka) Anda terlebih dahulu."
            ]
        ];

        session([
            'sim_mode' => 'interactive',
            'sim_topic_id' => $topic->id,
            'sim_topic_key' => $topic->slug,
            'sim_topic' => $topic->title,
            'sim_position' => $request->position,
            'sim_phase' => 1,
            'sim_answers' => [],
            'sim_chat' => $chat
        ]);

        return redirect()->route('simulation.interactive.chat');
    }

    public function interactiveChat()
    {
        $chat = session('sim_chat');
        if (!$chat) return redirect()->route('simulation.interactive.setup');

        return view('simulation.interactive', [
            'chat' => $chat,
            'phaseNum' => session('sim_phase'),
            'topic' => session('sim_topic'),
            'position' => session('sim_position')
        ]);
    }

    public function interactiveSubmit(Request $request)
    {
        $request->validate(['argument' => 'required|string|min:50']);

        $phaseNum = session('sim_phase');
        $chat = session('sim_chat');
        $answers = session('sim_answers');
        $topicKey = session('sim_topic_key');
        $position = session('sim_position');
        
        $topicModel = SimulationTopic::where('slug', $topicKey)->first();

        // Add user message
        $chat[] = ['sender' => 'user', 'message' => $request->argument];

        $text = $request->argument;
        $hasReason = false;
        foreach (['karena', 'sebab', 'alasan'] as $word) if (stripos($text, $word) !== false) $hasReason = true;
        
        $hasExample = false;
        foreach (['contoh', 'bukti', 'fakta'] as $word) if (stripos($text, $word) !== false) $hasExample = true;

        $proKeywords = $topicModel->stance_keywords['pro'] ?? [];
        $kontraKeywords = $topicModel->stance_keywords['kontra'] ?? [];
        
        $proCount = 0; foreach ($proKeywords as $word) if (stripos($text, $word) !== false) $proCount++;
        $kontraCount = 0; foreach ($kontraKeywords as $word) if (stripos($text, $word) !== false) $kontraCount++;
        $isConsistent = ($position == 'pro' ? $proCount >= $kontraCount : $kontraCount >= $proCount);

        $answers[$phaseNum] = [
            'phase' => $this->phases[$phaseNum]['name'],
            'text' => $text,
            'has_reason' => $hasReason,
            'has_example' => $hasExample,
            'is_consistent' => $isConsistent,
            'is_off_topic' => ($proCount + $kontraCount == 0),
            'length' => strlen($text)
        ];

        $nextPhase = $phaseNum + 1;
        if ($nextPhase <= 5) {
            $opponentArguments = $topicModel->opponent_arguments ?? [];
            $opponentResponse = $opponentArguments[$position][$phaseNum] ?? "Tanggapan yang menarik. Silakan lanjutkan argumen Anda.";
            $opponentRole = $position == 'pro' ? 'KONTRA' : 'PRO';

            $chat[] = [
                'sender' => 'system',
                'message' => "Lawan Debat (" . $opponentRole . "): " . $opponentResponse
            ];
            session(['sim_phase' => $nextPhase, 'sim_chat' => $chat, 'sim_answers' => $answers]);
            return redirect()->route('simulation.interactive.chat');
        } else {
            session(['sim_answers' => $answers]);
            return redirect()->route('simulation.result');
        }
    }

    public function start(Request $request)
    {
        $request->validate([
            'topic' => 'required|exists:simulation_topics,slug',
            'position' => 'required|in:pro,kontra'
        ]);

        $topic = SimulationTopic::where('slug', $request->topic)->first();

        session([
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

        return view('simulation.phase', [
            'topic' => session('sim_topic'),
            'position' => session('sim_position'),
            'phase' => $this->phases[$phaseNum],
            'phaseNum' => $phaseNum,
            'totalPhases' => count($this->phases)
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
        $text = $request->argument;
        $topicModel = SimulationTopic::where('slug', $topicKey)->first();

        // 1. Structure Analysis
        $hasReason = false;
        foreach (['karena', 'sebab', 'alasan', 'dikarenakan', 'akibatnya', 'oleh karena itu'] as $word) {
            if (stripos($text, $word) !== false) { $hasReason = true; break; }
        }

        $hasExample = false;
        foreach (['contoh', 'misal', 'bukti', 'data', 'seperti', 'faktanya'] as $word) {
            if (stripos($text, $word) !== false) { $hasExample = true; break; }
        }

        // 2. Logic Connectives
        $connectives = [
            'contrast' => ['namun', 'tetapi', 'sebaliknya', 'padahal', 'disisi lain'],
            'addition' => ['selain itu', 'bahkan', 'juga', 'serta', 'tambah', 'lagi pula'],
            'conclusion' => ['maka', 'jadi', 'akhirnya', 'sehingga', 'kesimpulannya']
        ];
        
        $usedTypes = 0;
        foreach ($connectives as $type => $words) {
            foreach ($words as $word) {
                if (stripos($text, $word) !== false) { $usedTypes++; break; }
            }
        }

        // 3. Stance Analysis
        $proKeywords = $topicModel->stance_keywords['pro'] ?? [];
        $kontraKeywords = $topicModel->stance_keywords['kontra'] ?? [];
        
        $proCount = 0; foreach ($proKeywords as $word) { if (stripos($text, $word) !== false) $proCount++; }
        $kontraCount = 0; foreach ($kontraKeywords as $word) { if (stripos($text, $word) !== false) $kontraCount++; }

        $isConsistent = true;
        if ($position == 'pro' && $kontraCount > $proCount + 1) $isConsistent = false;
        if ($position == 'kontra' && $proCount > $kontraCount + 1) $isConsistent = false;

        $answers[$phaseNum] = [
            'phase' => $this->phases[$phaseNum]['name'],
            'text' => $text,
            'has_reason' => $hasReason,
            'has_example' => $hasExample,
            'connective_variety' => $usedTypes,
            'is_consistent' => $isConsistent,
            'is_off_topic' => ($proCount + $kontraCount == 0),
            'length' => strlen($text)
        ];

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

        foreach ($answers as $num => $ans) {
            $phaseScore = 0;
            if ($ans['has_reason']) { $scores['struktur'] += 3; $phaseScore += 3; }
            if ($ans['has_example']) { $scores['struktur'] += 3; $phaseScore += 3; }

            $lenScore = $ans['length'] > 200 ? 5 : ($ans['length'] > 120 ? 3 : 1);
            $scores['kedalaman'] += $lenScore; $phaseScore += $lenScore;

            if ($ans['is_consistent']) { $scores['konsistensi'] += 5; $phaseScore += 5; }

            $varScore = min(4, ($ans['connective_variety'] ?? 0) * 1.5);
            $scores['variasi_logika'] += $varScore; $phaseScore += $varScore;

            $phasePerformances[$num] = ['name' => $ans['phase'], 'score' => $phaseScore];
        }

        uasort($phasePerformances, function($a, $b) { return $b['score'] <=> $a['score']; });
        $strongest = reset($phasePerformances);
        $weakest = end($phasePerformances);

        $totalScore = min(100, array_sum($scores));
        
        $offTopicCount = 0;
        foreach ($answers as $ans) { if ($ans['is_off_topic'] ?? false) $offTopicCount++; }

        if ($totalScore >= 85) $feedbackParts[] = "Luar biasa! Performa Anda menunjukkan kualitas debater tingkat lanjut.";
        elseif ($totalScore >= 70) $feedbackParts[] = "Bagus! Anda sudah memahami dasar-dasar dengan baik.";
        else $feedbackParts[] = "Teruslah berlatih untuk membangun argumen yang lebih kokoh.";

        $feedbackParts[] = "Analisis: Anda paling kuat pada fase " . $strongest['name'] . ", namun performa di fase " . $weakest['name'] . " masih bisa ditingkatkan lagi.";
        
        if ($offTopicCount > 0) {
            $feedbackParts[] = "⚠️ PENTING: Ada " . $offTopicCount . " fase di mana jawaban Anda terdeteksi TIDAK RELEVAN dengan topik. Pastikan argumen Anda menggunakan kata kunci yang berkaitan dengan mosi.";
            $totalScore = max(0, $totalScore - ($offTopicCount * 15)); // Penalty for off-topic
        }

        if ($scores['variasi_logika'] < 10) $feedbackParts[] = "Saran: Gunakan lebih banyak variasi kata hubung seperti 'namun', 'selain itu', atau 'maka dari itu' untuk memperlancar alur logika Anda.";
        if ($scores['konsistensi'] < 20 && $offTopicCount == 0) $feedbackParts[] = "Saran: Beberapa poin argumen Anda terdeteksi melenceng dari posisi " . strtoupper(session('sim_position')) . " yang seharusnya.";

        // SAVE RESULT TO DATABASE IF AUTHENTICATED
        if (Auth::check() && session()->has('sim_topic_id')) {
            SimulationResult::create([
                'user_id' => Auth::id(),
                'topic_id' => session('sim_topic_id'),
                'total_score' => round($totalScore),
                'details' => $answers
            ]);
        }

        return view('simulation.result', [
            'topic' => session('sim_topic'),
            'position' => session('sim_position'),
            'answers' => $answers,
            'score' => round($totalScore),
            'scores' => $scores,
            'strongest' => $strongest,
            'weakest' => $weakest,
            'feedback' => implode(" ", $feedbackParts)
        ]);
    }
}
