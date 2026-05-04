@extends('layouts.app')

@section('title', 'Debat Interaktif - ArgueCraft')

@section('content')
<div class="max-w-4xl mx-auto h-[calc(100vh-12rem)] flex flex-col">
    <!-- Header Info -->
    <div class="glass p-4 rounded-3xl mb-4 flex justify-between items-center shadow-sm border border-white/50">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 rounded-full bg-primary-red flex items-center justify-center text-white font-bold">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Topik: {{ $topic }}</p>
                <p class="text-sm font-black text-slate-900">Posisi Anda: <span class="{{ $position == 'pro' ? 'text-green-600' : 'text-red-600' }}">{{ strtoupper($position) }}</span></p>
            </div>
        </div>
        <div class="text-right">
            <span class="px-4 py-1.5 rounded-full bg-slate-100 text-slate-600 text-xs font-bold border border-slate-200">Fase {{ $phaseNum }} / 5</span>
        </div>
    </div>

    <!-- Chat Area -->
    <div id="chat-container" class="flex-1 overflow-y-auto space-y-6 p-6 mb-4 glass rounded-[2.5rem] shadow-inner custom-scrollbar">
        @foreach ($chat as $msg)
            @if ($msg['sender'] == 'system')
                <!-- System Message -->
                <div class="flex justify-start items-end gap-3 max-w-[85%]">
                    <div class="w-8 h-8 rounded-lg bg-slate-800 flex-shrink-0 flex items-center justify-center text-white shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <div class="bg-white p-4 rounded-2xl rounded-bl-none shadow-sm border border-slate-100 relative group">
                        <p class="text-slate-800 leading-relaxed prose prose-sm prose-slate">
                            {!! Str::markdown($msg['message']) !!}
                        </p>
                    </div>
                </div>
            @else
                <!-- User Message -->
                <div class="flex justify-end items-end gap-3 ml-auto max-w-[85%]">
                    <div class="bg-primary-red p-4 rounded-2xl rounded-br-none shadow-lg text-white">
                        <p class="leading-relaxed">{{ $msg['message'] }}</p>
                    </div>
                    <div class="w-8 h-8 rounded-lg bg-red-100 flex-shrink-0 flex items-center justify-center text-primary-red font-black shadow-sm">
                        {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <!-- Input Area -->
    <div class="glass p-4 rounded-3xl shadow-lg border border-white">
        <form method="POST" action="{{ route('simulation.interactive.submit') }}" class="flex gap-4">
            @csrf
            <div class="flex-1 relative">
                <textarea 
                    name="argument" 
                    rows="2" 
                    class="w-full bg-white/50 border-2 border-slate-100 rounded-2xl px-6 py-3 focus:outline-none focus:border-primary-red transition-all resize-none placeholder:text-slate-400 text-slate-700"
                    placeholder="Tuliskan respons Anda di sini (minimal 50 karakter)..."
                    required
                ></textarea>
                @error('argument')
                    <p class="absolute -top-6 left-0 text-xs text-red-600 font-bold bg-white px-2 rounded">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="self-end px-8 py-3 bg-primary-red text-white rounded-2xl font-bold hover:bg-accent-red shadow-lg transition-all transform hover:-translate-y-0.5 active:scale-95 flex items-center gap-2 group">
                <span>Kirim</span>
                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>
        </form>
        <p class="text-[10px] text-slate-400 mt-2 ml-4">Gunakan struktur A-R-E (Assertion, Reasoning, Evidence) untuk hasil maksimal.</p>
    </div>
</div>

<script>
    // Auto-scroll to bottom of chat
    const chatContainer = document.getElementById('chat-container');
    chatContainer.scrollTop = chatContainer.scrollHeight;
</script>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.05); border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(0,0,0,0.1); }
</style>
@endsection
