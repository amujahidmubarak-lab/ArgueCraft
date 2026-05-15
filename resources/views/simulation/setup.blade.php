@extends('layouts.app')

@section('title', 'Persiapan Simulasi - ArgueCraft')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Clean Header -->
    <div class="text-center mb-8">
        <span class="text-[10px] font-black text-primary-red uppercase tracking-widest block mb-2">Langkah Awal</span>
        <h1 class="text-3xl md:text-4xl font-black text-slate-900 mb-3">Persiapan Simulasi</h1>
        <p class="text-base text-slate-600">Pilih topik dan tentukan posisi Anda sebelum memulai simulasi debat.</p>
    </div>

    <div class="bg-white p-8 md:p-10 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-slate-50 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-red-100/50 rounded-full blur-3xl -mr-20 -mt-20"></div>
        
        <form method="POST" action="{{ route('simulation.start') }}" class="relative z-10 space-y-8">
            @csrf

            <!-- Pilihan Topik -->
            <div>
                <label class="block text-lg font-bold text-slate-900 mb-4">1. Pilih Topik Debat</label>
                <div class="space-y-3">
                    @foreach ($topics as $topic)
                        <label class="flex items-center p-4 border-2 border-slate-200 rounded-2xl cursor-pointer hover:bg-white/50 hover:border-primary-red/50 transition-all group has-[:checked]:border-primary-red has-[:checked]:bg-white">
                            <input type="radio" name="topic" value="{{ $topic->slug }}" class="w-5 h-5 text-primary-red focus:ring-primary-red border-slate-300" {{ $loop->first ? 'checked' : '' }}>
                            <span class="ml-4 text-slate-700 font-medium group-has-[:checked]:text-primary-red group-has-[:checked]:font-bold">{{ $topic->title }}</span>
                        </label>
                    @endforeach
                </div>
                @error('topic')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pilihan Posisi -->
            <div>
                <label class="block text-lg font-bold text-slate-900 mb-4">2. Tentukan Posisi Anda</label>
                <div class="grid grid-cols-2 gap-4">
                    <label class="flex flex-col items-center justify-center p-6 border-2 border-slate-200 rounded-2xl cursor-pointer hover:bg-white/50 hover:border-primary-red/50 transition-all group has-[:checked]:border-primary-red has-[:checked]:bg-white">
                        <input type="radio" name="position" value="pro" class="sr-only" checked>
                        <span class="w-12 h-12 rounded-full bg-green-100 text-green-600 flex items-center justify-center mb-3 group-has-[:checked]:bg-green-500 group-has-[:checked]:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </span>
                        <span class="text-slate-700 font-bold group-has-[:checked]:text-primary-red">PRO (Mendukung)</span>
                    </label>
                    
                    <label class="flex flex-col items-center justify-center p-6 border-2 border-slate-200 rounded-2xl cursor-pointer hover:bg-white/50 hover:border-primary-red/50 transition-all group has-[:checked]:border-primary-red has-[:checked]:bg-white">
                        <input type="radio" name="position" value="kontra" class="sr-only">
                        <span class="w-12 h-12 rounded-full bg-red-100 text-red-600 flex items-center justify-center mb-3 group-has-[:checked]:bg-red-500 group-has-[:checked]:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </span>
                        <span class="text-slate-700 font-bold group-has-[:checked]:text-primary-red">KONTRA (Menolak)</span>
                    </label>
                </div>
                @error('position')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full py-4 bg-primary-red text-white rounded-xl font-bold text-lg shadow-lg shadow-red-500/30 hover:shadow-red-500/50 hover:bg-accent-red transition-all transform hover:-translate-y-0.5">
                    Mulai Simulasi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
