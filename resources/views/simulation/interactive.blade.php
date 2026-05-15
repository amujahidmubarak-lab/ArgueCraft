@extends('layouts.app')

@section('title', 'Debat Interaktif - ArgueCraft')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 flex flex-col page-fade-in" style="height: calc(100vh - 8rem);">

    {{-- ===== HEADER BAR ===== --}}
    <div class="sim-card p-4 mb-4 flex items-center justify-between shrink-0">
        <div class="flex items-center gap-3 min-w-0">
            <div class="w-9 h-9 rounded-xl bg-primary-red flex items-center justify-center text-white shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                </svg>
            </div>
            <div class="min-w-0">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Debat Interaktif</p>
                <p class="text-sm font-bold text-slate-900 truncate">
                    {{ $topic }}
                    <span class="text-[10px] px-1.5 py-0.5 ml-1 rounded bg-slate-50 text-slate-500 border border-slate-100 font-semibold">{{ strtoupper($position) }}</span>
                </p>
            </div>
        </div>
        <div class="flex items-center gap-4 shrink-0">
            <div class="text-right hidden sm:block">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Fase</p>
                <p class="text-sm font-extrabold text-slate-900">{{ $phaseNum }}<span class="text-slate-300 font-medium">/5</span></p>
            </div>
        </div>
    </div>

    {{-- ===== CHAT AREA ===== --}}
    <div id="chat-container" x-data="{ isTyping: false }" class="flex-1 overflow-y-auto p-4 md:p-6 mb-4 sim-card custom-scrollbar space-y-4">
        @foreach ($chat as $index => $msg)
            @if ($msg['sender'] == 'system')
                {{-- System / Opponent Message --}}
                <div class="flex items-end gap-2.5 max-w-[88%] md:max-w-[75%] animate-slide-in-left">
                    <div class="w-8 h-8 rounded-lg bg-slate-800 flex-shrink-0 flex items-center justify-center text-white">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="bg-slate-50 px-4 py-3 rounded-2xl rounded-bl-sm border border-slate-100">
                        <div class="text-sm text-slate-700 leading-relaxed prose prose-sm prose-slate max-w-none">
                            {!! Str::markdown($msg['message']) !!}
                        </div>
                    </div>
                </div>
            @else
                {{-- User Message --}}
                <div class="flex flex-col items-end gap-1.5 ml-auto max-w-[88%] md:max-w-[75%] animate-slide-in-right">
                    <div class="flex items-end gap-2.5">
                        <div class="bg-primary-red px-4 py-3 rounded-2xl rounded-br-sm text-white shadow-sm">
                            <p class="text-sm leading-relaxed">{{ $msg['message'] }}</p>
                        </div>
                        <div class="w-8 h-8 rounded-lg bg-red-50 flex-shrink-0 flex items-center justify-center text-primary-red text-xs font-bold border border-red-100">
                            {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                        </div>
                    </div>
                    {{-- Mini Feedback Badge --}}
                    @php
                        $dbMsg = \App\Models\InteractiveMessage::where('session_id', $session_id)->where('sender_type', 'user')->where('message', $msg['message'])->first();
                        $status = $dbMsg->relevance_status ?? null;
                    @endphp
                    @if($status)
                    <div class="mr-11">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[9px] font-bold uppercase border
                            {{ $status == 'Kuat' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : ($status == 'Cukup' ? 'bg-amber-50 text-amber-700 border-amber-200' : 'bg-rose-50 text-rose-700 border-rose-200') }}">
                            {{ $status }}
                        </span>
                    </div>
                    @endif
                </div>
            @endif
        @endforeach

        {{-- Typing Indicator --}}
        <div x-show="isTyping" x-transition class="flex items-end gap-2.5 max-w-[85%]">
            <div class="w-8 h-8 rounded-lg bg-slate-800 flex-shrink-0 flex items-center justify-center text-white">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <div class="bg-slate-50 px-4 py-3 rounded-2xl rounded-bl-sm border border-slate-100 flex gap-1">
                <span class="w-2 h-2 bg-slate-400 rounded-full animate-bounce" style="animation-delay:0s"></span>
                <span class="w-2 h-2 bg-slate-400 rounded-full animate-bounce" style="animation-delay:0.15s"></span>
                <span class="w-2 h-2 bg-slate-400 rounded-full animate-bounce" style="animation-delay:0.3s"></span>
            </div>
        </div>
    </div>

    {{-- ===== INPUT AREA ===== --}}
    <div class="sim-card p-4 relative shrink-0" x-data="{ 
        timer: {{ $mode == 'speed' ? 60 : 0 }},
        isSubmitted: false,
        timeExpired: false,
        argumentText: '',
        startTimer() {
            if(this.timer > 0) {
                let countdown = setInterval(() => { 
                    if(this.timer > 0) {
                        this.timer--;
                    } else {
                        clearInterval(countdown);
                        if(!this.isSubmitted) {
                            this.isSubmitted = true;
                            this.timeExpired = true;
                            if(this.argumentText.trim().length < 50) {
                                this.argumentText = this.argumentText + ' (Waktu habis sebelum argumen selesai)';
                            }
                            setTimeout(() => {
                                this.$refs.chatForm.submit();
                            }, 1500);
                        }
                    }
                }, 1000);
            }
        }
    }" x-init="startTimer()">
        
        {{-- Timer Notification Toast --}}
        <div x-show="timeExpired" x-transition.opacity class="absolute -top-12 left-1/2 -translate-x-1/2 bg-slate-900 text-white px-4 py-2 rounded-lg text-xs font-bold shadow-xl flex items-center gap-2 z-20 whitespace-nowrap">
            <svg class="w-4 h-4 text-red-400 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Waktu habis — otomatis dikirim...
        </div>

        {{-- Speed Mode Timer Badge --}}
        @if($mode == 'speed')
        <div class="absolute -top-5 left-1/2 -translate-x-1/2 px-3 py-1 bg-white text-slate-900 rounded-full text-[11px] font-bold flex items-center gap-1.5 shadow-md border border-slate-100 z-10"
             :class="timer < 10 ? 'ring-2 ring-red-400 text-red-500' : ''">
            <svg class="w-3.5 h-3.5" :class="timer < 10 ? 'text-red-500 animate-pulse' : 'text-slate-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span class="tabular-nums" x-text="timer > 0 ? '00:' + timer.toString().padStart(2, '0') : '00:00'"></span>
        </div>
        @endif

        <form x-ref="chatForm" method="POST" action="{{ route('simulation.interactive.submit', ['session_id' => $session_id]) }}" class="flex flex-col sm:flex-row gap-3 items-end" @submit="isSubmitted = true; document.getElementById('chat-container').__x.$data.isTyping = true">
            @csrf
            <div class="w-full sm:flex-1 relative" x-data="{ showHints: false }">
                <textarea 
                    x-ref="argumentInput"
                    x-model="argumentText"
                    name="argument" 
                    rows="2" 
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:border-primary-red focus:ring-2 focus:ring-red-100 transition-all resize-none placeholder:text-slate-400 text-sm text-slate-700 pr-24"
                    placeholder="Tuliskan argumen Anda... (Min. 50 karakter)"
                    required
                    :readonly="isSubmitted"
                ></textarea>
                
                {{-- Character counter + Hint button --}}
                <div class="absolute bottom-2 right-2 flex items-center gap-2">
                    <span class="text-[9px] font-bold tabular-nums transition-colors"
                          :class="argumentText.length < 50 ? 'text-slate-400' : 'text-emerald-600'"
                          x-text="argumentText.length"></span>
                    <button type="button" @click="showHints = !showHints" class="w-7 h-7 rounded-lg bg-white border border-slate-200 hover:bg-slate-50 text-slate-400 hover:text-primary-red flex items-center justify-center transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                    </button>
                </div>

                {{-- Hint Dropdown --}}
                <div x-show="showHints" x-cloak @click.away="showHints = false" x-transition.opacity class="absolute bottom-full right-0 mb-2 w-64 bg-white rounded-xl shadow-xl p-4 border border-slate-100 z-10">
                    <h5 class="text-[10px] font-bold text-slate-500 mb-2 uppercase tracking-widest flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                        Ide Referensi
                    </h5>
                    <div class="bg-amber-50 rounded-lg p-3 mb-2 border border-amber-100/50">
                        <p class="text-[11px] text-amber-900 italic leading-relaxed">"{{ $exampleText ?? 'Berikan argumen yang solid sesuai posisi Anda.' }}"</p>
                    </div>
                    <p class="text-[9px] text-slate-400 font-medium">Jangan disalin langsung — gunakan sebagai panduan logika.</p>
                </div>

                @error('argument')
                    <p class="absolute -top-7 left-0 text-[10px] text-red-600 font-bold bg-red-50 px-2 py-1 rounded-md border border-red-100">{{ $message }}</p>
                @enderror
            </div>
            
            <button type="submit" 
                    :disabled="(argumentText.length < 50 && !timeExpired) || isSubmitted"
                    class="w-full sm:w-auto px-6 py-3 rounded-xl text-sm font-bold transition-all flex items-center justify-center gap-2"
                    :class="(argumentText.length < 50 && !timeExpired) || isSubmitted ? 'bg-slate-100 text-slate-400 cursor-not-allowed' : 'bg-primary-red text-white shadow-md shadow-red-200 hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0'">
                
                <span x-show="!isSubmitted">Kirim</span>
                <span x-show="isSubmitted" class="animate-pulse">Mengirim...</span>
                
                <svg x-show="!isSubmitted" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                <svg x-show="isSubmitted" class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
            </button>
        </form>

        <p class="text-[9px] text-slate-400 mt-2 ml-1 font-medium">
            Struktur <span class="font-bold text-slate-500">A-R-E</span> (Assertion, Reasoning, Evidence) — semakin runtut, semakin tinggi skor.
        </p>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('chat-container');
        if(container) container.scrollTop = container.scrollHeight;
    });
    const chatContainer = document.getElementById('chat-container');
    const observer = new MutationObserver(() => {
        chatContainer.scrollTop = chatContainer.scrollHeight;
    });
    observer.observe(chatContainer, { childList: true, subtree: true });
</script>
@endsection
