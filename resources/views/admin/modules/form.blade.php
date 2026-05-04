@extends('admin.layouts.app')

@section('title', isset($module) ? 'Edit Module' : 'Create New Module')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.modules.index') }}" class="text-sm font-bold text-slate-400 hover:text-primary-red transition-colors flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Back to Modules
    </a>
</div>

<div class="bg-white border border-slate-100 rounded-[2rem] shadow-sm p-8 max-w-3xl">
    <form action="{{ isset($module) ? route('admin.modules.update', $module) : route('admin.modules.store') }}" method="POST">
        @csrf
        @if(isset($module))
            @method('PUT')
        @endif

        <div class="space-y-6">
            <div>
                <label class="block text-sm font-black text-slate-700 mb-2">Module Title</label>
                <input type="text" name="title" value="{{ old('title', $module->title ?? '') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-primary-red/20 focus:border-primary-red transition-all font-medium text-slate-900" required placeholder="e.g. Struktur Argumen (A-R-E)">
                @error('title') <span class="text-red-500 text-xs font-bold">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-black text-slate-700 mb-2">Description</label>
                <textarea name="description" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-primary-red/20 focus:border-primary-red transition-all font-medium text-slate-900" required placeholder="Short description about this module...">{{ old('description', $module->description ?? '') }}</textarea>
                @error('description') <span class="text-red-500 text-xs font-bold">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Badge Icon (SVG Path)</label>
                    <input type="text" name="badge_icon" value="{{ old('badge_icon', $module->badge_icon ?? 'M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white font-mono text-xs text-slate-600" required>
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Badge Color Classes</label>
                    <input type="text" name="badge_color" value="{{ old('badge_color', $module->badge_color ?? 'bg-red-50 text-primary-red') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white font-mono text-xs text-slate-600" required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-black text-slate-700 mb-2">Sections (JSON Format)</label>
                <p class="text-xs text-slate-400 mb-2">Define the module's interactive content here using valid JSON array of objects.</p>
                <textarea name="sections" rows="10" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-900 text-green-400 font-mono text-sm focus:ring-2 focus:ring-primary-red/20 transition-all custom-scrollbar" required>{{ old('sections', isset($module) ? json_encode($module->sections, JSON_PRETTY_PRINT) : "[\n    {\n        \"type\": \"concept\",\n        \"title\": \"Judul Bagian\",\n        \"content\": \"Isi materi...\"\n    }\n]") }}</textarea>
                @error('sections') <span class="text-red-500 text-xs font-bold">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-slate-100 flex justify-end gap-4">
            <a href="{{ route('admin.modules.index') }}" class="px-6 py-3 rounded-xl font-bold text-slate-500 hover:bg-slate-50 transition-colors">Cancel</a>
            <button type="submit" class="px-6 py-3 rounded-xl bg-slate-900 text-white font-bold hover:bg-primary-red transition-all shadow-md transform hover:-translate-y-0.5">
                {{ isset($module) ? 'Save Changes' : 'Create Module' }}
            </button>
        </div>
    </form>
</div>
@endsection
