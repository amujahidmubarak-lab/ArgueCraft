@extends('admin.layouts.app')

@section('title', isset($topic) ? 'Edit Topic' : 'Create New Topic')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.topics.index') }}" class="text-sm font-bold text-slate-400 hover:text-primary-red transition-colors flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Back to Topics
    </a>
</div>

<div class="bg-white border border-slate-100 rounded-[2rem] shadow-sm p-8 max-w-3xl">
    <form action="{{ isset($topic) ? route('admin.topics.update', $topic) : route('admin.topics.store') }}" method="POST">
        @csrf
        @if(isset($topic))
            @method('PUT')
        @endif

        <div class="space-y-6">
            <div>
                <label class="block text-sm font-black text-slate-700 mb-2">Topic Title / Mosi</label>
                <input type="text" name="title" value="{{ old('title', $topic->title ?? '') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-primary-red/20 focus:border-primary-red transition-all font-medium text-slate-900" required placeholder="e.g. Pendidikan Gratis untuk Semua">
                @error('title') <span class="text-red-500 text-xs font-bold">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Slug (Key)</label>
                    <input type="text" name="slug" value="{{ old('slug', $topic->slug ?? '') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-primary-red/20 focus:border-primary-red transition-all font-medium text-slate-900" required placeholder="e.g. pendidikan-gratis">
                    <p class="text-[10px] text-slate-400 mt-1 uppercase tracking-wider font-bold">Must be unique, no spaces</p>
                    @error('slug') <span class="text-red-500 text-xs font-bold">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Difficulty</label>
                    <select name="difficulty" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-primary-red/20 focus:border-primary-red transition-all font-bold text-slate-900 appearance-none" required>
                        <option value="easy" {{ old('difficulty', $topic->difficulty ?? '') == 'easy' ? 'selected' : '' }}>Easy</option>
                        <option value="medium" {{ old('difficulty', $topic->difficulty ?? '') == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="hard" {{ old('difficulty', $topic->difficulty ?? '') == 'hard' ? 'selected' : '' }}>Hard</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $topic->is_active ?? true) ? 'checked' : '' }} class="w-5 h-5 rounded border-slate-300 text-primary-red focus:ring-primary-red">
                    <span class="text-sm font-bold text-slate-700">Topic is Active and visible to users</span>
                </label>
            </div>
            
            <div class="p-4 bg-orange-50 rounded-xl border border-orange-100">
                <p class="text-xs font-bold text-orange-600">Note: Advanced settings like Stance Keywords and Opponent Arguments JSON editing will be available in the next update.</p>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-slate-100 flex justify-end gap-4">
            <a href="{{ route('admin.topics.index') }}" class="px-6 py-3 rounded-xl font-bold text-slate-500 hover:bg-slate-50 transition-colors">Cancel</a>
            <button type="submit" class="px-6 py-3 rounded-xl bg-slate-900 text-white font-bold hover:bg-primary-red transition-all shadow-md transform hover:-translate-y-0.5">
                {{ isset($topic) ? 'Save Changes' : 'Create Topic' }}
            </button>
        </div>
    </form>
</div>
@endsection
