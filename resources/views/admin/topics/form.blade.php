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
            
            <div class="space-y-6 pt-6 border-t border-slate-100">
                <h3 class="text-lg font-black text-slate-800">Stance Keywords (Kata Kunci)</h3>
                <p class="text-xs text-slate-500">Pisahkan dengan koma. Digunakan sistem untuk mendeteksi relevansi argumen user.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Pro Keywords</label>
                        <textarea name="stance_keywords[pro]" rows="2" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-primary-red/20 focus:border-primary-red transition-all text-sm" placeholder="hak, merata, investasi, akses...">{{ isset($topic) && isset($topic->stance_keywords['pro']) ? implode(', ', $topic->stance_keywords['pro']) : '' }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Kontra Keywords</label>
                        <textarea name="stance_keywords[kontra]" rows="2" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-primary-red/20 focus:border-primary-red transition-all text-sm" placeholder="anggaran, beban, pajak, kualitas...">{{ isset($topic) && isset($topic->stance_keywords['kontra']) ? implode(', ', $topic->stance_keywords['kontra']) : '' }}</textarea>
                    </div>
                </div>
            </div>

            <div class="space-y-6 pt-6 border-t border-slate-100">
                <h3 class="text-lg font-black text-slate-800">Opponent Arguments (Argumen Lawan)</h3>
                <p class="text-xs text-slate-500">Jawaban otomatis bot di setiap fase debat.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- If User Pro -->
                    <div class="space-y-4 p-4 rounded-xl border border-slate-100 bg-slate-50/50">
                        <h4 class="font-bold text-slate-700 mb-4 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                            Jika User PRO (Bot membalas sbg KONTRA)
                        </h4>
                        @for ($i = 1; $i <= 4; $i++)
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-1">Fase {{ $i }}</label>
                                <textarea name="opponent_arguments[pro][{{ $i }}]" rows="2" class="w-full px-3 py-2 rounded-lg border border-slate-200 bg-white focus:ring-2 focus:ring-primary-red/20 focus:border-primary-red transition-all text-sm">{{ $topic->opponent_arguments['pro'][$i] ?? '' }}</textarea>
                            </div>
                        @endfor
                    </div>

                    <!-- If User Kontra -->
                    <div class="space-y-4 p-4 rounded-xl border border-slate-100 bg-slate-50/50">
                        <h4 class="font-bold text-slate-700 mb-4 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-red-500"></span>
                            Jika User KONTRA (Bot membalas sbg PRO)
                        </h4>
                        @for ($i = 1; $i <= 4; $i++)
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-1">Fase {{ $i }}</label>
                                <textarea name="opponent_arguments[kontra][{{ $i }}]" rows="2" class="w-full px-3 py-2 rounded-lg border border-slate-200 bg-white focus:ring-2 focus:ring-primary-red/20 focus:border-primary-red transition-all text-sm">{{ $topic->opponent_arguments['kontra'][$i] ?? '' }}</textarea>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            <div class="space-y-6 pt-6 border-t border-slate-100">
                <h3 class="text-lg font-black text-slate-800">Example Arguments (Contoh Jawaban)</h3>
                <p class="text-xs text-slate-500">Disediakan sebagai referensi opsional bagi pengguna yang kebingungan ("Lihat Contoh" fitur).</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Example PRO -->
                    <div class="space-y-4 p-4 rounded-xl border border-slate-100 bg-slate-50/50">
                        <h4 class="font-bold text-slate-700 mb-4 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                            Contoh Jawaban PRO
                        </h4>
                        @for ($i = 1; $i <= 5; $i++)
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-1">Fase {{ $i }}</label>
                                <textarea name="example_arguments[pro][{{ $i }}]" rows="2" class="w-full px-3 py-2 rounded-lg border border-slate-200 bg-white focus:ring-2 focus:ring-primary-red/20 focus:border-primary-red transition-all text-sm">{{ $topic->example_arguments['pro'][$i] ?? '' }}</textarea>
                            </div>
                        @endfor
                    </div>

                    <!-- Example KONTRA -->
                    <div class="space-y-4 p-4 rounded-xl border border-slate-100 bg-slate-50/50">
                        <h4 class="font-bold text-slate-700 mb-4 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-red-500"></span>
                            Contoh Jawaban KONTRA
                        </h4>
                        @for ($i = 1; $i <= 5; $i++)
                            <div>
                                <label class="block text-xs font-bold text-slate-500 mb-1">Fase {{ $i }}</label>
                                <textarea name="example_arguments[kontra][{{ $i }}]" rows="2" class="w-full px-3 py-2 rounded-lg border border-slate-200 bg-white focus:ring-2 focus:ring-primary-red/20 focus:border-primary-red transition-all text-sm">{{ $topic->example_arguments['kontra'][$i] ?? '' }}</textarea>
                            </div>
                        @endfor
                    </div>
                </div>
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
