@extends('layouts.app')

@section('title', 'Hasil Simulasi - ArgueCraft')

@section('content')
<div class="max-w-4xl mx-auto px-2 sm:px-0 page-fade-in">

    {{-- ===== HEADER ===== --}}
    <div class="text-center mb-6">
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-[10px] font-bold uppercase tracking-widest border border-emerald-100 mb-3">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
            Simulasi Selesai
        </div>
        <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 mb-2">Laporan Hasil Debat</h1>
        <div class="flex items-center justify-center gap-2 text-sm text-slate-500">
            <span class="font-semibold text-slate-700">{{ $topic }}</span>
            <span class="text-slate-300">·</span>
            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold uppercase border
                {{ $position == 'pro' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-rose-50 text-rose-700 border-rose-200' }}">
                {{ $position }}
            </span>
        </div>
    </div>

    {{-- ===== MAIN WRAPPER ===== --}}
    <div class="sim-wrapper p-6 md:p-8 lg:p-10 mb-6">
        <div class="absolute top-0 right-0 w-64 h-64 bg-red-100/30 rounded-full blur-3xl -mr-20 -mt-20 pointer-events-none"></div>

        <div class="relative z-10">

            {{-- ===== SCORE SECTION ===== --}}
            <div class="flex flex-col md:flex-row items-center gap-6 md:gap-8 mb-8">
                {{-- Score Ring --}}
                <div class="shrink-0">
                    <div class="relative w-28 h-28 md:w-32 md:h-32">
                        <svg class="w-full h-full -rotate-90" viewBox="0 0 120 120">
                            <circle cx="60" cy="60" r="52" fill="none" stroke="#f1f5f9" stroke-width="8"/>
                            <circle cx="60" cy="60" r="52" fill="none"
                                stroke="{{ $score >= 80 ? '#10b981' : ($score >= 65 ? '#f59e0b' : '#ef4444') }}"
                                stroke-width="8" stroke-linecap="round"
                                stroke-dasharray="{{ 2 * 3.14159 * 52 }}"
                                stroke-dashoffset="{{ 2 * 3.14159 * 52 * (1 - $score / 100) }}"
                                class="score-ring"/>
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-3xl font-extrabold text-slate-900 animate-count-up">{{ $score }}</span>
                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Skor Total</span>
                        </div>
                    </div>
                </div>

                {{-- Feedback Text --}}
                <div class="flex-1 text-center md:text-left">
                    <h3 class="text-base md:text-lg font-bold text-slate-900 mb-1">Ulasan Performa</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">{{ $feedback }}</p>

                    {{-- Phase badges --}}
                    @if($overallQuality > 1)
                    <div class="flex flex-wrap gap-2 mt-4">
                        <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 text-[10px] font-semibold border border-emerald-100">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                            Terkuat: {{ $strongest['name'] }}
                        </div>
                        <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-amber-50 text-amber-700 text-[10px] font-semibold border border-amber-100">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/></svg>
                            Perlu Latihan: {{ $weakest['name'] }}
                        </div>
                    </div>
                    @else
                    <div class="mt-4">
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-slate-50 text-slate-500 text-[10px] font-semibold border border-slate-100">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                            Analisis tidak tersedia untuk respon kualitas rendah
                        </span>
                    </div>
                    @endif
                </div>
            </div>

            {{-- ===== SCORE BREAKDOWN (Bar Style) ===== --}}
            @if($overallQuality > 1)
            <div class="border-t border-slate-100 pt-6 mb-6">
                <p class="sim-section-label text-slate-500 mb-4">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    Breakdown Skor
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @php
                        $breakdownItems = [
                            ['label' => 'Struktur', 'value' => round($scores['struktur']), 'max' => 30, 'color' => 'bg-blue-500'],
                            ['label' => 'Kedalaman', 'value' => round($scores['kedalaman']), 'max' => 25, 'color' => 'bg-violet-500'],
                            ['label' => 'Konsistensi', 'value' => round($scores['konsistensi']), 'max' => 25, 'color' => 'bg-emerald-500'],
                            ['label' => 'Variasi Logika', 'value' => round($scores['variasi_logika']), 'max' => 20, 'color' => 'bg-amber-500'],
                        ];
                    @endphp
                    @foreach($breakdownItems as $item)
                    <div class="bg-slate-50/80 rounded-xl p-3.5 border border-slate-100">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-bold text-slate-700">{{ $item['label'] }}</span>
                            <span class="text-xs font-extrabold text-slate-900 tabular-nums">{{ $item['value'] }}<span class="text-slate-300 font-normal">/{{ $item['max'] }}</span></span>
                        </div>
                        <div class="w-full h-2 bg-slate-200/60 rounded-full overflow-hidden">
                            <div class="score-bar-fill {{ $item['color'] }}" style="width: {{ ($item['value'] / $item['max']) * 100 }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- ===== MISSING KEYWORDS ===== --}}
            @if(isset($missingKeywords) && count($missingKeywords) > 0)
            <div class="rounded-xl p-4 bg-blue-50/50 border border-blue-100 mb-6">
                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <h4 class="text-xs font-bold text-blue-900">Kata Kunci yang Terlewat</h4>
                </div>
                <p class="text-[10px] text-blue-700 mb-2.5 leading-relaxed">Cobalah menggunakan kata kunci berikut di simulasi berikutnya:</p>
                <div class="flex flex-wrap gap-1.5">
                    @foreach($missingKeywords as $kw)
                        <span class="px-2 py-0.5 bg-white text-blue-700 text-[10px] font-bold rounded-md border border-blue-200">{{ $kw }}</span>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- ===== ARGUMENT HISTORY ===== --}}
            <div class="border-t border-slate-100 pt-6">
                <p class="sim-section-label text-slate-500 mb-4">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    Jejak Argumen ({{ count($answers) }} Fase)
                </p>

                <div class="space-y-3">
                    @foreach ($answers as $phaseNum => $answer)
                        @php
                            $exampleText = $exampleArguments[$phaseNum] ?? null;
                            $statusColor = $answer['status'] == 'Kuat' ? 'emerald' : ($answer['status'] == 'Cukup' ? 'amber' : 'rose');
                        @endphp
                        <div x-data="{ expanded: false, showExample: false }" class="result-expand-card">
                            {{-- Card Header --}}
                            <div class="flex items-center justify-between p-3.5 cursor-pointer hover:bg-slate-50/60 transition-colors" @click="expanded = !expanded">
                                <div class="flex items-center gap-2.5 min-w-0">
                                    <span class="w-6 h-6 rounded-md bg-slate-100 text-slate-600 font-bold flex items-center justify-center text-[10px] border border-slate-200 shrink-0">{{ $phaseNum }}</span>
                                    <h4 class="text-sm font-semibold text-slate-800 truncate">{{ $answer['phase'] }}</h4>
                                </div>
                                <div class="flex items-center gap-1.5 shrink-0">
                                    @if ($answer['is_off_topic'] ?? false)
                                        <span class="px-1.5 py-0.5 bg-rose-50 text-rose-600 text-[8px] font-bold uppercase rounded border border-rose-200">Off-topic</span>
                                    @endif
                                    @if ($answer['contradiction'] ?? false)
                                        <span class="px-1.5 py-0.5 bg-orange-50 text-orange-600 text-[8px] font-bold uppercase rounded border border-orange-200">Kontradiksi</span>
                                    @endif
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-{{ $statusColor }}-50 text-{{ $statusColor }}-700 border border-{{ $statusColor }}-200 tabular-nums">
                                        {{ $answer['score'] }}
                                    </span>
                                    <svg class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200" :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>

                            {{-- Expandable Body --}}
                            <div x-show="expanded" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-cloak class="px-3.5 pb-3.5 border-t border-slate-100">

                                <p class="text-sm text-slate-700 leading-relaxed mt-3 whitespace-pre-line {{ ($answer['is_off_topic'] ?? false) ? 'opacity-50 italic' : '' }}">{{ $answer['text'] }}</p>

                                @if(!empty($answer['used_keywords']))
                                <div class="flex flex-wrap gap-1 mt-3">
                                    @foreach($answer['used_keywords'] as $kw)
                                        <span class="px-1.5 py-0.5 bg-slate-50 text-slate-500 text-[9px] uppercase font-bold rounded border border-slate-100">{{ $kw }}</span>
                                    @endforeach
                                </div>
                                @endif

                                @if($answer['rebuttal_feedback'])
                                <div class="mt-3 pt-3 border-t border-slate-100">
                                    <p class="text-xs font-medium {{ str_contains($answer['rebuttal_feedback'], 'belum') ? 'text-orange-600' : 'text-emerald-600' }}">
                                        <span class="font-bold">Rebuttal:</span> {{ $answer['rebuttal_feedback'] }}
                                    </p>
                                </div>
                                @endif

                                @if(!empty($exampleText))
                                <div class="mt-3 pt-3 border-t border-slate-100">
                                    <button @click.stop="showExample = true" class="text-[10px] font-bold text-slate-500 hover:text-primary-red transition-colors flex items-center gap-1 bg-slate-50 hover:bg-slate-100 px-2 py-1 rounded-md border border-slate-200">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Contoh Referensi
                                    </button>

                                    {{-- Modal --}}
                                    <div x-show="showExample" class="fixed inset-0 z-[100] flex items-center justify-center p-4" x-cloak style="display:none">
                                        <div x-show="showExample" x-transition.opacity class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm" @click="showExample = false"></div>
                                        <div x-show="showExample" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                             class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 z-[101]">
                                            <button type="button" @click="showExample = false" class="absolute top-4 right-4 w-8 h-8 rounded-lg bg-slate-50 hover:bg-slate-100 flex items-center justify-center text-slate-400 hover:text-slate-700 transition-all">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                            </button>
                                            <div class="flex items-center gap-2 mb-4">
                                                <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center text-primary-red">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                </div>
                                                <div>
                                                    <h3 class="text-base font-extrabold text-slate-900">Contoh Referensi</h3>
                                                    <p class="text-[10px] text-slate-400">Posisi <span class="font-bold uppercase text-{{ $position == 'pro' ? 'emerald' : 'rose' }}-600">{{ $position }}</span></p>
                                                </div>
                                            </div>
                                            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 mb-4">
                                                <p class="text-sm text-slate-700 italic leading-relaxed whitespace-pre-line">"{{ $exampleText }}"</p>
                                            </div>
                                            <div class="flex items-start gap-2 p-3 bg-amber-50 rounded-lg border border-amber-100 mb-4">
                                                <svg class="w-4 h-4 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                                                <p class="text-[10px] font-medium text-amber-800 leading-relaxed">Gunakan sebagai evaluasi mandiri.</p>
                                            </div>
                                            <button type="button" @click="showExample = false" class="w-full py-2.5 bg-slate-900 text-white rounded-xl text-xs font-bold hover:bg-slate-800 transition-colors">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- ===== ACTION BUTTONS ===== --}}
    <div class="flex flex-col sm:flex-row gap-3 justify-center mb-6" x-data="{ showExportModal: false }">
        @if(isset($result_id))
        <button @click="showExportModal = true" type="button" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-slate-900 text-white rounded-xl text-sm font-bold hover:bg-slate-800 transition-all shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
            Unduh Laporan PDF
        </button>
        @endif

        <a href="{{ route('simulation.setup') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white border border-slate-200 text-slate-700 rounded-xl text-sm font-bold hover:bg-slate-50 transition-colors">
            Simulasi Baru
        </a>
        <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary-red text-white rounded-xl text-sm font-bold shadow-md shadow-red-200 hover:shadow-lg hover:-translate-y-0.5 transition-all">
            Kembali ke Dashboard
        </a>

        {{-- Export Preview Modal --}}
        @if(isset($result_id))
        <div x-show="showExportModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4" x-cloak style="display:none">
            <div x-show="showExportModal" x-transition.opacity class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm" @click="showExportModal = false"></div>
            <div x-show="showExportModal" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                 class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 z-[101]">
                <button type="button" @click="showExportModal = false" class="absolute top-4 right-4 w-8 h-8 rounded-lg bg-slate-50 hover:bg-slate-100 flex items-center justify-center text-slate-400 hover:text-slate-700 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>

                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-slate-900 flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-extrabold text-slate-900">Pratinjau Ekspor</h3>
                        <p class="text-xs text-slate-400">Dokumen PDF — Laporan Hasil Debat</p>
                    </div>
                </div>

                <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 mb-5 space-y-2">
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2">Isi Laporan</p>
                    @foreach(['Ringkasan Skor (' . $score . '/100)', 'Analisis Struktur & Kedalaman', 'Ulasan Performa per Fase', 'Jejak Argumen Lengkap'] as $item)
                    <div class="flex items-center gap-2 text-xs text-slate-600">
                        <svg class="w-3.5 h-3.5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        {{ $item }}
                    </div>
                    @endforeach
                </div>

                <a href="{{ $is_interactive ? route('export.interactive', $result_id) : route('export.standard', $result_id) }}"
                   class="w-full flex items-center justify-center gap-2 py-3 bg-primary-red text-white rounded-xl text-sm font-bold hover:bg-accent-red transition-all shadow-md shadow-red-200 active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Konfirmasi & Unduh PDF
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
