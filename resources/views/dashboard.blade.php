@extends('layouts.app')

@section('title', 'Portal User - ArgueCraft')

@section('content')
<div class="max-w-4xl mx-auto space-y-10 page-fade-in" x-data="{ mode: '{{ request('view') === 'simulasi' ? 'simulasi' : 'select' }}' }">
    
    <!-- Main Dashboard View -->
    <div x-show="mode === 'select'" x-transition:enter="transition ease-out duration-300" class="space-y-10">
        <div class="text-center md:text-left">
            <h1 class="text-3xl font-black text-slate-900 mb-1 tracking-tight">Halo, {{ Auth::user()->name }}! 👋</h1>
            <p class="text-base text-slate-600 font-medium">Selamat datang kembali. Pilih aktivitas Anda.</p>
        </div>

        <div class="grid md:grid-cols-2 gap-6 items-stretch">
            <!-- Modul Pembelajaran Card -->
            <a href="{{ route('learning.index') }}" class="glass p-8 rounded-[2rem] group card-hover relative overflow-hidden border border-white flex flex-col justify-between min-h-[200px]">
                <div class="absolute top-0 right-0 w-32 h-32 bg-red-100/10 rounded-full blur-2xl -mr-10 -mt-10"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-red-50 rounded-2xl flex items-center justify-center mb-5 text-primary-red group-hover:bg-primary-red group-hover:text-white transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black mb-1 text-slate-900">Mulai Belajar</h3>
                    <p class="text-slate-500 text-xs font-medium leading-relaxed">Pahami dasar-dasar debat.</p>
                </div>
                <div class="flex items-center font-black text-primary-red text-[9px] uppercase tracking-[0.2em] relative z-10 pt-4">
                    Buka Modul
                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </div>
            </a>

            <!-- Simulasi Card -->
            <button @click="mode = 'simulasi'" class="glass p-8 rounded-[2rem] group card-hover relative overflow-hidden border border-white text-left flex flex-col justify-between min-h-[200px]">
                <div class="absolute top-0 right-0 w-32 h-32 bg-slate-100/30 rounded-full blur-2xl -mr-10 -mt-10 group-hover:bg-slate-200/40 transition-colors"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-slate-100 rounded-2xl flex items-center justify-center mb-5 text-slate-700 group-hover:bg-slate-900 group-hover:text-white transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black mb-1 text-slate-900">Latihan Simulasi</h3>
                    <p class="text-slate-500 text-xs font-medium leading-relaxed">Uji argumen Anda.</p>
                </div>
                <div class="flex items-center font-black text-slate-700 text-[9px] uppercase tracking-[0.2em] relative z-10 pt-4">
                    Pilih Mode
                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </div>
            </button>
        </div>
    </div>

    <!-- Simulation Selection View -->
    <div x-show="mode === 'simulasi'" x-cloak x-transition:enter="transition ease-out duration-300 transform scale-95 opacity-0" x-transition:enter-end="transform scale-100 opacity-100" class="space-y-8">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Pilih Mode <span class="text-primary-red">Simulasi</span></h2>
                <p class="text-sm text-slate-500 font-medium">Pilih metode latihan yang paling sesuai untuk Anda.</p>
            </div>
            <button @click="mode = 'select'" class="w-10 h-10 rounded-full bg-white border border-slate-100 flex items-center justify-center text-slate-400 hover:text-primary-red hover:border-primary-red transition-all shadow-sm group">
                <svg class="w-5 h-5 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Mode Standard -->
            <a href="{{ route('simulation.setup') }}" class="glass p-8 rounded-[2rem] group card-hover relative overflow-hidden border border-white flex flex-col items-center text-center">
                <div class="w-14 h-14 bg-slate-50 text-slate-400 rounded-2xl flex items-center justify-center mb-5 group-hover:bg-slate-900 group-hover:text-white transition-all duration-300">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <h4 class="text-xl font-black text-slate-900 mb-2">Simulasi Standar</h4>
                <p class="text-slate-400 text-xs font-medium leading-relaxed mb-6">Latihan formal dengan fase Opening hingga Closing yang terpandu.</p>
                <div class="mt-auto px-6 py-2 bg-slate-50 text-slate-400 text-[10px] font-black uppercase tracking-widest rounded-full group-hover:bg-slate-900 group-hover:text-white transition-all">Pilih Mode</div>
            </a>

            <!-- Mode Interactive -->
            <a href="{{ route('simulation.interactive.setup') }}" class="glass p-8 rounded-[2rem] group card-hover relative overflow-hidden border border-white flex flex-col items-center text-center">
                <div class="w-14 h-14 bg-red-50 text-primary-red rounded-2xl flex items-center justify-center mb-5 group-hover:bg-primary-red group-hover:text-white transition-all duration-300">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                </div>
                <h4 class="text-xl font-black text-slate-900 mb-2">Debat Interaktif</h4>
                <p class="text-slate-400 text-xs font-medium leading-relaxed mb-6">Latih kecepatan berpikir dengan mode chat real-time melawan sistem.</p>
                <div class="mt-auto px-6 py-2 bg-red-50 text-primary-red text-[10px] font-black uppercase tracking-widest rounded-full group-hover:bg-primary-red group-hover:text-white transition-all">Pilih Mode</div>
            </a>
        </div>
    </div>

    <!-- Quick Summary Section -->
    <div class="bg-slate-900 rounded-[2rem] p-8 text-white relative overflow-hidden shadow-xl mt-12">
        <div class="absolute top-0 right-0 w-48 h-48 bg-primary-red/20 rounded-full blur-3xl -mr-10 -mt-10"></div>
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="text-center md:text-left">
                <h3 class="text-xl font-black mb-1">Ringkasan Progres</h3>
                <p class="text-slate-400 text-[11px] font-medium">Total <span class="text-white font-bold">{{ $totalSimulations }} sesi</span> latihan.</p>
            </div>
            
            <div class="flex gap-8">
                <div class="text-center">
                    <p class="text-slate-500 text-[9px] font-black uppercase tracking-[0.2em] mb-1">Rata-rata</p>
                    <p class="text-2xl font-black tracking-tight">{{ $avgScore }}</p>
                </div>
                <div class="text-center">
                    <p class="text-slate-500 text-[9px] font-black uppercase tracking-[0.2em] mb-1">Tertinggi</p>
                    <p class="text-2xl font-black text-primary-red tracking-tight">{{ $highestScore }}</p>
                </div>
            </div>

            <a href="{{ route('dashboard.stats') }}" class="px-6 py-3 bg-white text-slate-900 rounded-xl font-black hover:bg-primary-red hover:text-white transition-all transform hover:scale-105 active:scale-95 text-xs">
                Lihat Statistik
            </a>
        </div>
    </div>
</div>
@endsection
