@extends('layouts.app')

@section('title', 'Fase Simulasi - ArgueCraft')

@section('content')
<div class="max-w-6xl mx-auto px-2 sm:px-4 page-fade-in" x-data="{ showExample: false, argument: '{{ old('argument', '') }}' }">

    {{-- ===== PAGE HEADER ===== --}}
    <div class="text-center mb-6">
        <p class="text-xs font-bold text-primary-red uppercase tracking-widest mb-1">Simulasi Debat</p>
        <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 mb-2">{{ $topic }}</h1>
        <div class="flex items-center justify-center gap-2 flex-wrap">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[10px] font-bold uppercase border
                {{ $position == 'pro' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-rose-50 text-rose-700 border-rose-200' }}">
                {{ $position }}
            </span>
            <span class="text-slate-300">·</span>
            <span class="text-sm text-slate-500 font-medium">Fase {{ $phaseNum }} dari {{ $totalPhases }} — <span class="font-semibold text-slate-700">{{ $phase['name'] }}</span></span>
        </div>
    </div>

    {{-- ===== MAIN WRAPPER CARD ===== --}}
    <div class="sim-wrapper p-5 sm:p-6 md:p-8">
        {{-- Decorative blob --}}
        <div class="absolute top-0 right-0 w-64 h-64 bg-red-100/40 rounded-full blur-3xl -mr-20 -mt-20 pointer-events-none"></div>

        <div class="relative z-10">

            {{-- ===== PROGRESS BAR ===== --}}
            <div class="mb-6 pb-6 border-b border-slate-100">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center gap-1.5">
                        @for($i = 1; $i <= $totalPhases; $i++)
                            <div class="phase-dot {{ $i < $phaseNum ? 'completed' : ($i == $phaseNum ? 'active' : 'upcoming') }}"></div>
                        @endfor
                    </div>
                    <span class="text-xs font-bold text-slate-400 tabular-nums">{{ $phaseNum }}/{{ $totalPhases }}</span>
                </div>
                <div class="phase-progress">
                    <div class="phase-progress-fill" style="width: {{ ($phaseNum / $totalPhases) * 100 }}%"></div>
                </div>
            </div>

            {{-- ===== TWO-COLUMN LAYOUT using flex ===== --}}
            <div class="flex flex-col md:flex-row gap-6 md:gap-8">

                {{-- LEFT: Main Simulation Area --}}
                <div class="flex-1 min-w-0 space-y-5">

                    {{-- Instruction Section --}}
                    <div class="bg-slate-50/80 rounded-xl p-4 sm:p-5 border border-slate-100">
                        <div class="flex gap-3.5 items-start">
                            <div class="w-9 h-9 rounded-lg bg-white flex items-center justify-center shrink-0 border border-slate-200 shadow-sm">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="sim-section-label text-primary-red">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Instruksi Fase
                                </p>
                                <p class="text-sm text-slate-700 leading-relaxed">{{ $phase['instruction'] }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Input Area --}}
                    <div>
                        <form method="POST" action="{{ route('simulation.submitPhase') }}" id="argument-form">
                            @csrf

                            <div class="flex items-center justify-between mb-3">
                                <label class="text-sm font-bold text-slate-800 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    Argumen Anda
                                </label>
                                <div class="flex items-center gap-2">
                                    <span class="text-[10px] font-bold tabular-nums transition-colors"
                                          :class="argument.length < 50 ? 'text-slate-400' : 'text-emerald-600'"
                                          x-text="argument.length + ' karakter'"></span>
                                    <div class="w-12 h-1.5 rounded-full bg-slate-100 overflow-hidden">
                                        <div class="h-full rounded-full transition-all duration-300"
                                             :class="argument.length < 50 ? 'bg-slate-300' : 'bg-emerald-500'"
                                             :style="'width:' + Math.min(100, (argument.length / 50) * 100) + '%'"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="relative">
                                <textarea
                                    name="argument"
                                    rows="7"
                                    x-model="argument"
                                    class="w-full px-4 py-4 rounded-xl border-2 border-slate-200 focus:border-primary-red focus:ring-2 focus:ring-red-100 outline-none transition-all text-sm text-slate-700 leading-relaxed resize-none placeholder:text-slate-300 bg-white"
                                    placeholder="Ketik argumen Anda di sini... Gunakan struktur A-R-E untuk argumen yang kuat. Minimal 50 karakter."
                                    required
                                ></textarea>
                            </div>

                            @error('argument')
                                <div class="mt-2 flex items-center gap-2 text-xs text-red-600 font-semibold bg-red-50 px-3 py-2 rounded-lg border border-red-100">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $message }}
                                </div>
                            @enderror

                            {{-- Submit button --}}
                            <div class="mt-4">
                                <button type="submit"
                                    :disabled="argument.length < 50"
                                    class="w-full py-3.5 rounded-xl text-sm font-bold transition-all flex items-center justify-center gap-2"
                                    :class="argument.length < 50
                                        ? 'bg-slate-100 text-slate-400 cursor-not-allowed border border-slate-200'
                                        : 'bg-primary-red text-white shadow-lg shadow-red-500/20 hover:shadow-red-500/30 hover:bg-accent-red active:scale-[0.98]'">
                                    <span x-text="argument.length < 50 ? 'Minimal 50 karakter untuk mengirim' : 'Kirim Argumen →'"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- RIGHT: Sidebar --}}
                <div class="w-full md:w-72 lg:w-80 shrink-0 space-y-4">

                    {{-- Keywords Panel --}}
                    <div class="sidebar-panel-white">
                        <p class="sim-section-label text-blue-600">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>
                            Kata Kunci Saran
                        </p>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach($keywords as $kw)
                                <span class="px-2 py-1 bg-blue-50 text-blue-700 text-[10px] font-semibold rounded-md border border-blue-100 hover:bg-blue-100 transition-colors cursor-default">{{ $kw }}</span>
                            @endforeach
                        </div>
                    </div>

                    {{-- A-R-E Guide Panel --}}
                    <div class="sidebar-panel bg-amber-50/60 border-amber-200/60">
                        <p class="sim-section-label text-amber-700">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            Panduan Struktur A-R-E
                        </p>
                        <div class="space-y-2.5">
                            <div class="flex gap-2.5 items-start">
                                <span class="w-5 h-5 rounded bg-amber-500 text-white text-[9px] flex items-center justify-center font-bold shrink-0 mt-0.5 shadow-sm">A</span>
                                <div>
                                    <p class="text-[11px] font-bold text-amber-900">Assertion</p>
                                    <p class="text-[10px] text-amber-800/80 leading-relaxed">Nyatakan klaim utama Anda dengan jelas.</p>
                                </div>
                            </div>
                            <div class="flex gap-2.5 items-start">
                                <span class="w-5 h-5 rounded bg-amber-500 text-white text-[9px] flex items-center justify-center font-bold shrink-0 mt-0.5 shadow-sm">R</span>
                                <div>
                                    <p class="text-[11px] font-bold text-amber-900">Reasoning</p>
                                    <p class="text-[10px] text-amber-800/80 leading-relaxed">Jelaskan alasan logis di balik klaim tersebut.</p>
                                </div>
                            </div>
                            <div class="flex gap-2.5 items-start">
                                <span class="w-5 h-5 rounded bg-amber-500 text-white text-[9px] flex items-center justify-center font-bold shrink-0 mt-0.5 shadow-sm">E</span>
                                <div>
                                    <p class="text-[11px] font-bold text-amber-900">Evidence</p>
                                    <p class="text-[10px] text-amber-800/80 leading-relaxed">Sertakan bukti, data, atau contoh nyata.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Idea Reference Panel --}}
                    @if(!empty($exampleText))
                    <button type="button" @click="showExample = true"
                        class="sidebar-panel bg-white border-slate-100/80 w-full text-left hover:border-primary-red/40 hover:bg-red-50/20 transition-all group cursor-pointer"
                        style="box-shadow: 0 1px 2px rgba(0,0,0,0.03);">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-md bg-red-50 flex items-center justify-center">
                                    <svg class="w-3 h-3 text-primary-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                                </div>
                                <span class="text-[10px] font-bold text-slate-600 uppercase tracking-wider">Ide Referensi</span>
                            </div>
                            <svg class="w-3.5 h-3.5 text-slate-300 group-hover:text-primary-red group-hover:translate-x-0.5 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </div>
                        <p class="text-[10px] text-slate-400 mt-1.5 leading-relaxed">Klik untuk melihat inspirasi argumen fase ini.</p>
                    </button>
                    @endif

                    {{-- Quick Tip --}}
                    <div class="sidebar-panel bg-slate-50/60 border-slate-100">
                        <p class="sim-section-label text-slate-500">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                            Tips Cepat
                        </p>
                        <p class="text-[10px] text-slate-500 leading-relaxed">Hindari opini tanpa dasar. Semakin spesifik argumen Anda dengan data atau contoh, semakin tinggi skor yang didapat.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ===== EXAMPLE MODAL ===== --}}
    <div x-show="showExample" class="fixed inset-0 z-[100] flex items-center justify-center p-4" x-cloak style="display:none">
        <div x-show="showExample" x-transition.opacity class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm" @click="showExample = false"></div>
        <div x-show="showExample"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 md:p-8 z-[101]">
            <button type="button" @click="showExample = false" class="absolute top-4 right-4 w-8 h-8 rounded-lg bg-slate-50 hover:bg-slate-100 flex items-center justify-center text-slate-400 hover:text-slate-700 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center text-amber-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                </div>
                <div>
                    <h3 class="text-lg font-extrabold text-slate-900">Ide Referensi</h3>
                    <p class="text-xs text-slate-400">Fase {{ $phaseNum }} — {{ $phase['name'] }}</p>
                </div>
            </div>
            <div class="bg-amber-50 rounded-xl p-5 border border-amber-100 mb-5">
                <p class="text-sm text-amber-900 italic leading-relaxed">"{{ $exampleText }}"</p>
            </div>
            <div class="flex items-start gap-2 p-3 bg-slate-50 rounded-lg border border-slate-100 mb-5">
                <svg class="w-4 h-4 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                <p class="text-[10px] text-slate-500 leading-relaxed">Gunakan sebagai referensi logika. Hindari menyalin teks secara langsung.</p>
            </div>
            <button type="button" @click="showExample = false" class="w-full py-3 bg-slate-900 text-white rounded-xl text-sm font-bold hover:bg-slate-800 transition-colors">Tutup</button>
        </div>
    </div>
</div>
@endsection
