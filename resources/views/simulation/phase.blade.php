@extends('layouts.app')

@section('title', 'Fase Simulasi - ArgueCraft')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Progress Header -->
    <div class="mb-8">
        <div class="flex justify-between items-end mb-2">
            <div>
                <span class="text-sm font-bold text-primary-red uppercase tracking-wider block mb-1">Topik Debat</span>
                <h2 class="text-xl font-bold text-slate-900">{{ $topic }} <span class="px-2 py-1 bg-{{ $position == 'pro' ? 'green' : 'red' }}-100 text-{{ $position == 'pro' ? 'green' : 'red' }}-700 rounded text-sm uppercase ml-2">{{ $position }}</span></h2>
            </div>
            <div class="text-right">
                <span class="text-sm font-bold text-slate-500 uppercase tracking-wider block mb-1">Fase {{ $phaseNum }} dari {{ $totalPhases }}</span>
                <span class="text-lg font-black text-slate-900">{{ $phase['name'] }}</span>
            </div>
        </div>
        
        <!-- Progress Bar -->
        <div class="w-full h-2 bg-slate-200 rounded-full overflow-hidden">
            <div class="h-full bg-primary-red transition-all duration-500" style="width: {{ ($phaseNum / $totalPhases) * 100 }}%"></div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="glass p-8 md:p-10 rounded-[2.5rem] shadow-xl relative overflow-hidden mb-8">
        <div class="absolute top-0 right-0 w-64 h-64 bg-red-100/30 rounded-full blur-3xl -mr-20 -mt-20"></div>
        
        <div class="relative z-10">
            <!-- Instruction Bubble -->
            <div class="bg-slate-900 text-white p-6 rounded-2xl rounded-tl-none mb-8 shadow-lg inline-block max-w-[85%]">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-red-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm text-red-200 font-bold mb-1 uppercase tracking-wide">Instruksi / Sistem</p>
                        <p class="text-lg leading-relaxed">{{ $phase['instruction'] }}</p>
                    </div>
                </div>
            </div>

            <!-- User Input Form -->
            <form method="POST" action="{{ route('simulation.submitPhase') }}">
                @csrf
                
                <div class="mb-4">
                    <label for="argument" class="block text-sm font-bold text-slate-700 mb-2">Argumen Anda:</label>
                    <textarea name="argument" id="argument" rows="6" placeholder="Ketik argumen Anda di sini... (Minimal 50 karakter)" required
                        class="w-full p-5 rounded-2xl border border-slate-200 focus:border-primary-red focus:ring-2 focus:ring-primary-red/20 outline-none transition-all bg-white/70 backdrop-blur-sm text-slate-700 leading-relaxed resize-none shadow-inner">{{ old('argument') }}</textarea>
                    
                    <div class="flex justify-between items-start mt-2">
                        <div class="flex-1">
                            @error('argument')
                                <p class="text-sm text-red-600 font-medium bg-red-50 py-1 px-3 rounded inline-block">{{ $message }}</p>
                            @enderror
                        </div>
                        <span class="text-xs text-slate-400 font-medium" id="char-count">0 karakter</span>
                    </div>
                </div>

                <div class="flex justify-end mt-8">
                    <button type="submit" class="px-8 py-4 bg-primary-red text-white rounded-xl font-bold shadow-lg shadow-red-500/30 hover:shadow-red-500/50 hover:bg-accent-red transition-all transform hover:-translate-y-0.5 flex items-center gap-2">
                        Kirim Argumen
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.getElementById('argument');
        const charCount = document.getElementById('char-count');
        
        function updateCount() {
            const length = textarea.value.length;
            charCount.textContent = length + ' karakter';
            if (length < 50) {
                charCount.classList.remove('text-green-600');
                charCount.classList.add('text-red-500');
            } else {
                charCount.classList.remove('text-red-500');
                charCount.classList.add('text-green-600');
            }
        }
        
        textarea.addEventListener('input', updateCount);
        updateCount(); // Initial count
    });
</script>
@endsection
