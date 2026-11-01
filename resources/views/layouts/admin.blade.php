@php
    $menuAdmin = [
        ['route' => 'admin.dashboard', 'aktif' => 'admin.dashboard', 'label' => 'Dasbor', 'ikon' => 'grafik'],
        ['route' => 'admin.berita.index', 'aktif' => 'admin.berita.*', 'label' => 'Berita', 'ikon' => 'buku'],
        ['route' => 'admin.halaman.index', 'aktif' => 'admin.halaman.*', 'label' => 'Halaman', 'ikon' => 'dokumen'],
        ['route' => 'admin.pengumuman.edit', 'aktif' => 'admin.pengumuman.*', 'label' => 'Pengumuman', 'ikon' => 'megafon'],
        ['route' => 'admin.sambutan.edit', 'aktif' => 'admin.sambutan.*', 'label' => 'Sambutan Pimpinan', 'ikon' => 'pengguna'],
    ];
    $namaAdmin = Auth::user()->name ?? 'Admin Humas';
    // Teks yang disembunyikan saat sidebar diciutkan (desktop); tetap terbaca pembaca layar
    $labelCiut = 'whitespace-nowrap lg:ciut:sr-only';
@endphp
<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <title>@yield('title', 'Dasbor') - Panel Humas Rutan Kelas IIB Pandeglang</title>
    <script>
        // Terapkan status sidebar sebelum halaman digambar agar tidak berkedip
        try { if (localStorage.getItem('sidebar-admin') === 'ciut') document.documentElement.classList.add('sidebar-ciut'); } catch (e) {}
    </script>
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="min-h-full bg-gray-50 font-sans text-gray-800 antialiased selection:bg-emas-200 selection:text-navy-950">

    <!-- SIDEBAR -->
    <aside id="sidebar-admin" aria-label="Menu admin"
           class="fixed inset-y-0 left-0 z-50 flex w-64 -translate-x-full flex-col overflow-hidden bg-navy-950 text-navy-200 transition-[width,transform] duration-300 ease-in-out lg:translate-x-0 lg:ciut:w-[72px]">

        <!-- Kepala sidebar: tombol hamburger + identitas -->
        <div class="flex h-16 shrink-0 items-center gap-2 border-b border-white/10 px-3 lg:ciut:justify-center lg:ciut:px-0">
            <button id="tombol-ciut" type="button" aria-controls="sidebar-admin" aria-label="Ciutkan menu" title="Ciutkan / lebarkan menu"
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg text-navy-200 hover:bg-white/10 hover:text-white transition focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-400">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <a href="{{ route('admin.dashboard') }}" class="flex min-w-0 items-center gap-2.5 rounded-lg focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-400 lg:ciut:hidden">
                <x-logo class="w-8 h-8" />
                <span class="leading-tight whitespace-nowrap">
                    <span class="block text-[11px] font-semibold uppercase tracking-wider text-emas-400">Panel Humas</span>
                    <span class="block text-sm font-bold text-white">Rutan Pandeglang</span>
                </span>
            </a>
        </div>

        <nav class="flex-1 space-y-1 overflow-y-auto overflow-x-hidden px-3 py-5">
            <p class="px-3 pb-2 text-[11px] font-bold uppercase tracking-wider text-navy-400 {{ $labelCiut }}">Kelola</p>
            @foreach ($menuAdmin as $menu)
                @php $aktif = request()->routeIs($menu['aktif']); @endphp
                <a href="{{ route($menu['route']) }}" @if($aktif) aria-current="page" @endif title="{{ $menu['label'] }}"
                   class="relative flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-400 lg:ciut:justify-center lg:ciut:px-0 {{ $aktif ? 'bg-white/10 text-white' : 'hover:bg-white/5 hover:text-white' }}">
                    @if($aktif)
                        <span class="absolute inset-y-2 left-0 w-1 rounded-r bg-emas-400" aria-hidden="true"></span>
                    @endif
                    <x-ikon :nama="$menu['ikon']" class="w-5 h-5 shrink-0 {{ $aktif ? 'text-emas-400' : 'text-navy-400' }}" />
                    <span class="{{ $labelCiut }}">{{ $menu['label'] }}</span>
                </a>
            @endforeach

            <div class="my-4 border-t border-white/10"></div>
            <a href="{{ url('/') }}" target="_blank" rel="noopener" title="Lihat portal publik"
               class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium hover:bg-white/5 hover:text-white transition lg:ciut:justify-center lg:ciut:px-0">
                <x-ikon nama="gedung" class="w-5 h-5 shrink-0 text-navy-400" />
                <span class="{{ $labelCiut }}">Lihat portal publik</span>
                <x-panah arah="serong" class="ml-auto h-4 w-4 text-navy-400 lg:ciut:hidden" />
            </a>
        </nav>

        <div class="flex items-center gap-3 border-t border-white/10 p-4 lg:ciut:flex-col lg:ciut:gap-2 lg:ciut:px-2">
            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-emas-500 text-sm font-bold text-navy-950" title="{{ $namaAdmin }}">
                {{ Str::upper(Str::substr($namaAdmin, 0, 1)) }}
            </span>
            <span class="min-w-0 flex-1 leading-tight lg:ciut:hidden">
                <span class="block truncate text-sm font-semibold text-white">{{ $namaAdmin }}</span>
                <span class="block truncate text-xs text-navy-400">{{ Auth::user()->email ?? '' }}</span>
            </span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" onclick="return confirm('Keluar dari panel admin?')" title="Keluar" aria-label="Keluar"
                        class="rounded-lg p-2 text-navy-300 hover:bg-white/10 hover:text-red-300 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-400">
                    <x-ikon nama="pintu-keluar" class="w-5 h-5" />
                </button>
            </form>
        </div>
    </aside>
    <div id="latar-sidebar" class="fixed inset-0 z-40 hidden bg-navy-950/60 lg:hidden" aria-hidden="true"></div>

    <div class="flex min-h-screen flex-col transition-[padding] duration-300 ease-in-out lg:pl-64 lg:ciut:pl-[72px]">
        <!-- BAR ATAS -->
        <header class="sticky top-0 z-30 border-b border-gray-200 bg-white/95 backdrop-blur">
            <div class="flex h-16 items-center gap-3 px-4 sm:px-6 lg:px-8">
                <button id="tombol-sidebar" type="button" aria-controls="sidebar-admin" aria-expanded="false" aria-label="Buka menu"
                        class="-ml-1 rounded-lg p-2 text-navy-900 hover:bg-gray-100 lg:hidden focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <p class="truncate text-sm text-gray-500">
                    Panel Humas <span class="mx-1 text-gray-300">/</span>
                    <span class="font-semibold text-navy-950">@yield('title', 'Dasbor')</span>
                </p>
                <a href="{{ url('/') }}" target="_blank" rel="noopener"
                   class="ml-auto hidden items-center gap-1.5 rounded-lg border border-gray-200 px-3 py-1.5 text-xs font-semibold text-gray-700 hover:border-navy-300 hover:bg-navy-50 transition sm:inline-flex">
                    Lihat portal <x-panah arah="serong" class="h-3.5 w-3.5" />
                </a>
            </div>
        </header>

        <main class="flex-1 px-4 py-6 sm:px-6 lg:px-8 lg:py-8">
            @if(session('success'))
                <div class="mb-6 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800" role="status">
                    <svg class="w-5 h-5 shrink-0 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800" role="alert">
                    <svg class="w-5 h-5 shrink-0 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <p class="font-medium">{{ session('error') }}</p>
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="border-t border-gray-200 px-4 py-5 text-xs text-gray-500 sm:px-6 lg:px-8">
            &copy; {{ date('Y') }} Rutan Kelas IIB Pandeglang · Panel Humas
        </footer>
    </div>

    <script>
        (function () {
            const html = document.documentElement;
            const sidebar = document.getElementById('sidebar-admin');
            const latar = document.getElementById('latar-sidebar');
            const tombolBuka = document.getElementById('tombol-sidebar');
            const tombolCiut = document.getElementById('tombol-ciut');
            const desktop = window.matchMedia('(min-width: 1024px)');

            // Layar kecil: sidebar sebagai overlay
            function aturOverlay(buka) {
                sidebar.classList.toggle('-translate-x-full', !buka);
                latar.classList.toggle('hidden', !buka);
                tombolBuka.setAttribute('aria-expanded', buka ? 'true' : 'false');
            }

            // Desktop: ciutkan / lebarkan sidebar, status diingat di browser
            function perbaruiLabel() {
                const ciut = html.classList.contains('sidebar-ciut');
                tombolCiut.setAttribute('aria-expanded', ciut ? 'false' : 'true');
                tombolCiut.setAttribute('aria-label', desktop.matches ? (ciut ? 'Lebarkan menu' : 'Ciutkan menu') : 'Tutup menu');
            }

            tombolCiut.addEventListener('click', function () {
                if (!desktop.matches) { aturOverlay(false); return; }
                const ciut = html.classList.toggle('sidebar-ciut');
                try { localStorage.setItem('sidebar-admin', ciut ? 'ciut' : 'lebar'); } catch (e) {}
                perbaruiLabel();
            });

            tombolBuka.addEventListener('click', function () { aturOverlay(true); });
            latar.addEventListener('click', function () { aturOverlay(false); });
            document.addEventListener('keydown', function (e) { if (e.key === 'Escape') aturOverlay(false); });
            desktop.addEventListener('change', perbaruiLabel);
            perbaruiLabel();
        })();
    </script>
    @stack('scripts')
</body>
</html>
