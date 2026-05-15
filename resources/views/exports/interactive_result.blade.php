<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Interaktif - ArgueCraft</title>
    <style>
        body { font-family: sans-serif; color: #333; line-height: 1.5; }
        .header { text-align: center; border-bottom: 2px solid #E63946; padding-bottom: 20px; margin-bottom: 20px; }
        .title { color: #E63946; font-size: 24px; font-weight: bold; margin: 0; }
        .subtitle { font-size: 14px; color: #666; margin: 5px 0 0 0; }
        .info-table { width: 100%; margin-bottom: 20px; border-collapse: collapse; }
        .info-table th { text-align: left; padding: 5px; width: 120px; color: #555; }
        .info-table td { padding: 5px; font-weight: bold; }
        .score-box { background: #f8f9fa; border: 1px solid #ddd; padding: 15px; text-align: center; margin-bottom: 20px; border-radius: 5px; }
        .score-val { font-size: 32px; font-weight: bold; color: #E63946; }
        
        .chat-container { border: 1px solid #eee; background: #fafafa; padding: 15px; border-radius: 5px; }
        .msg { margin-bottom: 15px; padding: 10px; border-radius: 5px; max-width: 80%; }
        .msg-system { background: #e2e8f0; margin-right: auto; border-left: 3px solid #64748b; }
        .msg-user { background: #fee2e2; margin-left: auto; border-right: 3px solid #E63946; text-align: right; }
        .msg-sender { font-size: 10px; font-weight: bold; color: #666; margin-bottom: 4px; text-transform: uppercase; }
        .msg-text { font-size: 13px; }
        .badge { display: inline-block; padding: 2px 6px; font-size: 9px; background: #fff; border: 1px solid #ccc; border-radius: 10px; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="title">ArgueCraft</h1>
        <p class="subtitle">Laporan Hasil Debat Interaktif</p>
    </div>

    <table class="info-table">
        <tr><th>Nama Pengguna</th><td>{{ $session->user->name ?? 'User' }}</td></tr>
        <tr><th>Topik Debat</th><td>{{ $session->topic->title }}</td></tr>
        <tr><th>Posisi</th><td style="text-transform: uppercase;">{{ $session->stance }}</td></tr>
        <tr><th>Tanggal</th><td>{{ $session->created_at->format('d M Y, H:i') }}</td></tr>
    </table>

    <div class="score-box">
        <div style="font-size: 14px; color: #666;">Skor Keseluruhan</div>
        <div class="score-val">{{ $session->total_score }}/100</div>
    </div>

    <h3 style="border-bottom: 1px solid #ddd; padding-bottom: 5px;">Transkrip Debat</h3>
    
    <div class="chat-container">
        @foreach($session->messages as $msg)
            @if($msg->sender_type == 'system')
                <div class="msg msg-system">
                    <div class="msg-sender">Sistem / Lawan</div>
                    <div class="msg-text">{!! strip_tags(Str::markdown($msg->message)) !!}</div>
                </div>
            @else
                <div class="msg msg-user">
                    <div class="msg-sender">{{ $session->user->name ?? 'Anda' }}</div>
                    <div class="msg-text">{{ $msg->message }}</div>
                    @if($msg->relevance_status)
                        <div class="badge">Status: {{ $msg->relevance_status }} | Skor: {{ $msg->score }}</div>
                    @endif
                </div>
            @endif
        @endforeach
    </div>

    <div style="text-align: center; font-size: 10px; color: #999; margin-top: 30px; border-top: 1px solid #eee; padding-top: 10px;">
        Dicetak dari ArgueCraft pada {{ date('d M Y H:i') }}
    </div>
</body>
</html>
