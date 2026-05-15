<?php

namespace App\Services;

class EvaluationService
{
    private $phases = [
        1 => ['name' => 'Opening'],
        2 => ['name' => 'Challenge'],
        3 => ['name' => 'Rebuttal'],
        4 => ['name' => 'Defense'],
        5 => ['name' => 'Closing']
    ];

    public function evaluateArgumentText($text, $position, $topicModel, $phaseNum)
    {
        $hasReason = false;
        foreach (['karena', 'sebab', 'alasan', 'dikarenakan', 'akibatnya', 'oleh karena itu'] as $word) {
            if (stripos($text, $word) !== false) { $hasReason = true; break; }
        }

        $hasExample = false;
        foreach (['contoh', 'misal', 'bukti', 'data', 'seperti', 'faktanya'] as $word) {
            if (stripos($text, $word) !== false) { $hasExample = true; break; }
        }

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

        $proKeywords = $topicModel->stance_keywords['pro'] ?? [];
        $kontraKeywords = $topicModel->stance_keywords['kontra'] ?? [];
        
        $proCount = 0; $usedProWords = [];
        foreach ($proKeywords as $word) { if (stripos($text, $word) !== false) { $proCount++; $usedProWords[] = $word; } }
        
        $kontraCount = 0; $usedKontraWords = [];
        foreach ($kontraKeywords as $word) { if (stripos($text, $word) !== false) { $kontraCount++; $usedKontraWords[] = $word; } }

        $isConsistent = true;
        $contradiction = false;
        if ($position == 'pro' && $kontraCount > $proCount + 1) { $isConsistent = false; $contradiction = true; }
        if ($position == 'kontra' && $proCount > $kontraCount + 1) { $isConsistent = false; $contradiction = true; }

        $keywordCount = ($position == 'pro') ? $proCount : $kontraCount;

        $phaseScore = 0;
        // Bonus for keyword usage (Max 30)
        $phaseScore += min(30, $keywordCount * 15);

        // Logic and Examples (Max 40)
        if ($hasReason) $phaseScore += 20;
        if ($hasExample) $phaseScore += 20;

        // Length (Max 15)
        $len = strlen(trim($text));
        $phaseScore += min(15, $len > 150 ? 15 : ($len > 80 ? 10 : 5));

        // Connectives (Max 15)
        $phaseScore += min(15, $usedTypes * 7.5);
        
        $phaseScore = min(100, (int) round($phaseScore));

        $status = 'Lemah';
        if ($phaseScore >= 70) $status = 'Kuat';
        elseif ($phaseScore >= 40) $status = 'Cukup';

        // Quality Level Determination
        $quality_level = 3;
        if (strlen(trim($text)) < 40 || ($proCount + $kontraCount == 0)) {
            $quality_level = 1;
        } elseif (!$hasReason && !$hasExample) {
            $quality_level = 2;
        }

        // Enhanced Rebuttal Analysis
        $rebuttal_feedback = null;
        if ($phaseNum == 3 && $quality_level > 1) {
            $opponentArg = $topicModel->opponent_arguments[$position == 'pro' ? 'kontra' : 'pro'][3] ?? '';
            $oppWords = array_filter(explode(' ', strtolower(preg_replace('/[^a-z\s]/i', '', $opponentArg))), fn($w) => strlen($w) > 4);
            $hitCount = 0;
            foreach ($oppWords as $ow) { if (stripos($text, $ow) !== false) $hitCount++; }
            
            if ($hitCount == 0 && strlen($opponentArg) > 10) {
                $rebuttal_feedback = "Bantahan belum secara langsung menjawab inti argumen lawan (kurang mengaitkan substansi).";
            } else {
                $rebuttal_feedback = "Bantahan sudah terarah dan menyasar pada poin utama argumen lawan.";
            }
        }

        return [
            'phase' => $this->phases[$phaseNum]['name'] ?? 'Phase ' . $phaseNum,
            'text' => $text,
            'has_reason' => $hasReason,
            'has_example' => $hasExample,
            'connective_variety' => $usedTypes,
            'is_consistent' => $isConsistent,
            'contradiction' => $contradiction,
            'is_off_topic' => ($proCount + $kontraCount == 0),
            'length' => strlen(trim($text)),
            'score' => $phaseScore,
            'status' => $status,
            'quality_level' => $quality_level,
            'used_keywords' => $position == 'pro' ? $usedProWords : $usedKontraWords,
            'rebuttal_feedback' => $rebuttal_feedback
        ];
    }
}
