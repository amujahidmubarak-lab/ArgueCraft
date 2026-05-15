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

            <div x-data="moduleBuilder({{ isset($module) ? json_encode($module->sections) : '[]' }})">
                <input type="hidden" name="sections" :value="JSON.stringify(sections)">
                
                <div class="space-y-6 pt-6 border-t border-slate-100 mt-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-black text-slate-800">Module Sections</h3>
                            <p class="text-xs text-slate-500">Bangun konten interaktif modul di sini.</p>
                        </div>
                        <div class="flex gap-2">
                            <select x-model="newSectionType" class="px-3 py-2 rounded-lg border border-slate-200 text-sm font-bold bg-white focus:ring-2 focus:ring-primary-red/20 focus:border-primary-red">
                                <option value="concept">Concept (Materi)</option>
                                <option value="comparison">Comparison (Perbandingan)</option>
                                <option value="check">Knowledge Check (Kuis)</option>
                            </select>
                            <button type="button" @click="addSection()" class="px-4 py-2 bg-slate-900 text-white font-bold text-sm rounded-lg hover:bg-primary-red transition-colors shadow-sm whitespace-nowrap">
                                + Add Section
                            </button>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <template x-for="(section, index) in sections" :key="index">
                            <div class="p-6 rounded-xl border border-slate-200 bg-white relative shadow-sm">
                                <button type="button" @click="removeSection(index)" class="absolute top-4 right-4 text-slate-400 hover:text-red-500 transition-colors bg-slate-50 p-1.5 rounded-md hover:bg-red-50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                                
                                <div class="flex items-center gap-3 mb-4">
                                    <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-black uppercase tracking-widest" x-text="section.type"></span>
                                </div>

                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 mb-1">Section Title</label>
                                        <input type="text" x-model="section.title" class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-primary-red/20 text-sm font-bold text-slate-900" placeholder="Judul Bagian">
                                    </div>
                                    
                                    <!-- CONCEPT TYPE -->
                                    <template x-if="section.type === 'concept'">
                                        <div class="space-y-4">
                                            <div>
                                                <label class="block text-xs font-bold text-slate-500 mb-1">Content (Materi Utama)</label>
                                                <textarea x-model="section.content" rows="3" class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-primary-red/20 text-sm text-slate-700"></textarea>
                                            </div>
                                            <div>
                                                <label class="block text-xs font-bold text-slate-500 mb-1">Insight (Pesan Singkat Bawah)</label>
                                                <input type="text" x-model="section.insight" class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-primary-red/20 text-sm text-slate-700" placeholder="Opsional">
                                            </div>
                                        </div>
                                    </template>

                                    <!-- COMPARISON TYPE -->
                                    <template x-if="section.type === 'comparison'">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="p-4 bg-slate-50 rounded-lg border border-slate-200 space-y-3">
                                                <h5 class="font-bold text-sm text-slate-700">Kiri (Contoh Buruk/Lemah)</h5>
                                                <input type="text" x-model="section.left.label" placeholder="Label (cth: Emosional)" class="w-full px-3 py-2 rounded-md border border-slate-200 text-sm font-bold">
                                                <textarea x-model="section.left.content" placeholder="Contoh argumen buruk..." rows="2" class="w-full px-3 py-2 rounded-md border border-slate-200 text-sm"></textarea>
                                                <textarea x-model="section.left.why" placeholder="Kenapa ini buruk?" rows="2" class="w-full px-3 py-2 rounded-md border border-slate-200 text-sm text-slate-600"></textarea>
                                            </div>
                                            <div class="p-4 bg-slate-50 rounded-lg border border-slate-200 space-y-3">
                                                <h5 class="font-bold text-sm text-slate-700">Kanan (Contoh Baik/Kuat)</h5>
                                                <input type="text" x-model="section.right.label" placeholder="Label (cth: Logis)" class="w-full px-3 py-2 rounded-md border border-slate-200 text-sm font-bold">
                                                <textarea x-model="section.right.content" placeholder="Contoh argumen baik..." rows="2" class="w-full px-3 py-2 rounded-md border border-slate-200 text-sm"></textarea>
                                                <textarea x-model="section.right.why" placeholder="Kenapa ini baik?" rows="2" class="w-full px-3 py-2 rounded-md border border-slate-200 text-sm text-slate-600"></textarea>
                                            </div>
                                        </div>
                                    </template>

                                    <!-- CHECK TYPE -->
                                    <template x-if="section.type === 'check'">
                                        <div class="space-y-4">
                                            <div>
                                                <label class="block text-xs font-bold text-slate-500 mb-1">Pertanyaan Kuis</label>
                                                <input type="text" x-model="section.question" class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-primary-red/20 text-sm font-bold">
                                            </div>
                                            <div class="space-y-3 pl-4 border-l-4 border-slate-100">
                                                <label class="block text-xs font-bold text-slate-500">Pilihan Jawaban (Centang yang benar)</label>
                                                <template x-for="(opt, optIdx) in section.options" :key="optIdx">
                                                    <div class="flex gap-3 items-start bg-slate-50 p-3 rounded-lg border border-slate-200">
                                                        <input type="checkbox" x-model="opt.correct" class="mt-2.5 w-5 h-5 rounded border-slate-300 text-primary-red focus:ring-primary-red">
                                                        <div class="flex-1 space-y-2">
                                                            <input type="text" x-model="opt.text" placeholder="Teks pilihan jawaban" class="w-full px-3 py-2 rounded-md border border-slate-200 text-sm">
                                                            <input type="text" x-model="opt.feedback" placeholder="Feedback jika dipilih (cth: Salah, karena...)" class="w-full px-3 py-2 rounded-md border border-slate-200 text-xs text-slate-500">
                                                        </div>
                                                        <button type="button" @click="section.options.splice(optIdx, 1)" class="mt-2 p-1 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                        </button>
                                                    </div>
                                                </template>
                                                <button type="button" @click="section.options.push({text: '', correct: false, feedback: ''})" class="text-xs font-bold text-primary-red hover:text-red-700 flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                                    Tambah Pilihan
                                                </button>
                                            </div>
                                        </div>
                                    </template>
                                    
                                </div>
                            </div>
                        </template>
                        <div x-show="sections.length === 0" class="p-8 text-center border-2 border-dashed border-slate-200 rounded-xl bg-slate-50/50">
                            <p class="text-sm font-bold text-slate-400">Belum ada section. Tambahkan section pertama Anda di atas.</p>
                        </div>
                    </div>
                </div>
            </div>

            @error('sections') <span class="text-red-500 text-xs font-bold">{{ $message }}</span> @enderror
        </div>

        <div class="mt-8 pt-6 border-t border-slate-100 flex justify-end gap-4">
            <a href="{{ route('admin.modules.index') }}" class="px-6 py-3 rounded-xl font-bold text-slate-500 hover:bg-slate-50 transition-colors">Cancel</a>
            <button type="submit" class="px-6 py-3 rounded-xl bg-slate-900 text-white font-bold hover:bg-primary-red transition-all shadow-md transform hover:-translate-y-0.5">
                {{ isset($module) ? 'Save Changes' : 'Create Module' }}
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('moduleBuilder', (initialSections) => ({
        sections: initialSections || [],
        newSectionType: 'concept',
        
        addSection() {
            let base = { type: this.newSectionType, title: '', icon: 'brain' };
            if (this.newSectionType === 'concept') {
                base.content = '';
                base.insight = '';
            } else if (this.newSectionType === 'comparison') {
                base.left = { label: '', content: '', why: '' };
                base.right = { label: '', content: '', why: '' };
            } else if (this.newSectionType === 'check') {
                base.question = '';
                base.options = [
                    { text: '', correct: false, feedback: '' },
                    { text: '', correct: false, feedback: '' }
                ];
            }
            this.sections.push(base);
        },
        removeSection(index) {
            if(confirm('Hapus section ini?')) {
                this.sections.splice(index, 1);
            }
        }
    }));
});
</script>
@endsection
