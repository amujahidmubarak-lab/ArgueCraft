@extends('layouts.app')

@section('title', 'Modul Pembelajaran - ArgueCraft')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-10">
        <div class="inline-block px-4 py-1.5 mb-4 rounded-full bg-red-100 text-primary-red font-semibold text-sm tracking-wide uppercase">
            Kurikulum Dasar
        </div>
        <h1 class="text-4xl font-black text-slate-900 mb-2">Modul Pembelajaran</h1>
        <p class="text-lg text-slate-600">Pelajari dasar-dasar sebelum Anda memulai simulasi debat sesungguhnya.</p>
    </div>

    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-primary-red text-red-700 p-4 mb-8 rounded-r-lg" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-8 rounded-r-lg" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="space-y-6">
        @php
            // Calculate progress based on highest completed module ID + 1 (very simple logic for now)
            $progress = 1;
            if (count($completedModules) > 0) {
                $progress = max($completedModules) + 1;
            }
        @endphp

        @foreach ($modules as $module)
            @php
                $isLocked = $module->id > $progress;
                $isCompleted = in_array($module->id, $completedModules);
                $isCurrent = $module->id == $progress;
            @endphp
            
            <div class="glass p-6 md:p-8 rounded-3xl transition-all {{ $isLocked ? 'opacity-60 grayscale' : 'hover:-translate-y-1 shadow-md' }}">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div class="flex items-center gap-6 flex-1">
                        <!-- Number / Icon -->
                        <div class="w-16 h-16 shrink-0 rounded-2xl flex items-center justify-center font-black text-2xl
                            {{ $isCompleted ? 'bg-green-100 text-green-600' : ($isCurrent ? 'bg-primary-red text-white shadow-lg shadow-red-500/30' : 'bg-slate-100 text-slate-400') }}">
                            @if ($isCompleted)
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            @else
                                {{ $module->id }}
                            @endif
                        </div>
                        
                        <!-- Info -->
                        <div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-1 flex items-center gap-2">
                                {{ $module->title }}
                                @if ($isLocked)
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                @endif
                            </h3>
                            <p class="text-slate-600">{{ $module->description }}</p>
                        </div>
                    </div>
                    
                    <!-- Action -->
                    <div>
                        @if ($isLocked)
                            <button disabled class="px-6 py-3 rounded-xl font-bold bg-slate-100 text-slate-400 cursor-not-allowed">
                                Terkunci
                            </button>
                        @elseif ($isCompleted)
                            <a href="{{ route('learning.show', $module) }}" class="inline-block px-6 py-3 rounded-xl font-bold bg-slate-100 text-slate-700 hover:bg-slate-200 transition-colors">
                                Ulangi
                            </a>
                        @else
                            <a href="{{ route('learning.show', $module) }}" class="inline-block px-6 py-3 rounded-xl font-bold bg-primary-red text-white shadow-lg hover:bg-accent-red transition-all transform hover:scale-105">
                                Mulai
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
