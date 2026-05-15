@extends('admin.layouts.app')

@section('title', 'Users Overview')

@section('content')
<div class="bg-white border border-slate-100 rounded-[2.5rem] shadow-sm overflow-hidden p-8">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div>
            <h3 class="font-black text-xl text-slate-800">Registered Users</h3>
            <p class="text-sm font-medium text-slate-500">Basic overview of user activity.</p>
        </div>
        <form action="{{ route('admin.users.index') }}" method="GET" class="flex flex-col md:flex-row gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..." class="px-5 py-2.5 rounded-xl bg-slate-50 border border-slate-100 focus:border-primary-red outline-none text-sm font-medium shadow-sm w-full md:w-64">
            <select name="sort" class="px-5 py-2.5 rounded-xl bg-slate-50 border border-slate-100 focus:border-primary-red outline-none text-sm font-medium shadow-sm">
                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                <option value="most_simulations" {{ request('sort') == 'most_simulations' ? 'selected' : '' }}>Paling Aktif</option>
                <option value="least_simulations" {{ request('sort') == 'least_simulations' ? 'selected' : '' }}>Kurang Aktif</option>
            </select>
            <button type="submit" class="px-6 py-2.5 bg-slate-900 text-white rounded-xl font-bold hover:bg-primary-red transition-all text-sm">Cari</button>
            @if(request('search') || request('sort'))
                <a href="{{ route('admin.users.index') }}" class="px-4 py-2.5 bg-slate-100 text-slate-600 rounded-xl font-bold hover:bg-slate-200 transition-all text-sm flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </a>
            @endif
        </form>
    </div>

    <div class="overflow-x-auto custom-scrollbar">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-100 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                    <th class="py-4 px-4">Name</th>
                    <th class="py-4 px-4">Email Address</th>
                    <th class="py-4 px-4 text-center">Simulations Completed</th>
                    <th class="py-4 px-4 text-right">Registered At</th>
                </tr>
            </thead>
            <tbody class="text-sm font-medium text-slate-600">
                @foreach($users as $user)
                    <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                        <td class="py-5 px-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center font-black text-sm text-slate-500">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <span class="font-bold text-slate-800 text-base">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="py-5 px-4 text-slate-500">{{ $user->email }}</td>
                        <td class="py-5 px-4 text-center">
                            <span class="inline-flex items-center justify-center min-w-[2rem] h-8 px-3 rounded-full font-black text-xs
                                {{ $user->simulation_results_count > 10 ? 'bg-green-100 text-green-700' : ($user->simulation_results_count > 0 ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-500') }}
                            ">
                                {{ $user->simulation_results_count }}
                            </span>
                        </td>
                        <td class="py-5 px-4 text-right text-xs text-slate-400 font-bold uppercase tracking-widest">
                            {{ $user->created_at->format('d/m/Y') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
