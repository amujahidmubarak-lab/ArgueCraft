@extends('admin.layouts.app')

@section('title', 'Learning Modules Management')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
    <div>
        <p class="text-sm font-bold text-slate-500">Manage all interactive learning materials.</p>
    </div>
    <a href="{{ route('admin.modules.create') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-slate-900 text-white font-bold hover:bg-primary-red transition-all shadow-md transform hover:-translate-y-0.5 text-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
        Create New Module
    </a>
</div>

<div class="bg-white border border-slate-100 rounded-[2rem] shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100 text-xs font-black text-slate-400 uppercase tracking-widest">
                    <th class="py-5 px-6 font-black">ID</th>
                    <th class="py-5 px-6 font-black">Title & Description</th>
                    <th class="py-5 px-6 font-black">Category/Section</th>
                    <th class="py-5 px-6 font-black text-center">Sections Count</th>
                    <th class="py-5 px-6 font-black text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($modules as $module)
                    <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors group">
                        <td class="py-4 px-6 font-black text-slate-400 group-hover:text-primary-red transition-colors">#{{ $module->id }}</td>
                        <td class="py-4 px-6">
                            <p class="font-bold text-slate-900 text-base mb-1">{{ $module->title }}</p>
                            <p class="text-xs text-slate-500 truncate max-w-xs">{{ $module->description }}</p>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="inline-block px-3 py-1 rounded-lg bg-red-50 text-red-600 font-black">{{ count($module->sections ?? []) }}</span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.modules.edit', $module) }}" class="p-2 text-slate-400 hover:text-blue-500 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Module">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form action="{{ route('admin.modules.destroy', $module) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus modul ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Delete Module">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-12 text-center text-slate-400 font-medium">No modules found. Create one to get started.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination (Mock) -->
    <div class="p-6 border-t border-slate-50 flex items-center justify-between text-sm">
        <p class="text-slate-500 font-medium">Showing <span class="font-bold text-slate-800">1</span> to <span class="font-bold text-slate-800">6</span> of <span class="font-bold text-slate-800">6</span> entries</p>
        <div class="flex gap-2">
            <button disabled class="px-4 py-2 rounded-xl border border-slate-100 text-slate-300 font-bold cursor-not-allowed">Previous</button>
            <button disabled class="px-4 py-2 rounded-xl border border-slate-100 text-slate-300 font-bold cursor-not-allowed">Next</button>
        </div>
    </div>
</div>
@endsection
