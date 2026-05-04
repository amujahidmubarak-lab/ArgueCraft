<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ArgueCraft - Latih Kemampuan Berdebat Terstruktur</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:300,400,500,600,700|instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased red-gradient min-h-screen text-slate-900 font-['Outfit']">
        <!-- Background Decoration -->
        <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
            <div class="absolute bg-grid inset-0"></div>
            <div class="absolute -top-[10%] -right-[10%] w-[40%] h-[40%] bg-red-200/20 blur-[120px] rounded-full"></div>
            <div class="absolute -bottom-[10%] -left-[10%] w-[40%] h-[40%] bg-red-300/10 blur-[120px] rounded-full"></div>
        </div>

        <!-- Navbar -->
        <nav class="sticky top-0 z-50 px-6 py-4 glass border-b border-white/20">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="flex items-center gap-2 group">
                    <div class="w-10 h-10 bg-primary-red rounded-lg flex items-center justify-center text-white shadow-lg group-hover:rotate-12 transition-transform duration-300">
                        <span class="font-bold text-xl">A</span>
                    </div>
                    <span class="text-2xl font-bold tracking-tight text-slate-900">Argue<span class="text-primary-red">Craft</span></span>
                </div>

                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 rounded-full font-semibold text-white bg-primary-red hover:bg-accent-red shadow-md transition-all">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="px-6 py-2.5 font-semibold text-slate-600 hover:text-primary-red transition-colors">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-6 py-2.5 rounded-full font-semibold text-white bg-primary-red hover:bg-accent-red shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5">Get Started</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="relative pt-20 pb-20 px-6 overflow-hidden text-center">
            <div class="max-w-4xl mx-auto relative z-10">
                <div class="inline-block px-4 py-1.5 mb-6 rounded-full bg-red-100 text-primary-red font-semibold text-sm tracking-wide uppercase">
                    Platform Pembelajaran & Simulasi Debat
                </div>
                <h1 class="text-5xl md:text-7xl font-black text-slate-900 leading-tight mb-8">
                    Latih Kemampuan Berdebat<br/>
                    <span class="text-primary-red">Secara Terstruktur</span>
                </h1>
                <p class="text-xl text-slate-600 max-w-2xl mx-auto mb-12 leading-relaxed font-light">
                    Pelajari cara menyusun argumen dan uji kemampuan Anda melalui simulasi debat interaktif.
                </p>
                <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                    <a href="{{ route('register') }}" class="w-full sm:w-auto px-10 py-4 bg-primary-red text-white rounded-full font-bold text-lg shadow-xl hover:shadow-red-500/25 transition-all transform hover:scale-105">Mulai Sekarang</a>
                    <a href="{{ route('login') }}" class="w-full sm:w-auto px-10 py-4 bg-white/50 border-2 border-slate-200 text-slate-700 rounded-full font-bold text-lg hover:bg-white transition-all">Masuk</a>
                </div>
            </div>
        </section>

        <!-- Introduction Section -->
        <section class="py-20 px-6 bg-white/30 backdrop-blur-sm">
            <div class="max-w-4xl mx-auto text-center">
                <p class="text-2xl text-slate-700 leading-relaxed font-medium italic">
                    "ArgueCraft adalah platform pembelajaran dan simulasi debat yang membantu pengguna memahami dan melatih kemampuan berargumen secara sistematis melalui tahapan yang terarah."
                </p>
            </div>
        </section>

        <!-- Key Features Section -->
        <section id="features" class="py-24 px-6">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-slate-900 mb-4">Fitur Utama</h2>
                    <div class="w-20 h-1.5 bg-primary-red mx-auto rounded-full"></div>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="p-8 glass rounded-3xl group hover:-translate-y-2 transition-all duration-300 text-center">
                        <div class="w-16 h-16 bg-red-50 rounded-2xl flex items-center justify-center mb-6 text-primary-red mx-auto group-hover:bg-primary-red group-hover:text-white transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-slate-900">Pembelajaran Terarah</h3>
                        <p class="text-slate-600 leading-relaxed">Akses modul dasar debat yang disusun secara sistematis untuk membangun fondasi logika yang kuat.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="p-8 glass rounded-3xl group hover:-translate-y-2 transition-all duration-300 text-center">
                        <div class="w-16 h-16 bg-red-50 rounded-2xl flex items-center justify-center mb-6 text-primary-red mx-auto group-hover:bg-primary-red group-hover:text-white transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-slate-900">Simulasi Bertahap</h3>
                        <p class="text-slate-600 leading-relaxed">Uji argumen Anda dalam simulasi terstruktur mulai dari fase Opening hingga Closing.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="p-8 glass rounded-3xl group hover:-translate-y-2 transition-all duration-300 text-center">
                        <div class="w-16 h-16 bg-red-50 rounded-2xl flex items-center justify-center mb-6 text-primary-red mx-auto group-hover:bg-primary-red group-hover:text-white transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-slate-900">Evaluasi & Feedback</h3>
                        <p class="text-slate-600 leading-relaxed">Dapatkan penilaian sederhana dan feedback untuk setiap argumen yang Anda sampaikan.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section id="how-it-works" class="py-24 px-6 bg-white/20">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-slate-900 mb-4">Cara Kerja</h2>
                    <div class="w-20 h-1.5 bg-primary-red mx-auto rounded-full"></div>
                </div>

                <div class="grid md:grid-cols-4 gap-12 relative">
                    <!-- Line decoration (desktop only) -->
                    <div class="hidden md:block absolute top-1/3 left-0 w-full h-0.5 bg-red-100 -translate-y-1/2 z-0"></div>
                    
                    <!-- Step 1 -->
                    <div class="relative z-10 text-center">
                        <div class="w-16 h-16 bg-white rounded-full border-4 border-red-50 flex items-center justify-center mx-auto mb-6 shadow-xl">
                            <span class="text-2xl font-black text-primary-red">1</span>
                        </div>
                        <h4 class="text-xl font-bold mb-3 text-slate-900">Masuk Akun</h4>
                        <p class="text-slate-600 text-sm">Daftar atau masuk ke akun ArgueCraft Anda.</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative z-10 text-center">
                        <div class="w-16 h-16 bg-white rounded-full border-4 border-red-50 flex items-center justify-center mx-auto mb-6 shadow-xl">
                            <span class="text-2xl font-black text-primary-red">2</span>
                        </div>
                        <h4 class="text-xl font-bold mb-3 text-slate-900">Pelajari Materi</h4>
                        <p class="text-slate-600 text-sm">Pahami dasar-dasar debat melalui modul yang tersedia.</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative z-10 text-center">
                        <div class="w-16 h-16 bg-white rounded-full border-4 border-red-50 flex items-center justify-center mx-auto mb-6 shadow-xl">
                            <span class="text-2xl font-black text-primary-red">3</span>
                        </div>
                        <h4 class="text-xl font-bold mb-3 text-slate-900">Ikuti Simulasi</h4>
                        <p class="text-slate-600 text-sm">Pilih topik dan mulai berdebat secara bertahap.</p>
                    </div>

                    <!-- Step 4 -->
                    <div class="relative z-10 text-center">
                        <div class="w-16 h-16 bg-primary-red rounded-full border-4 border-white flex items-center justify-center mx-auto mb-6 shadow-xl">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        </div>
                        <h4 class="text-xl font-bold mb-3 text-slate-900">Dapatkan Hasil</h4>
                        <p class="text-slate-600 text-sm">Lihat evaluasi dan skor dari argumen yang Anda susun.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Social Proof (Minimal) -->
        <section class="py-20 px-6">
            <div class="max-w-4xl mx-auto">
                <div class="glass p-10 rounded-[2.5rem] text-center border-l-8 border-primary-red shadow-lg">
                    <p class="text-xl text-slate-700 italic mb-4">"Cara terbaik untuk menguasai debat adalah dengan berlatih secara terstruktur. Platform ini menyediakan ruang tersebut dengan sangat baik."</p>
                    <span class="font-bold text-slate-900">— Tim ArgueCraft</span>
                </div>
            </div>
        </section>

        <!-- Final CTA Section -->
        <section class="py-24 px-6">
            <div class="max-w-5xl mx-auto rounded-[3rem] bg-primary-red p-12 md:p-20 text-center relative overflow-hidden shadow-2xl">
                <div class="absolute top-0 left-0 w-full h-full opacity-10 bg-grid"></div>
                <div class="relative z-10">
                    <h2 class="text-4xl md:text-5xl font-black text-white mb-8">Mulai latih kemampuan debat Anda sekarang</h2>
                    <a href="{{ route('register') }}" class="inline-block px-10 py-5 bg-white text-primary-red rounded-full font-black text-xl shadow-lg hover:shadow-2xl transition-all transform hover:scale-105 active:scale-95">Get Started</a>
                </div>
                
                <!-- Decorative Circle -->
                <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-12 px-6 border-t border-red-100 mt-10">
            <div class="max-w-7xl mx-auto text-center">
                <div class="flex items-center justify-center gap-2 mb-6">
                    <div class="w-8 h-8 bg-slate-900 rounded flex items-center justify-center text-white font-bold">A</div>
                    <span class="text-xl font-bold text-slate-900">ArgueCraft</span>
                </div>
                <p class="text-slate-500 text-sm mb-4">&copy; 2026 ArgueCraft. Crafted for better thinking and discourse.</p>
                <div class="flex justify-center gap-8 text-sm font-medium text-slate-400">
                    <a href="{{ route('login') }}" class="hover:text-primary-red transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="hover:text-primary-red transition-colors">Daftar</a>
                </div>
            </div>
        </footer>
    </body>
</html>
