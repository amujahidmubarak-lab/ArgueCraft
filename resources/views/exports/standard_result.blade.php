<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Simulasi - ArgueCraft</title>
    <style>
        body { font-family: sans-serif; color: #333; line-height: 1.6; }
        .header { text-align: center; border-bottom: 2px solid #E63946; padding-bottom: 20px; margin-bottom: 20px; }
        .title { color: #E63946; font-size: 24px; font-weight: bold; margin: 0; }
        .subtitle { font-size: 14px; color: #666; margin: 5px 0 0 0; }
        .info-table { width: 100%; margin-bottom: 20px; border-collapse: collapse; }
        .info-table th { text-align: left; padding: 5px; width: 120px; color: #555; }
        .info-table td { padding: 5px; font-weight: bold; }
        .score-box { background: #f8f9fa; border: 1px solid #ddd; padding: 15px; text-align: center; margin-bottom: 20px; border-radius: 5px; }
        .score-val { font-size: 32px; font-weight: bold; color: #E63946; }
        .phase-item { margin-bottom: 20px; padding: 15px; border: 1px solid #eee; border-left: 4px solid #E63946; background: #fafafa; }
        .phase-name { font-size: 16px; font-weight: bold; margin-bottom: 10px; color: #E63946; }
        .user-arg { background: white; padding: 10px; border: 1px dashed #ccc; font-style: italic; margin-bottom: 10px; }
        .feedback { font-size: 12px; color: #555; }
        .status-badge { display: inline-block; padding: 3px 8px; font-size: 10px; background: #ddd; border-radius: 10px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="title">ArgueCraft</h1>
        <p class="subtitle">Laporan Hasil Simulasi Debat Standar</p>
    </div>

    <table class="info-table">
        <tr><th>Nama Pengguna</th><td>{{ $result->user->name ?? 'User' }}</td></tr>
        <tr><th>Topik Debat</th><td>{{ $result->topic->title }}</td></tr>
        <tr><th>Posisi</th><td style="text-transform: uppercase;">{{ $result->stance }}</td></tr>
        <tr><th>Tanggal</th><td>{{ $result->created_at->format('d M Y, H:i') }}</td></tr>
    </table>

    <div class="score-box">
        <div style="font-size: 14px; color: #666;">Skor Keseluruhan</div>
        <div class="score-val">{{ $result->total_score }}/100</div>
        <p style="font-size: 12px; margin-top: 10px;">{{ $result->feedback_summary }}</p>
    </div>

    <h3 style="border-bottom: 1px solid #ddd; padding-bottom: 5px;">Detail Argumen (Per Fase)</h3>
    
    @foreach($result->phaseResults as $phase)
        <div class="phase-item">
            <div class="phase-name">{{ $phase->phase_name }} <span class="status-badge" style="float: right;">Status: {{ $phase->relevance_status }} | Skor: {{ $phase->score }}</span></div>
            <div style="font-size: 12px; font-weight: bold; margin-bottom: 5px;">Argumen yang diajukan:</div>
            <div class="user-arg">"{{ $phase->user_argument }}"</div>
            @php $fb = json_decode($phase->feedback, true); @endphp
            @if($fb)
                <div class="feedback">
                    <strong>Alasan Terdeteksi:</strong> {{ $fb['has_reason'] ? 'Ya' : 'Tidak' }} | 
                    <strong>Contoh Terdeteksi:</strong> {{ $fb['has_example'] ? 'Ya' : 'Tidak' }}<br>
                    @if(isset($fb['rebuttal_feedback']))
                        <strong>Catatan Bantahan:</strong> {{ $fb['rebuttal_feedback'] }}
                    @endif
                </div>
            @endif
        </div>
    @endforeach

    <div style="text-align: center; font-size: 10px; color: #999; margin-top: 30px; border-top: 1px solid #eee; padding-top: 10px;">
        Dicetak dari ArgueCraft pada {{ date('d M Y H:i') }}
    </div>
</body>
</html>
