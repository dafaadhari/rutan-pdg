<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dasbor Admin') - Rutan Kelas IIB Pandeglang</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gray-950 font-['Inter',sans-serif] text-gray-100 antialiased flex flex-col selection:bg-amber-500 selection:text-gray-900">

    <!-- Top Accent Bar -->
    <div class="w-full h-1 bg-gradient-to-r from-amber-500 via-red-600 to-blue-700"></div>

    <!-- Admin Navigation Bar -->
    <header class="bg-gray-900/90 border-b border-gray-800 backdrop-blur sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                
                <!-- Logo & Brand -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.berita.index') }}" class="flex items-center gap-3 group">
                        <div class="w-9 h-9 rounded-lg bg-gray-800 border border-gray-700 flex items-center justify-center text-amber-400 group-hover:border-amber-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-xs font-semibold uppercase tracking-wider text-amber-400">Admin Panel</div>
                            <div class="text-sm font-bold text-white">Rutan Pandeglang</div>
                        </div>
                    </a>

                    <!-- Nav Links -->
                    <nav class="hidden md:flex ml-8 space-x-1">
                        <a href="{{ route('admin.berita.index') }}" 
                           class="px-3 py-1.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.berita.*') ? 'bg-gray-800 text-amber-400' : 'text-gray-300 hover:text-white hover:bg-gray-850' }}">
                            Manajemen Berita
                        </a>
                    </nav>
                </div>

                <!-- User Info & Actions -->
                <div class="flex items-center gap-3">
                    <a href="{{ url('/') }}" target="_blank" 
                       class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-gray-300 hover:text-white bg-gray-800/80 hover:bg-gray-700 border border-gray-700/80 rounded-lg transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        Lihat Portal Publik
                    </a>

                    <div class="h-5 w-px bg-gray-800 hidden sm:block"></div>

                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-amber-500/20 border border-amber-500/40 text-amber-300 flex items-center justify-center font-bold text-xs">
                            {{ substr(Auth::user()->name ?? 'Admin', 0, 1) }}
                        </div>
                        <span class="text-xs text-gray-300 hidden md:inline font-medium">
                            {{ Auth::user()->name ?? 'Admin Humas' }}
                        </span>
                    </div>

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" 
                                onclick="return confirm('Apakah Anda yakin ingin keluar?')"
                                title="Keluar dari Admin"
                                class="p-2 text-gray-400 hover:text-red-400 hover:bg-gray-800/80 rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-1 py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full">
        
        <!-- Flash Alert Success -->
        @if(session('success'))
            <div class="mb-6 rounded-xl bg-emerald-950/40 border border-emerald-800/80 p-4 text-sm text-emerald-200 flex items-start gap-3 shadow-lg shadow-black/20 animate-fadeIn">
                <svg class="w-5 h-5 text-emerald-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="flex-1">
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Flash Alert Error -->
        @if(session('error'))
            <div class="mb-6 rounded-xl bg-red-950/40 border border-red-800/80 p-4 text-sm text-red-200 flex items-start gap-3 shadow-lg shadow-black/20">
                <svg class="w-5 h-5 text-red-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <div class="flex-1">
                    <p class="font-medium">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer Admin -->
    <footer class="border-t border-gray-800/80 py-4 text-center text-xs text-gray-500 bg-gray-950">
        Rutan Kelas IIB Pandeglang &copy; {{ date('Y') }} &bull; Sistem Panel Admin Humas
    </footer>

</body>
</html>
