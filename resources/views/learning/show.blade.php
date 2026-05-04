@extends('layouts.app')

@section('title', $module->title . ' - ArgueCraft')

@section('content')
<!-- Inject Alpine.js for Interactive UI -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div class="max-w-3xl mx-auto px-6 py-4" x-data="learningModule()">
    <!-- Module Header -->
    <div class="mb-16">
        <div class="flex items-center gap-6 mb-8">
            <a href="{{ route('learning.index') }}" class="w-12 h-12 rounded-2xl bg-white shadow-sm flex items-center justify-center hover:bg-slate-50 transition-all text-slate-300 hover:text-primary-red border border-slate-100 group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div class="h-10 w-px bg-slate-100"></div>
            <div>
                <span class="text-[11px] font-black text-primary-red/60 uppercase tracking-[0.3em] mb-1 block">Modul {{ $module->id }}</span>
                <h1 class="text-3xl font-black text-slate-900 leading-none tracking-tighter">{{ $module->title }}</h1>
            </div>
        </div>

        <!-- Journey Bar -->
        <div class="bg-white p-4 rounded-3xl border border-slate-50 shadow-sm flex items-center gap-6">
            <div class="flex-1 h-2 bg-slate-50 rounded-full overflow-hidden flex gap-1 p-0.5">
                <template x-for="i in totalSteps">
                    <div class="h-full flex-1 rounded-full transition-all duration-700" 
                         :class="i <= currentStep + 1 ? 'bg-primary-red' : 'bg-slate-100'"></div>
                </template>
            </div>
            <div class="text-[11px] font-black text-slate-900 bg-slate-50 px-3 py-1.5 rounded-full border border-slate-100 whitespace-nowrap">
                LANGKAH <span x-text="currentStep + 1"></span> DARI <span x-text="totalSteps"></span>
            </div>
        </div>
    </div>

    <!-- Main Interaction Area: Removed Absolute Stacking -->
    <div class="relative">
        @foreach ($module->sections as $index => $section)
            <div 
                x-show="currentStep === {{ $index }}" 
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="w-full"
                x-cloak
            >
                <!-- Section Header -->
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-10 h-10 rounded-xl bg-slate-900 text-white flex items-center justify-center shadow-md">
                        @if (($section['icon'] ?? '') === 'brain')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                        @elseif (($section['icon'] ?? '') === 'layers')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        @elseif (($section['icon'] ?? '') === 'search')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        @else
                            <span class="text-sm font-black">#</span>
                        @endif
                    </div>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight">{{ $section['title'] }}</h2>
                </div>

                <!-- Concept Card -->
                @if ($section['type'] === 'concept')
                    <div class="space-y-8">
                        <div class="bg-white p-12 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.04)] border border-slate-50 relative overflow-hidden">
                            <!-- Pointer Events None to prevent blocking clicks -->
                            <div class="absolute top-0 right-0 w-40 h-40 bg-red-50/30 rounded-full blur-3xl -mr-20 -mt-20 pointer-events-none"></div>
                            <p class="text-xl text-slate-700 leading-relaxed font-semibold relative z-10">
                                {{ $section['content'] }}
                            </p>
                        </div>

                        @if (isset($section['revelations']))
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4" x-data="{ revealed: [] }">
                                @foreach ($section['revelations'] as $rIdx => $rev)
                                    <button 
                                        @click="if(!revealed.includes({{ $rIdx }})) revealed.push({{ $rIdx }})"
                                        class="p-7 rounded-[2rem] border transition-all duration-300 text-left group relative"
                                        :class="revealed.includes({{ $rIdx }}) ? 'bg-white border-slate-100 shadow-sm' : 'bg-slate-50/50 border-transparent hover:border-primary-red/20'"
                                    >
                                        <div class="flex items-center justify-between mb-3">
                                            <span class="text-[10px] font-black uppercase tracking-[0.2em]" :class="revealed.includes({{ $rIdx }}) ? 'text-primary-red' : 'text-slate-400'">Point {{ $rIdx + 1 }}</span>
                                            <template x-if="!revealed.includes({{ $rIdx }})">
                                                <div class="w-2 h-2 rounded-full bg-primary-red animate-ping"></div>
                                            </template>
                                        </div>
                                        <h4 class="text-base font-black text-slate-900 mb-1" x-text="revealed.includes({{ $rIdx }}) ? '{{ $rev['title'] }}' : 'Klik untuk melihat...'"></h4>
                                        <div x-show="revealed.includes({{ $rIdx }})" x-transition class="text-slate-500 text-sm leading-relaxed font-medium">
                                            {{ $rev['desc'] }}
                                        </div>
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Comparison UI -->
                @if ($section['type'] === 'comparison')
                    <div class="grid md:grid-cols-2 gap-6 mb-8" x-data="{ showWhy: null }">
                        <div class="p-8 rounded-[2.5rem] border transition-all h-full flex flex-col group"
                             :class="showWhy === 'left' ? 'bg-white border-red-200 shadow-md' : 'bg-slate-50/50 border-transparent hover:bg-white hover:border-red-100'">
                            <div class="flex justify-between items-center mb-6">
                                <span class="text-2xl">{{ $section['left']['icon'] }}</span>
                                <span class="text-[9px] font-black uppercase tracking-widest text-red-500 bg-red-50 px-3 py-1 rounded-full">{{ $section['left']['label'] }}</span>
                            </div>
                            <p class="text-slate-700 font-bold text-lg mb-6 leading-tight">{{ $section['left']['content'] }}</p>
                            <div class="mt-auto">
                                <button @click="showWhy = (showWhy === 'left' ? null : 'left')" class="text-[10px] font-black text-red-400 flex items-center gap-2 hover:text-red-600 transition-colors">
                                    <span x-text="showWhy === 'left' ? 'TUTUP ANALISIS' : 'BEDAH KESALAHAN'"></span>
                                    <svg class="w-3 h-3 transition-transform" :class="showWhy === 'left' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                                <div x-show="showWhy === 'left'" x-transition class="mt-4 p-5 rounded-2xl bg-red-50/50 text-xs text-red-800 leading-relaxed font-medium">
                                    {{ $section['left']['why'] }}
                                </div>
                            </div>
                        </div>

                        <div class="p-8 rounded-[2.5rem] border transition-all h-full flex flex-col group"
                             :class="showWhy === 'right' ? 'bg-white border-green-200 shadow-md' : 'bg-slate-50/50 border-transparent hover:bg-white hover:border-green-100'">
                            <div class="flex justify-between items-center mb-6">
                                <span class="text-2xl">{{ $section['right']['icon'] }}</span>
                                <span class="text-[9px] font-black uppercase tracking-widest text-green-600 bg-green-50 px-3 py-1 rounded-full">{{ $section['right']['label'] }}</span>
                            </div>
                            <p class="text-slate-700 font-bold text-lg mb-6 leading-tight">{{ $section['right']['content'] }}</p>
                            <div class="mt-auto">
                                <button @click="showWhy = (showWhy === 'right' ? null : 'right')" class="text-[10px] font-black text-green-500 flex items-center gap-2 hover:text-green-700 transition-colors">
                                    <span x-text="showWhy === 'right' ? 'TUTUP ANALISIS' : 'BEDAH KEUNGGULAN'"></span>
                                    <svg class="w-3 h-3 transition-transform" :class="showWhy === 'right' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                                </button>
                                <div x-show="showWhy === 'right'" x-transition class="mt-4 p-5 rounded-2xl bg-green-50/50 text-xs text-green-800 leading-relaxed font-medium">
                                    {{ $section['right']['why'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Flow UI -->
                @if ($section['type'] === 'flow')
                    <div class="flex flex-col md:flex-row items-center justify-center gap-4 mb-8">
                        @foreach ($section['steps'] as $sIndex => $step)
                            <div class="flex-1 flex flex-col items-center text-center p-6 rounded-3xl bg-white border border-slate-50 shadow-sm w-full">
                                <div class="w-12 h-12 rounded-2xl bg-slate-50 text-primary-red font-black text-lg flex items-center justify-center mb-4">
                                    {{ $sIndex + 1 }}
                                </div>
                                <h4 class="font-black text-slate-900 uppercase text-[10px] tracking-widest mb-2">{{ $step['label'] }}</h4>
                                <p class="text-[11px] text-slate-500 leading-relaxed font-medium">{{ $step['desc'] }}</p>
                            </div>
                            @if (!$loop->last)
                                <div class="hidden md:block text-slate-100">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/></svg>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif

                <!-- Stacking UI -->
                @if ($section['type'] === 'stack')
                    <div class="max-w-md mx-auto space-y-3 mb-10">
                        @foreach (array_reverse($section['items']) as $sIdx => $item)
                            <div 
                                x-data="{ open: false }" 
                                @click="open = !open"
                                class="p-6 bg-white rounded-2xl border transition-all cursor-pointer shadow-sm group"
                                :class="open ? 'border-primary-red' : 'border-slate-100 hover:border-primary-red/30'"
                                :style="`margin-top: -{{ $sIdx * 0.75 }}rem; z-index: {{ 10 - $sIdx }}`"
                            >
                                <div class="flex justify-between items-center">
                                    <div>
                                        <span class="text-[9px] font-black uppercase tracking-widest block mb-1" :class="open ? 'text-primary-red' : 'text-slate-400'">{{ $item['label'] }}</span>
                                        <p class="text-slate-900 font-bold text-base tracking-tight">{{ $item['content'] }}</p>
                                    </div>
                                    <div class="w-6 h-6 rounded-full bg-slate-50 flex items-center justify-center transition-transform" :class="open ? 'rotate-180 bg-red-50 text-primary-red' : 'text-slate-400'">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                                <div x-show="open" x-transition class="mt-4 pt-4 border-t border-slate-50 text-xs text-slate-500 font-medium leading-relaxed">
                                    Komponen inti dari argumentasi yang logis.
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Check UI -->
                @if ($section['type'] === 'check')
                    <div class="bg-white p-10 md:p-14 rounded-[3rem] shadow-xl border border-slate-50 mb-10 relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-full h-1.5 bg-slate-50"></div>
                        <h3 class="text-2xl font-black text-slate-900 mb-10 text-center tracking-tight">{{ $section['question'] }}</h3>
                        <div class="space-y-3">
                            @foreach ($section['options'] as $oIndex => $option)
                                <button 
                                    @click="selected = {{ $oIndex }}; correct = {{ $option['correct'] ? 'true' : 'false' }}; feedback = '{{ $option['feedback'] }}'; if(correct) canContinue = true"
                                    class="w-full text-left p-6 rounded-2xl border transition-all duration-300 flex items-center justify-between group"
                                    :class="{
                                        'border-slate-100 hover:border-primary-red bg-white': selected !== {{ $oIndex }},
                                        'border-green-500 bg-green-50/30': selected === {{ $oIndex }} && correct === true,
                                        'border-red-500 bg-red-50/30': selected === {{ $oIndex }} && correct === false
                                    }"
                                >
                                    <span class="font-bold text-slate-700 text-base">{{ $option['text'] }}</span>
                                    <div class="w-6 h-6 rounded-lg border flex items-center justify-center shrink-0" 
                                         :class="selected === {{ $oIndex }} ? (correct ? 'bg-green-500 border-green-500 text-white' : 'bg-red-500 border-red-500 text-white') : 'border-slate-200'">
                                        <template x-if="selected === {{ $oIndex }}">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path x-show="correct" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                                <path x-show="!correct" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </template>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                        <div x-show="feedback" x-cloak class="mt-8 p-6 rounded-2xl text-center font-black text-sm tracking-tight border" :class="correct ? 'text-green-700 bg-green-50 border-green-100' : 'text-red-700 bg-red-50 border-red-100'" x-text="feedback"></div>
                    </div>
                @endif

                <!-- Insight Box -->
                @if (isset($section['insight']))
                    <div class="bg-slate-900 p-8 rounded-[2.5rem] mb-12 flex flex-col md:flex-row items-center justify-between gap-8">
                        <div class="flex items-center gap-6">
                            <div class="w-14 h-14 rounded-2xl bg-white/10 text-white flex items-center justify-center shrink-0">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <div>
                                <span class="text-[10px] font-black text-white/40 uppercase tracking-[0.3em] block mb-1">INTISARI BELAJAR</span>
                                <p class="text-white font-bold text-lg leading-snug">{{ $section['insight'] }}</p>
                            </div>
                        </div>
                        @if (isset($section['detail']))
                            <button @click="showDetail(`{{ $section['title'] }}`, `{{ addslashes(str_replace("\n", '<br>', $section['detail'])) }}`)" class="px-7 py-3 bg-white text-slate-900 rounded-xl text-[11px] font-black uppercase tracking-widest hover:bg-primary-red hover:text-white transition-all transform hover:-translate-y-1">
                                Baca Detail
                            </button>
                        @endif
                    </div>
                @endif

                <!-- Navigation Controls -->
                <div class="flex justify-center pb-24">
                    <button 
                        @click="next()" 
                        x-show="currentStep < totalSteps - 1"
                        :disabled="!canContinue"
                        class="px-12 py-5 bg-primary-red text-white rounded-2xl font-black text-base shadow-lg shadow-red-500/20 hover:shadow-red-500/40 hover:bg-accent-red transition-all transform hover:-translate-y-1 active:scale-95 disabled:opacity-30 disabled:cursor-not-allowed disabled:transform-none flex items-center gap-4 group"
                    >
                        <span>LANJUT KE TAHAP BERIKUTNYA</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>

                    <form x-show="currentStep === totalSteps - 1" action="{{ route('learning.complete', $module->id) }}" method="POST">
                        @csrf
                        <button 
                            type="submit" 
                            :disabled="!canContinue"
                            class="px-12 py-5 bg-green-600 text-white rounded-2xl font-black text-base shadow-lg shadow-green-500/20 hover:shadow-green-500/40 hover:bg-green-700 transition-all transform hover:-translate-y-1 active:scale-95 disabled:opacity-30 disabled:cursor-not-allowed flex items-center gap-4 group"
                        >
                            <span>SELESAIKAN PEMBELAJARAN</span>
                            <svg class="w-5 h-5 group-hover:scale-125 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Detail Modal -->
    <div 
        x-show="modalOpen" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-slate-900/90 backdrop-blur-sm"
        x-cloak
    >
        <div 
            @click.away="modalOpen = false"
            class="bg-white w-full max-w-2xl rounded-[2.5rem] shadow-2xl overflow-hidden relative transform transition-all"
            x-show="modalOpen"
            x-transition:enter="transition ease-out duration-400 transform"
            x-transition:enter-start="scale-95 opacity-0 translate-y-8"
            x-transition:enter-end="scale-100 opacity-100 translate-y-0"
        >
            <div class="px-10 pt-10 pb-6 flex justify-between items-center border-b border-slate-50">
                <div class="flex items-center gap-4">
                    <div class="w-2 h-8 bg-primary-red rounded-full"></div>
                    <h3 class="text-2xl font-black text-slate-900 tracking-tight" x-text="modalTitle"></h3>
                </div>
                <button @click="modalOpen = false" class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center hover:bg-slate-100 transition-colors">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div class="p-10 md:p-12 max-h-[60vh] overflow-y-auto custom-scrollbar">
                <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed font-medium text-base" x-html="modalContent"></div>
            </div>
            <div class="p-8 bg-slate-50/50 flex justify-center">
                <button @click="modalOpen = false" class="px-10 py-3.5 bg-slate-900 text-white rounded-xl font-bold hover:bg-primary-red transition-all shadow-md">Tutup Detail</button>
            </div>
        </div>
    </div>
</div>

<script>
function learningModule() {
    return {
        currentStep: 0,
        totalSteps: {{ count($module->sections) }},
        canContinue: false,
        selected: null,
        correct: null,
        feedback: '',
        modalOpen: false,
        modalTitle: '',
        modalContent: '',
        init() { this.updateCanContinue(); },
        updateCanContinue() {
            const sections = @json($module->sections);
            const currentSection = sections[this.currentStep];
            this.canContinue = currentSection.type !== 'check';
        },
        showDetail(title, content) {
            this.modalTitle = title;
            this.modalContent = content;
            this.modalOpen = true;
        },
        next() {
            if (this.currentStep < this.totalSteps - 1) {
                window.scrollTo({ top: 0, behavior: 'smooth' });
                this.currentStep++;
                this.selected = null;
                this.correct = null;
                this.feedback = '';
                this.updateCanContinue();
            }
        }
    }
}
</script>

<style>
[x-cloak] { display: none !important; }
.custom-scrollbar::-webkit-scrollbar { width: 5px; }
.custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
.custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.05); border-radius: 10px; }
</style>
@endsection
