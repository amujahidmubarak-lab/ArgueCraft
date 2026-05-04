@extends('layouts.app')

@section('title', 'Dashboard - ArgueCraft')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="mb-10">
        <h1 class="text-4xl font-black text-slate-900 mb-2">Halo, {{ Auth::user()->name }}!</h1>
        <p class="text-lg text-slate-600">Selamat datang di ArgueCraft. Apa yang ingin Anda lakukan hari ini?</p>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Modul Pembelajaran -->
        <a href="{{ route('learning.index') }}" class="glass p-8 rounded-3xl group hover:-translate-y-2 transition-all duration-300 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-40 h-40 bg-red-100/50 rounded-full blur-3xl -mr-10 -mt-10 group-hover:bg-red-200/50 transition-colors"></div>
            <div class="relative z-10">
                <div class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center mb-6 text-primary-red group-hover:bg-primary-red group-hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-3 text-slate-900 group-hover:text-primary-red transition-colors">Modul Pembelajaran</h3>
                <p class="text-slate-600 mb-6 text-sm">Pelajari dasar-dasar debat dan teknik menyanggah lawan dengan efektif.</p>
                <span class="inline-flex items-center font-bold text-primary-red text-sm">
                    Mulai Belajar
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </span>
            </div>
        </a>

        <!-- Simulasi Debat -->
        <a href="{{ route('simulation.setup') }}" class="glass p-8 rounded-3xl group hover:-translate-y-2 transition-all duration-300 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-40 h-40 bg-red-100/50 rounded-full blur-3xl -mr-10 -mt-10 group-hover:bg-red-200/50 transition-colors"></div>
            <div class="relative z-10">
                <div class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center mb-6 text-primary-red group-hover:bg-primary-red group-hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-3 text-slate-900 group-hover:text-primary-red transition-colors">Simulasi Mandiri</h3>
                <p class="text-slate-600 mb-6 text-sm">Berlatihlah mempertahankan argumen dalam format simulasi langkah-demi-langkah.</p>
                <span class="inline-flex items-center font-bold text-primary-red text-sm">
                    Mulai Simulasi
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </span>
            </div>
        </a>

        <!-- NEW: Simulasi Interaktif (Chat) -->
        <a href="{{ route('simulation.interactive.setup') }}" class="glass p-8 rounded-3xl group hover:-translate-y-2 transition-all duration-300 relative overflow-hidden border-2 border-primary-red/20 shadow-lg shadow-red-500/5">
            <div class="absolute top-0 right-0 w-40 h-40 bg-red-500/10 rounded-full blur-3xl -mr-10 -mt-10 group-hover:bg-red-500/20 transition-colors"></div>
            <div class="relative z-10">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-14 h-14 bg-primary-red rounded-2xl flex items-center justify-center text-white shadow-lg">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                    </div>
                    <span class="bg-primary-red text-white text-[10px] font-black px-2 py-1 rounded-full uppercase">Baru</span>
                </div>
                <h3 class="text-xl font-bold mb-3 text-slate-900 group-hover:text-primary-red transition-colors">Debat Interaktif</h3>
                <p class="text-slate-600 mb-6 text-sm">Berdebat secara bergantian (turn-based) dengan sistem dalam antarmuka gaya chat.</p>
                <span class="inline-flex items-center font-bold text-primary-red text-sm">
                    Coba Sekarang
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </span>
            </div>
        </a>
    </div>
</div>
@endsection
