<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle }} - Rutan Kelas IIB Pandeglang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased flex flex-col min-h-screen selection:bg-red-600 selection:text-white">

    <!-- NAVBAR RESMI MULTI-LEVEL -->
    @include('partials.navbar')

    <!-- BREADCRUMB & HERO HEADER -->
    <section class="bg-gray-900 text-white py-10 border-b border-gray-800 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Breadcrumb Navigation -->
            <nav class="flex items-center gap-2 text-xs text-gray-400 mb-3">
                <a href="{{ url('/') }}" class="hover:text-red-400 transition">Beranda</a>
                <span>&gt;</span>
                <span class="text-gray-300 font-medium">{{ $categoryTitle }}</span>
                <span>&gt;</span>
                <span class="text-red-400 font-semibold">{{ $pageTitle }}</span>
            </nav>

            <span class="inline-block text-[11px] font-bold tracking-widest text-red-400 uppercase bg-red-950/60 border border-red-800/80 px-3 py-1 rounded-full mb-2">
                {{ $categoryTitle }}
            </span>
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white tracking-tight">
                {{ $pageTitle }}
            </h1>
            <p class="text-xs sm:text-sm text-gray-400 mt-2 max-w-2xl leading-relaxed">
                Informasi resmi Rumah Tahanan Negara Kelas IIB Pandeglang &bull; Kementerian Imigrasi dan Pemasyarakatan Republik Indonesia.
            </p>
        </div>

        <!-- Subtle Background Glow -->
        <div class="absolute -right-10 -bottom-10 w-96 h-96 bg-red-600/10 rounded-full blur-3xl pointer-events-none"></div>
    </section>

    <!-- CONTENT BODY & SIDEBAR NAVIGATION -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <!-- Kolom Konten Utama (2 Kolom) -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl border border-gray-200 p-6 sm:p-8 shadow-sm">
                    @yield('page_content')
                </div>
            </div>

            <!-- Sidebar Navigasi Kategori (1 Kolom) -->
            <aside class="space-y-6">
                <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-sm sticky top-20">
                    <h3 class="text-xs font-extrabold uppercase tracking-wider text-gray-900 border-b border-gray-200 pb-3 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-red-600"></span>
                        Menu {{ $categoryTitle }}
                    </h3>

                    <!-- List Navigasi Terkait -->
                    <nav class="divide-y divide-gray-100 mt-3">
                        @foreach ($menuItems as $slug => $label)
                            <a href="{{ route($categoryRoute, $slug) }}" 
                               class="flex items-center justify-between py-2.5 px-3 text-xs rounded-lg transition-colors {{ $slug === $currentSlug ? 'bg-red-50 text-red-600 font-bold border-l-4 border-red-600 shadow-sm' : 'text-gray-600 hover:text-red-600 hover:bg-gray-50 font-medium' }}">
                                <span>{{ $label }}</span>
                                <svg class="w-3.5 h-3.5 {{ $slug === $currentSlug ? 'text-red-600' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        @endforeach
                    </nav>

                    <!-- Banner Info Layanan Terpadu -->
                    <div class="mt-6 bg-gray-900 text-white rounded-xl p-4 border border-gray-800">
                        <div class="flex items-center gap-2 text-red-400 text-xs font-bold uppercase tracking-wider mb-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Layanan Pengaduan</span>
                        </div>
                        <p class="text-xs text-gray-300 leading-relaxed mb-3">
                            Masyarakat dapat menyampaikan aspirasi, keluhan, atau laporan pelayanan langsung ke kanal resmi rutan.
                        </p>
                        <a href="{{ route('layanan', 'pengaduan') }}" class="inline-block text-[11px] font-bold uppercase text-amber-400 hover:text-amber-300 transition">
                            Sampaikan Laporan &rarr;
                        </a>
                    </div>
                </div>
            </aside>

        </div>
    </main>

    <!-- FOOTER RESMI -->
    <footer id="kontak" class="bg-gray-900 text-gray-400 py-12 mt-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-1">
                <h4 class="text-white font-extrabold text-lg mb-4 uppercase tracking-wider flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-red-600"></span>
                    Rutan Pandeglang
                </h4>
                <p class="text-sm leading-relaxed mb-4 text-gray-400">
                    Unit Pelaksana Teknis Pemasyarakatan di bawah naungan Kantor Wilayah Kementerian Imigrasi dan Pemasyarakatan Banten.
                </p>
            </div>
            
            <div>
                <h4 class="text-white font-bold text-sm mb-4 uppercase tracking-widest">Informasi Kontak</h4>
                <ul class="text-sm space-y-2 text-gray-400">
                    <li>Jl. Raya Pandeglang - Serang</li>
                    <li>Pandeglang, Banten, Indonesia</li>
                    <li class="mt-4">Email: info@rutanpandeglang.go.id</li>
                    <li>Telp: (0253) 201234</li>
                </ul>
            </div>
            
            <div>
                <h4 class="text-white font-bold text-sm mb-4 uppercase tracking-widest">Jam Layanan</h4>
                <ul class="text-sm space-y-2 text-gray-400">
                    <li>Senin - Kamis: 08.00 - 14.00 WIB</li>
                    <li>Jumat: 08.00 - 11.30 WIB</li>
                    <li>Sabtu: 08.00 - 12.00 WIB</li>
                    <li>Minggu & Hari Libur: Tutup</li>
                </ul>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 pt-8 border-t border-gray-800 text-sm flex flex-col md:flex-row justify-between items-center text-xs">
            <p>&copy; {{ date('Y') }} Rutan Kelas IIB Pandeglang. Hak Cipta Dilindungi.</p>
            <div class="mt-3 md:mt-0 flex items-center gap-4">
                <span class="uppercase tracking-widest text-gray-500 font-semibold">Sistem Informasi Publik</span>
                <span class="text-gray-700">&bull;</span>
                <a href="{{ route('login') }}" class="text-gray-500 hover:text-red-400 transition-colors font-medium">
                    Akses Admin
                </a>
            </div>
        </div>
    </footer>

</body>
</html>
