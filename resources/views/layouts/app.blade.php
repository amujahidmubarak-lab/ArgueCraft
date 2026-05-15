<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'ArgueCraft - Platform Debat')</title>
        <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><rect width=%22100%22 height=%22100%22 rx=%2220%22 fill=%22%23E63946%22/><text y=%22.9em%22 x=%2250%%22 text-anchor=%22middle%22 font-family=%22Outfit, sans-serif%22 font-weight=%22bold%22 font-size=%2270%22 fill=%22white%22>A</text></svg>">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:300,400,500,600,700|instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <style>[x-cloak] { display: none !important; }</style>
    </head>
    <body class="antialiased red-gradient min-h-screen text-slate-900 font-['Outfit'] relative flex flex-col">
        <!-- Background Decoration -->
        <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
            <div class="absolute bg-grid inset-0"></div>
            <div class="absolute -top-[10%] -right-[10%] w-[40%] h-[40%] bg-red-200/20 blur-[120px] rounded-full"></div>
            <div class="absolute -bottom-[10%] -left-[10%] w-[40%] h-[40%] bg-red-300/10 blur-[120px] rounded-full"></div>
        </div>

        <!-- Navbar (Hidden during active simulation for focus) -->
        @if(!request()->routeIs(['simulation.phase', 'simulation.interactive.chat']))
        <nav class="sticky top-0 z-50 px-6 py-4 glass border-b border-white/20">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                    <div class="w-10 h-10 bg-primary-red rounded-lg flex items-center justify-center text-white shadow-lg group-hover:rotate-12 transition-transform duration-300">
                        <span class="font-bold text-xl">A</span>
                    </div>
                    <span class="text-2xl font-bold tracking-tight text-slate-900">Argue<span class="text-primary-red">Craft</span></span>
                </a>
                
                @auth
                <div class="hidden md:flex items-center gap-8 font-medium text-slate-600">
                    <a href="{{ route('dashboard') }}" class="hover:text-primary-red transition-colors {{ request()->routeIs('dashboard') && !request()->has('view') ? 'text-primary-red font-bold' : '' }}">Portal</a>
                    <a href="{{ route('dashboard.stats') }}" class="hover:text-primary-red transition-colors {{ request()->routeIs('dashboard.stats') ? 'text-primary-red font-bold' : '' }}">Statistik</a>
                    <a href="{{ route('learning.index') }}" class="hover:text-primary-red transition-colors {{ request()->routeIs('learning.*') ? 'text-primary-red font-bold' : '' }}">Pembelajaran</a>
                    <a href="{{ route('dashboard', ['view' => 'simulasi']) }}" class="hover:text-primary-red transition-colors {{ request()->input('view') == 'simulasi' ? 'text-primary-red font-bold' : '' }}">Simulasi</a>
                </div>
                @endauth

                <div class="flex items-center gap-4">
                    @auth
                        <span class="text-slate-600 font-medium mr-4 hidden md:inline">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="px-5 py-2 rounded-full font-semibold text-slate-700 bg-white/50 hover:bg-white shadow-sm transition-all text-sm">Keluar</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2.5 font-semibold text-slate-600 hover:text-primary-red transition-colors">Masuk</a>
                        <a href="{{ route('register') }}" class="px-6 py-2.5 rounded-full font-semibold text-white bg-primary-red hover:bg-accent-red shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5">Daftar</a>
                    @endauth
                </div>
            </div>
        </nav>
        @endif

        <!-- Main Content -->
        <main class="relative z-10 flex-grow px-4 sm:px-6 lg:px-8 py-12 page-fade-in">
            @yield('content')
        </main>

        <!-- Footer -->
        @if(!request()->routeIs(['simulation.phase', 'simulation.interactive.chat']))
        <footer class="relative z-10 py-8 px-6 border-t border-red-100/50 mt-auto bg-white/10 backdrop-blur-sm">
            <div class="max-w-7xl mx-auto text-center text-slate-500 text-sm">
                &copy; {{ date('Y') }} ArgueCraft. Dibuat untuk diskusi yang lebih baik.
            </div>
        </footer>
        @endif
    </body>
</html>
