@extends('layouts.app')

@section('title', 'Hasil Simulasi - ArgueCraft')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="text-center mb-12">
        <div class="inline-block px-4 py-1.5 mb-4 rounded-full bg-green-100 text-green-700 font-bold text-sm tracking-wide uppercase flex items-center justify-center gap-2 mx-auto w-max">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
            Simulasi Selesai
        </div>
        <h1 class="text-4xl md:text-5xl font-black text-slate-900 mb-4">Laporan Hasil Debat</h1>
        <p class="text-lg text-slate-600">Topik: <span class="font-bold text-slate-800">{{ $topic }}</span> | Posisi: <span class="font-bold text-slate-800 uppercase">{{ $position }}</span></p>
    </div>

    <!-- Score & Feedback Card -->
    <div class="glass p-8 md:p-12 rounded-[2.5rem] shadow-xl relative overflow-hidden mb-12 flex flex-col md:flex-row items-center gap-8 md:gap-12">
        <div class="absolute top-0 right-0 w-64 h-64 bg-red-100/30 rounded-full blur-3xl -mr-20 -mt-20"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-green-100/20 rounded-full blur-3xl -ml-20 -mb-20"></div>
        
        <!-- Score Circle -->
        <div class="relative z-10 shrink-0">
            <div class="w-40 h-40 rounded-full bg-white shadow-2xl flex flex-col items-center justify-center border-8 {{ $score >= 80 ? 'border-green-400' : ($score >= 65 ? 'border-yellow-400' : 'border-red-400') }}">
                <span class="text-5xl font-black text-slate-900">{{ $score }}</span>
                <span class="text-sm font-bold text-slate-500 uppercase">Skor</span>
            </div>
        </div>

        <!-- Feedback Text -->
        <div class="relative z-10 text-center md:text-left flex-1">
            <h3 class="text-2xl font-bold text-slate-900 mb-3">Ulasan Performa</h3>
            <p class="text-lg text-slate-700 leading-relaxed mb-6">{{ $feedback }}</p>
            
            <!-- Detailed Scores -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
                <div class="bg-white/50 p-4 rounded-2xl border border-white">
                    <p class="text-[10px] font-bold text-slate-500 uppercase mb-1">Struktur</p>
                    <p class="text-xl font-black text-slate-900">{{ round($scores['struktur']) }}<span class="text-xs font-normal text-slate-400">/30</span></p>
                </div>
                <div class="bg-white/50 p-4 rounded-2xl border border-white">
                    <p class="text-[10px] font-bold text-slate-500 uppercase mb-1">Kedalaman</p>
                    <p class="text-xl font-black text-slate-900">{{ round($scores['kedalaman']) }}<span class="text-xs font-normal text-slate-400">/25</span></p>
                </div>
                <div class="bg-white/50 p-4 rounded-2xl border border-white">
                    <p class="text-[10px] font-bold text-slate-500 uppercase mb-1">Konsistensi</p>
                    <p class="text-xl font-black text-slate-900">{{ round($scores['konsistensi']) }}<span class="text-xs font-normal text-slate-400">/25</span></p>
                </div>
                <div class="bg-white/50 p-4 rounded-2xl border border-white">
                    <p class="text-[10px] font-bold text-slate-500 uppercase mb-1">Variasi Logika</p>
                    <p class="text-xl font-black text-slate-900">{{ round($scores['variasi_logika']) }}<span class="text-xs font-normal text-slate-400">/20</span></p>
                </div>
            </div>

            <!-- Phase Analysis -->
            <div class="flex flex-wrap gap-4">
                <div class="flex items-center gap-2 px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-bold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    Fase Terkuat: {{ $strongest['name'] }}
                </div>
                <div class="flex items-center gap-2 px-4 py-2 bg-amber-100 text-amber-700 rounded-full text-sm font-bold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path></svg>
                    Perlu Latihan: {{ $weakest['name'] }}
                </div>
            </div>
        </div>
    </div>

    <!-- Answers Review -->
    <div class="mb-12">
        <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-3">
            <svg class="w-6 h-6 text-primary-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            Jejak Argumen Anda
        </h3>
        
        <div class="space-y-6">
            @foreach ($answers as $phaseNum => $answer)
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-full bg-red-50 text-primary-red font-bold flex items-center justify-center text-sm">{{ $phaseNum }}</span>
                            <h4 class="font-bold text-slate-900 text-lg">{{ $answer['phase'] }}</h4>
                        </div>
                        @if ($answer['is_off_topic'] ?? false)
                            <span class="px-3 py-1 bg-red-100 text-red-600 text-[10px] font-black uppercase rounded-full flex items-center gap-1.5 animate-pulse">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>
                                Tidak Relevan
                            </span>
                        @endif
                    </div>
                    <p class="text-slate-700 leading-relaxed pl-11 whitespace-pre-line {{ ($answer['is_off_topic'] ?? false) ? 'opacity-50 italic' : '' }}">{{ $answer['text'] }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Actions -->
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="{{ route('simulation.setup') }}" class="px-8 py-4 bg-white border-2 border-slate-200 text-slate-700 rounded-xl font-bold hover:bg-slate-50 transition-colors text-center">
            Simulasi Baru
        </a>
        <a href="{{ route('dashboard') }}" class="px-8 py-4 bg-primary-red text-white rounded-xl font-bold shadow-lg hover:bg-accent-red transition-all transform hover:-translate-y-0.5 text-center">
            Kembali ke Dashboard
        </a>
    </div>
</div>
@endsection
