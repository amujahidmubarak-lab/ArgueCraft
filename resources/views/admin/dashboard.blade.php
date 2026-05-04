@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<!-- Stat Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-5">
        <div class="w-14 h-14 rounded-2xl bg-slate-50 text-slate-500 flex items-center justify-center">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
        </div>
        <div>
            <p class="text-xs font-black uppercase tracking-widest text-slate-400 mb-1">Total Users</p>
            <p class="text-3xl font-black text-slate-900">{{ $stats['users'] }}</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-5">
        <div class="w-14 h-14 rounded-2xl bg-red-50 text-primary-red flex items-center justify-center">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
        </div>
        <div>
            <p class="text-xs font-black uppercase tracking-widest text-slate-400 mb-1">Learning Modules</p>
            <p class="text-3xl font-black text-slate-900">{{ $stats['modules'] }}</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-5">
        <div class="w-14 h-14 rounded-2xl bg-green-50 text-green-500 flex items-center justify-center">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
        </div>
        <div>
            <p class="text-xs font-black uppercase tracking-widest text-slate-400 mb-1">Simulations Done</p>
            <p class="text-3xl font-black text-slate-900">{{ $stats['simulations'] }}</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-5">
        <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
        </div>
        <div>
            <p class="text-xs font-black uppercase tracking-widest text-slate-400 mb-1">Top Topic</p>
            <p class="text-sm font-bold text-slate-800 leading-tight">{{ $stats['top_topic'] }}</p>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid lg:grid-cols-2 gap-8">
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
        <div class="p-6 border-b border-slate-50 flex justify-between items-center">
            <h3 class="font-black text-slate-800 text-lg">System Quick Actions</h3>
        </div>
        <div class="p-6 flex-1 flex flex-col justify-center gap-4">
            <a href="{{ route('admin.modules.create') }}" class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 hover:bg-red-50 border border-slate-100 hover:border-red-100 transition-colors group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-slate-400 group-hover:text-primary-red shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </div>
                    <div>
                        <p class="font-bold text-slate-800">Add New Learning Module</p>
                        <p class="text-xs text-slate-500 font-medium">Create a new lesson with sections.</p>
                    </div>
                </div>
                <svg class="w-5 h-5 text-slate-300 group-hover:text-primary-red transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
            
            <a href="{{ route('admin.topics.create') }}" class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 hover:bg-red-50 border border-slate-100 hover:border-red-100 transition-colors group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-slate-400 group-hover:text-primary-red shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </div>
                    <div>
                        <p class="font-bold text-slate-800">Add New Simulation Topic</p>
                        <p class="text-xs text-slate-500 font-medium">Create a new debate topic for practice.</p>
                    </div>
                </div>
                <svg class="w-5 h-5 text-slate-300 group-hover:text-primary-red transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
    </div>

    <div class="bg-slate-900 rounded-3xl shadow-sm overflow-hidden text-white p-8 relative flex flex-col justify-end min-h-[300px]">
        <div class="absolute top-0 right-0 w-64 h-64 bg-red-500/20 rounded-full blur-3xl -mr-10 -mt-10 pointer-events-none"></div>
        <div class="relative z-10">
            <span class="inline-block px-3 py-1 rounded-full bg-white/10 text-[10px] font-black uppercase tracking-widest text-red-300 mb-4 border border-white/5">System Status</span>
            <h3 class="text-3xl font-black tracking-tight mb-2">Semua Sistem Normal</h3>
            <p class="text-slate-400 text-sm font-medium leading-relaxed mb-6">Database, sesi simulasi interaktif, dan pelacakan progress modul belajar beroperasi tanpa kendala.</p>
            <a href="/" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white text-slate-900 font-bold hover:bg-slate-100 transition-colors text-sm">
                Lihat Website
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
            </a>
        </div>
    </div>
</div>
@endsection
