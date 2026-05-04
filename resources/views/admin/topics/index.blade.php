@extends('admin.layouts.app')

@section('title', 'Simulation Topics')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
    <div>
        <p class="text-sm font-bold text-slate-500">Manage topics used in interactive debate simulations.</p>
    </div>
    <a href="{{ route('admin.topics.create') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-slate-900 text-white font-bold hover:bg-primary-red transition-all shadow-md transform hover:-translate-y-0.5 text-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
        Create New Topic
    </a>
</div>

<div class="grid lg:grid-cols-3 gap-6">
    @foreach($topics as $topic)
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm flex flex-col relative group hover:border-red-200 transition-colors">
            <div class="absolute top-6 right-6">
                <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest
                    {{ $topic->difficulty === 'easy' ? 'bg-green-50 text-green-600' : '' }}
                    {{ $topic->difficulty === 'medium' ? 'bg-orange-50 text-orange-600' : '' }}
                    {{ $topic->difficulty === 'hard' ? 'bg-red-50 text-red-600' : '' }}
                ">
                    {{ ucfirst($topic->difficulty) }}
                </span>
            </div>
            
            <div class="w-14 h-14 rounded-2xl bg-slate-50 text-slate-400 flex items-center justify-center mb-6 group-hover:bg-red-50 group-hover:text-primary-red transition-colors">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
            </div>
            
            <h3 class="text-xl font-black text-slate-900 mb-2 leading-tight">{{ $topic->title }}</h3>
            <p class="text-sm font-medium text-slate-500 mb-8 leading-relaxed">Key: {{ $topic->slug }}</p>
            
            <div class="mt-auto flex items-center gap-2 pt-6 border-t border-slate-50">
                <a href="{{ route('admin.topics.edit', $topic) }}" class="flex-1 py-2.5 rounded-xl bg-slate-50 text-slate-600 font-bold hover:bg-slate-100 transition-colors text-sm text-center">Edit</a>
                <form action="{{ route('admin.topics.destroy', $topic) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus topik ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2.5 rounded-xl bg-red-50 text-red-500 font-bold hover:bg-red-100 transition-colors text-sm">Delete</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
