<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ArgueCraft - Latih Kemampuan Berdebat Terstruktur</title>
        <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><rect width=%22100%22 height=%22100%22 rx=%2220%22 fill=%22%23E63946%22/><text y=%22.9em%22 x=%2250%%22 text-anchor=%22middle%22 font-family=%22Outfit, sans-serif%22 font-weight=%22bold%22 font-size=%2270%22 fill=%22white%22>A</text></svg>">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:300,400,500,600,700,800,900" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .red-gradient-bg {
                background: linear-gradient(180deg, #FFF5F5 0%, #FFFFFF 100%);
            }
            .glass-card {
                background: white;
                box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05);
                border: 1px solid #f1f5f9;
            }
        </style>
    </head>
    <body class="antialiased red-gradient-bg min-h-screen text-slate-900 font-['Outfit']">
        <!-- Navbar -->
        <nav class="sticky top-0 z-50 px-6 py-4 bg-white/80 backdrop-blur-md border-b border-slate-100">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-primary-red rounded-lg flex items-center justify-center text-white shadow-lg">
                        <span class="font-bold text-xl">A</span>
                    </div>
                    <span class="text-2xl font-bold tracking-tight text-slate-900">Argue<span class="text-primary-red">Craft</span></span>
                </div>

                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 rounded-full font-bold text-white bg-primary-red hover:bg-accent-red shadow-md transition-all">Portal User</a>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2.5 font-bold text-slate-600 hover:text-primary-red transition-colors text-sm">Masuk</a>
                        <a href="{{ route('register') }}" class="px-6 py-2.5 rounded-full font-bold text-white bg-primary-red hover:bg-accent-red shadow-lg transition-all text-sm">Get Started</a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="relative pt-24 pb-20 px-6 text-center">
            <div class="max-w-4xl mx-auto">
                <div class="inline-block px-4 py-1.5 mb-8 rounded-full bg-red-50 text-primary-red font-bold text-[10px] tracking-widest uppercase border border-red-100">
                    Platform Pembelajaran & Simulasi Debat
                </div>
                <h1 class="text-5xl md:text-7xl font-black text-slate-900 leading-[1.1] mb-8">
                    Latih Kemampuan Berdebat<br/>
                    <span class="text-primary-red">Secara Terstruktur</span>
                </h1>
                <p class="text-lg text-slate-500 max-w-2xl mx-auto mb-12 leading-relaxed font-medium">
                    Pelajari cara menyusun argumen dan uji kemampuan Anda melalui simulasi debat interaktif.
                </p>
                <div class="flex justify-center">
                    <a href="{{ route('register') }}" class="w-full sm:w-auto px-10 py-4 bg-primary-red text-white rounded-full font-black text-lg shadow-xl shadow-red-500/20 hover:bg-accent-red transition-all transform hover:-translate-y-1">Mulai Sekarang</a>
                </div>
            </div>
        </section>

        <!-- Quote Section -->
        <section class="py-24 px-6">
            <div class="max-w-3xl mx-auto text-center">
                <p class="text-lg md:text-xl text-slate-600 leading-relaxed font-bold italic opacity-80">
                    "ArgueCraft adalah platform pembelajaran dan simulasi debat yang membantu pengguna memahami dan melatih kemampuan berargumen secara sistematis melalui tahapan yang terarah."
                </p>
            </div>
        </section>

        <!-- Fitur Utama -->
        <section id="features" class="py-24 px-6">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-black text-slate-900 mb-4 tracking-tight">Fitur Utama</h2>
                    <div class="w-16 h-1.5 bg-primary-red mx-auto rounded-full"></div>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="p-10 glass-card rounded-[2.5rem] text-center group card-hover">
                        <div class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center mb-8 text-primary-red mx-auto group-hover:bg-primary-red group-hover:text-white transition-all duration-300">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <h3 class="text-xl font-black mb-4 text-slate-900 uppercase tracking-tight">Pembelajaran Terarah</h3>
                        <p class="text-slate-500 font-medium leading-relaxed text-sm">Akses modul dasar debat yang disusun secara sistematis untuk membangun fondasi logika yang kuat.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="p-10 glass-card rounded-[2.5rem] text-center group card-hover">
                        <div class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center mb-8 text-primary-red mx-auto group-hover:bg-primary-red group-hover:text-white transition-all duration-300">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <h3 class="text-xl font-black mb-4 text-slate-900 uppercase tracking-tight">Simulasi Bertahap</h3>
                        <p class="text-slate-500 font-medium leading-relaxed text-sm">Uji argumen Anda dalam simulasi terstruktur mulai dari fase Opening hingga Closing.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="p-10 glass-card rounded-[2.5rem] text-center group card-hover">
                        <div class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center mb-8 text-primary-red mx-auto group-hover:bg-primary-red group-hover:text-white transition-all duration-300">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-black mb-4 text-slate-900 uppercase tracking-tight">Evaluasi & Feedback</h3>
                        <p class="text-slate-500 font-medium leading-relaxed text-sm">Dapatkan penilaian sederhana dan feedback untuk setiap argumen yang Anda sampaikan.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Cara Kerja -->
        <section id="how-it-works" class="py-24 px-6 bg-slate-50/30">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-black text-slate-900 mb-4 tracking-tight">Cara Kerja</h2>
                    <div class="w-16 h-1.5 bg-primary-red mx-auto rounded-full"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- Step 1 -->
                    <div class="text-center">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-md border border-red-50">
                            <span class="text-lg font-black text-primary-red">1</span>
                        </div>
                        <h4 class="text-lg font-black mb-2 text-slate-900">Masuk Akun</h4>
                        <p class="text-slate-400 text-xs font-bold">Daftar atau masuk ke akun ArgueCraft Anda.</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="text-center">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-md border border-red-50">
                            <span class="text-lg font-black text-primary-red">2</span>
                        </div>
                        <h4 class="text-lg font-black mb-2 text-slate-900">Pelajari Materi</h4>
                        <p class="text-slate-400 text-xs font-bold">Pahami dasar-dasar debat melalui modul yang tersedia.</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="text-center">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-md border border-red-50">
                            <span class="text-lg font-black text-primary-red">3</span>
                        </div>
                        <h4 class="text-lg font-black mb-2 text-slate-900">Ikuti Simulasi</h4>
                        <p class="text-slate-400 text-xs font-bold">Pilih topik dan mulai berdebat secara bertahap.</p>
                    </div>

                    <!-- Step 4 -->
                    <div class="text-center">
                        <div class="w-12 h-12 bg-primary-red rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4"></path></svg>
                        </div>
                        <h4 class="text-lg font-black mb-2 text-slate-900">Dapatkan Hasil</h4>
                        <p class="text-slate-400 text-xs font-bold">Lihat evaluasi dan skor dari argumen yang Anda susun.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Social Proof Card -->
        <section class="py-24 px-6">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white p-12 rounded-[2rem] text-center border-l-[12px] border-primary-red shadow-xl">
                    <p class="text-xl text-slate-700 font-bold italic mb-6 leading-relaxed">
                        "Cara terbaik untuk menguasai debat adalah dengan berlatih secara terstruktur. Platform ini menyediakan ruang tersebut dengan sangat baik."
                    </p>
                    <span class="font-black text-slate-900 tracking-tight">— Tim ArgueCraft</span>
                </div>
            </div>
        </section>

        <!-- Final CTA -->
        <section class="py-24 px-6">
            <div class="max-w-5xl mx-auto rounded-[3rem] bg-primary-red p-16 text-center relative overflow-hidden shadow-2xl shadow-red-500/30">
                <div class="relative z-10">
                    <h2 class="text-4xl md:text-5xl font-black text-white mb-10 leading-tight">Mulai latih kemampuan debat Anda sekarang</h2>
                    <a href="{{ route('register') }}" class="inline-block px-10 py-4 bg-white text-primary-red rounded-xl font-black text-lg shadow-lg hover:bg-slate-50 transition-all transform hover:scale-105">Get Started</a>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-16 px-6 border-t border-red-100 bg-white">
            <div class="max-w-7xl mx-auto text-center">
                <div class="flex items-center justify-center gap-2 mb-8">
                    <div class="w-10 h-10 bg-slate-900 rounded-lg flex items-center justify-center text-white font-black text-xl shadow-md">A</div>
                    <span class="text-2xl font-black tracking-tight text-slate-900">ArgueCraft</span>
                </div>
                <p class="text-slate-400 text-sm font-bold mb-6 italic">&copy; {{ date('Y') }} ArgueCraft. Crafted for better thinking and discourse.</p>
                <div class="flex justify-center gap-10 text-xs font-black text-slate-400 uppercase tracking-[0.2em]">
                    <a href="{{ route('login') }}" class="hover:text-primary-red transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="hover:text-primary-red transition-colors">Daftar</a>
                </div>
            </div>
        </footer>
    </body>
</html>
