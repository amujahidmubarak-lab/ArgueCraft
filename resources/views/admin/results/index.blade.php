@extends('admin.layouts.app')

@section('title', 'Simulation Results')

@section('content')
<div class="bg-white border border-slate-100 rounded-[2.5rem] shadow-sm overflow-hidden p-8 mb-8">
    <div class="flex flex-col md:flex-row gap-4 justify-between items-center mb-6">
        <h3 class="font-black text-xl text-slate-800">Recent Debate Simulations</h3>
    </div>

    <!-- Filter Bar -->
    <div class="mb-8 p-6 bg-slate-50/50 rounded-2xl border border-slate-100">
        <form action="{{ route('admin.results.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari user atau topik..." class="w-full px-5 py-2.5 rounded-xl bg-white border border-slate-200 focus:border-primary-red outline-none text-sm font-medium shadow-sm">
            </div>
            <div class="w-full md:w-48">
                <select name="stance" class="w-full px-5 py-2.5 rounded-xl bg-white border border-slate-200 focus:border-primary-red outline-none text-sm font-medium shadow-sm">
                    <option value="">Semua Posisi</option>
                    <option value="pro" {{ request('stance') == 'pro' ? 'selected' : '' }}>PRO</option>
                    <option value="kontra" {{ request('stance') == 'kontra' ? 'selected' : '' }}>KONTRA</option>
                </select>
            </div>
            <div class="w-full md:w-48">
                <select name="sort" class="w-full px-5 py-2.5 rounded-xl bg-white border border-slate-200 focus:border-primary-red outline-none text-sm font-medium shadow-sm">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                    <option value="highest_score" {{ request('sort') == 'highest_score' ? 'selected' : '' }}>Skor Tertinggi</option>
                    <option value="lowest_score" {{ request('sort') == 'lowest_score' ? 'selected' : '' }}>Skor Terendah</option>
                </select>
            </div>
            <button type="submit" class="px-8 py-2.5 bg-slate-900 text-white rounded-xl font-bold hover:bg-primary-red transition-all text-sm shadow-sm">Filter</button>
            <a href="{{ route('admin.results.index') }}" class="px-8 py-2.5 bg-white text-slate-600 border border-slate-200 rounded-xl font-bold hover:bg-slate-50 transition-all text-sm shadow-sm text-center">Reset</a>
        </form>
    </div>

    <div class="overflow-x-auto custom-scrollbar">
        <table class="w-full text-left border-collapse min-w-[800px]">
            <thead>
                <tr class="border-b border-slate-100 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                    <th class="py-4 px-4">User</th>
                    <th class="py-4 px-4">Topic</th>
                    <th class="py-4 px-4 text-center">Score</th>
                    <th class="py-4 px-4 text-right">Date</th>
                </tr>
            </thead>
            <tbody class="text-sm font-medium text-slate-600">
                @forelse($results as $res)
                    <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                        <td class="py-4 px-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center font-black text-xs text-slate-500">
                                    {{ substr($res->user->name ?? '?', 0, 1) }}
                                </div>
                                <span class="font-bold text-slate-800">{{ $res->user->name ?? 'Deleted User' }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-4 text-slate-500">{{ $res->topic->title ?? 'Deleted Topic' }}</td>
                        <td class="py-4 px-4 text-center">
                            <span class="inline-flex items-center justify-center px-3 py-1 rounded-full font-black text-xs
                                {{ $res->total_score >= 90 ? 'bg-green-100 text-green-700' : ($res->total_score >= 80 ? 'bg-blue-100 text-blue-700' : 'bg-orange-100 text-orange-700') }}
                            ">
                                {{ $res->total_score }}
                            </span>
                        </td>
                        <td class="py-4 px-4 text-right text-xs text-slate-400 font-bold uppercase tracking-widest">
                            {{ $res->created_at->format('d M Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-12 text-center text-slate-400 font-medium italic">Belum ada riwayat simulasi yang terekam.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
