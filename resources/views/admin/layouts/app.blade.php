<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - ArgueCraft</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;700;900&family=Instrument+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <style>
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.1); border-radius: 10px; }
        .sidebar-item-active { background-color: rgba(255, 255, 255, 0.1); color: white; border-right: 4px solid #EF4444; }
    </style>
</head>
<body class="bg-[#F1F5F9] font-sans text-slate-800 antialiased overflow-hidden">

<div class="flex h-screen w-full overflow-hidden" x-data="{ sidebarOpen: true, mobileSidebar: false }">

    <!-- Mobile Sidebar Backdrop -->
    <div x-show="mobileSidebar" 
         class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-sm lg:hidden" 
         @click="mobileSidebar = false" x-cloak x-transition></div>

    <!-- Sidebar Container -->
    <aside 
        x-show="sidebarOpen || mobileSidebar"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        :class="mobileSidebar ? 'fixed z-50' : 'relative hidden lg:flex'"
        class="inset-y-0 left-0 w-72 bg-slate-900 text-slate-400 flex-col flex-shrink-0 shadow-2xl h-full"
    >
        <!-- Sidebar Header -->
        <div class="h-20 px-8 flex items-center border-b border-slate-800 shrink-0">
            <a href="/" class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-primary-red text-white flex items-center justify-center font-black shadow-lg shadow-red-500/20">A</div>
                <span class="font-black text-xl text-white tracking-tight">Admin<span class="text-primary-red">Panel</span></span>
            </a>
            <button @click="sidebarOpen = false" class="ml-auto lg:flex hidden p-2 hover:bg-white/5 rounded-lg text-slate-500 hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-4 py-8 space-y-1 overflow-y-auto custom-scrollbar">
            <div class="px-4 pb-4">
                <p class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-500">Overview</p>
            </div>

            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl font-bold transition-all hover:bg-white/5 hover:text-white {{ request()->routeIs('admin.dashboard') ? 'sidebar-item-active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span>Dashboard</span>
            </a>

            <div class="px-4 pt-8 pb-4">
                <p class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-500">Materi & Topik</p>
            </div>
            
            <a href="{{ route('admin.modules.index') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl font-bold transition-all hover:bg-white/5 hover:text-white {{ request()->routeIs('admin.modules.*') ? 'sidebar-item-active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                <span>Modul Belajar</span>
            </a>
            
            <a href="{{ route('admin.topics.index') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl font-bold transition-all hover:bg-white/5 hover:text-white {{ request()->routeIs('admin.topics.*') ? 'sidebar-item-active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                <span>Topik Simulasi</span>
            </a>

            <div class="px-4 pt-8 pb-4">
                <p class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-500">Data User</p>
            </div>

            <a href="{{ route('admin.results.index') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl font-bold transition-all hover:bg-white/5 hover:text-white {{ request()->routeIs('admin.results.*') ? 'sidebar-item-active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                <span>Hasil Simulasi</span>
            </a>

            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl font-bold transition-all hover:bg-white/5 hover:text-white {{ request()->routeIs('admin.users.*') ? 'sidebar-item-active' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <span>Daftar Pengguna</span>
            </a>
        </nav>

        <!-- Sidebar Footer -->
        <div class="p-4 border-t border-slate-800 shrink-0">
            <a href="{{ route('dashboard') }}" class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-red-600/10 text-primary-red rounded-xl font-bold hover:bg-red-600 hover:text-white transition-all shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke App
            </a>
        </div>
    </aside>

    <!-- Content Area -->
    <div class="flex-1 flex flex-col min-w-0 h-full overflow-hidden">
        
        <!-- Navbar -->
        <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-6 lg:px-10 shrink-0">
            <div class="flex items-center gap-4">
                <!-- Mobile Toggle -->
                <button @click="mobileSidebar = true" class="lg:hidden p-2 text-slate-500 hover:bg-slate-100 rounded-lg transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <!-- Desktop Toggle -->
                <button @click="sidebarOpen = true" x-show="!sidebarOpen" class="hidden lg:flex p-2 text-slate-500 hover:bg-slate-100 rounded-lg transition-colors" x-cloak>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <h1 class="text-xl lg:text-2xl font-black text-slate-900 tracking-tight">@yield('title')</h1>
            </div>

            <div class="flex items-center gap-4">
                <div class="hidden sm:flex flex-col items-end">
                    <span class="text-sm font-bold text-slate-900 leading-none mb-1">{{ Auth::user()->name ?? 'Super Admin' }}</span>
                    <span class="text-[10px] font-black text-primary-red uppercase tracking-widest leading-none">Administrator</span>
                </div>
                <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 border border-slate-200">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto custom-scrollbar bg-slate-50">
            <div class="p-6 lg:p-10 mx-auto max-w-7xl">
                @yield('content')
            </div>
        </main>
    </div>
</div>

</body>
</html>
