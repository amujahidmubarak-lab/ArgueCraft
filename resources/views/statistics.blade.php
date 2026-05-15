@extends('layouts.app')

@section('title', 'Statistik Progres - ArgueCraft')

@section('content')
<div class="max-w-5xl mx-auto space-y-8 page-fade-in">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-4xl font-black text-slate-900 mb-1 tracking-tight">Statistik <span class="text-primary-red">Progres</span></h1>
            <p class="text-base text-slate-500 font-medium">Analisis performa latihan debat Anda.</p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn-premium px-6 py-2.5 bg-white text-slate-700 rounded-xl font-bold text-xs border border-slate-100 flex items-center gap-2">
            <svg class="w-4 h-4 text-primary-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    <!-- Stat Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Simulations -->
        <div class="glass p-6 rounded-3xl card-hover relative overflow-hidden group border border-white">
            <div class="flex items-center gap-4 relative z-10">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Sesi</p>
                    <p class="text-2xl font-black text-slate-900">{{ $totalSimulations }}</p>
                </div>
            </div>
        </div>
        
        <!-- Average Score -->
        <div class="glass p-6 rounded-3xl card-hover relative overflow-hidden group border border-white">
            <div class="flex items-center gap-4 relative z-10">
                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center group-hover:bg-amber-600 group-hover:text-white transition-all duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Rata-rata</p>
                    <p class="text-2xl font-black text-slate-900">{{ $avgScore }}<span class="text-xs text-slate-300 ml-1">/100</span></p>
                </div>
            </div>
        </div>

        <!-- Highest Score -->
        <div class="glass p-6 rounded-3xl card-hover relative overflow-hidden group border border-white">
            <div class="flex items-center gap-4 relative z-10">
                <div class="w-12 h-12 bg-red-50 text-primary-red rounded-xl flex items-center justify-center group-hover:bg-primary-red group-hover:text-white transition-all duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tertinggi</p>
                    <p class="text-2xl font-black text-slate-900">{{ $highestScore }}<span class="text-xs text-slate-300 ml-1">/100</span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Analytics Section -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Main Chart Card -->
        <div class="lg:col-span-7 glass p-8 rounded-[2rem] shadow-sm relative overflow-hidden flex flex-col border border-white">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-black text-slate-900">Perkembangan Skor</h3>
                <span class="px-3 py-1 bg-slate-100 text-slate-500 text-[9px] font-black uppercase tracking-widest rounded-full">Last 10 Sessions</span>
            </div>
            
            @if(count($chartScores) > 0)
                <div class="relative h-[250px] w-full">
                    <canvas id="scoreChart"></canvas>
                </div>
            @else
                <div class="flex-1 flex flex-col items-center justify-center min-h-[250px] text-slate-400">
                    <p class="text-sm font-bold">Belum ada data latihan.</p>
                </div>
            @endif
        </div>

        <!-- Recent Activity Feed -->
        <div class="lg:col-span-5 glass p-8 rounded-[2rem] shadow-sm relative overflow-hidden flex flex-col border border-white">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-black text-slate-900">Aktivitas Terakhir</h3>
                <svg class="w-5 h-5 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>

            @if(count($recentHistory) > 0)
                <div class="space-y-3 flex-1 overflow-y-auto pr-1 custom-scrollbar">
                    @foreach($recentHistory as $history)
                    <div class="p-4 rounded-2xl bg-white/50 border border-slate-50 flex justify-between items-center card-hover">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center text-lg
                                {{ $history['type'] == 'Standard' ? 'bg-indigo-50 text-indigo-500' : 'bg-rose-50 text-rose-500' }}">
                                @if($history['type'] == 'Standard')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                @else
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                @endif
                            </div>
                            <div>
                                <p class="text-xs font-black text-slate-800">{{ $history['type'] }}</p>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tight">{{ $history['date']->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-black {{ $history['score'] >= 70 ? 'text-green-500' : ($history['score'] >= 40 ? 'text-amber-500' : 'text-red-500') }}">
                                {{ $history['score'] }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="flex-1 flex items-center justify-center text-slate-300 italic text-xs">Belum ada aktivitas.</div>
            @endif
        </div>
    </div>

    <!-- Bottom Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('simulation.setup') }}" class="glass p-6 rounded-3xl group card-hover flex items-center gap-6 border border-white">
            <div class="w-14 h-14 bg-slate-900 rounded-2xl flex items-center justify-center text-white shrink-0 group-hover:bg-primary-red transition-colors shadow-md">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            </div>
            <div>
                <h4 class="text-base font-black text-slate-900 mb-0.5">Simulasi Standar</h4>
                <p class="text-slate-400 text-xs font-medium">Latihan struktur formal.</p>
            </div>
        </a>

        <a href="{{ route('simulation.interactive.setup') }}" class="glass p-6 rounded-3xl group card-hover flex items-center gap-6 border border-white">
            <div class="w-14 h-14 bg-red-50 text-primary-red rounded-2xl flex items-center justify-center shrink-0 group-hover:bg-primary-red group-hover:text-white transition-all shadow-sm">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
            </div>
            <div>
                <h4 class="text-base font-black text-slate-900 mb-0.5">Debat Interaktif</h4>
                <p class="text-slate-400 text-xs font-medium">Mode chat real-time.</p>
            </div>
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('scoreChart');
        if (ctx) {
            const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(230, 57, 70, 0.15)');
            gradient.addColorStop(1, 'rgba(230, 57, 70, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartLabels ?? []) !!},
                    datasets: [{
                        label: 'Skor',
                        data: {!! json_encode($chartScores ?? []) !!},
                        borderColor: '#E63946',
                        backgroundColor: gradient,
                        borderWidth: 3,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#E63946',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            padding: 8,
                            cornerRadius: 6,
                            displayColors: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            grid: { color: 'rgba(0,0,0,0.02)', drawBorder: false },
                            ticks: { font: { size: 10, weight: 'bold' }, color: '#94a3b8' }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { font: { size: 10, weight: 'bold' }, color: '#94a3b8' }
                        }
                    }
                }
            });
        }
    });
</script>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 3px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.05); border-radius: 10px; }
</style>
@endsection
