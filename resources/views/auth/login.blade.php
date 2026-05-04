@extends('layouts.app')

@section('title', 'Masuk - ArgueCraft')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <div class="glass p-8 rounded-3xl shadow-xl relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-primary-red/10 rounded-full blur-2xl -mr-10 -mt-10"></div>
        
        <div class="text-center mb-8 relative z-10">
            <h1 class="text-3xl font-black text-slate-900 mb-2">Selamat Datang Kembali</h1>
            <p class="text-slate-600">Masuk untuk melanjutkan debat Anda.</p>
        </div>

        <form method="POST" action="{{ route('login.post') }}" class="relative z-10 space-y-6">
            @csrf

            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary-red focus:ring-2 focus:ring-primary-red/20 outline-none transition-all bg-white/50 backdrop-blur-sm">
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-primary-red focus:ring-2 focus:ring-primary-red/20 outline-none transition-all bg-white/50 backdrop-blur-sm">
            </div>

            <button type="submit" class="w-full py-3.5 bg-primary-red text-white rounded-xl font-bold shadow-lg shadow-red-500/30 hover:shadow-red-500/50 hover:bg-accent-red transition-all transform hover:-translate-y-0.5">
                Masuk
            </button>

            <p class="text-center text-sm text-slate-600 mt-6">
                Belum punya akun? <a href="{{ route('register') }}" class="text-primary-red font-bold hover:underline">Daftar sekarang</a>
            </p>
        </form>
    </div>
</div>
@endsection
