<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rutan Kelas IIB Pandeglang - Kementerian Imigrasi dan Pemasyarakatan RI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased flex flex-col min-h-screen">

    @include('partials.navbar')

    <!-- HERO SECTION (TATA LETAK SPLIT) -->
    <section class="bg-gray-900 text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-24">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Teks Hero -->
                <div>
                    <div class="inline-block bg-gray-800 border border-gray-700 text-amber-400 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest mb-6">
                        Portal Informasi Resmi
                    </div>
                    <h2 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6">
                        Mewujudkan Pelayanan <span class="text-amber-400">Pemasyarakatan yang PASTI.</span>
                    </h2>
                    <p class="text-gray-300 text-lg mb-8 leading-relaxed">
                        Kami berkomitmen memberikan pelayanan yang Profesional, Akuntabel, Sinergi, Transparan, dan Inovatif bagi Warga Binaan dan masyarakat luas.
                    </p>
                    <a href="#layanan" class="inline-block bg-amber-500 text-gray-950 px-6 py-3 font-bold text-sm uppercase tracking-wide hover:bg-amber-400 rounded-lg shadow-lg shadow-amber-500/20 transition">
                        Lihat Layanan Publik &rarr;
                    </a>
                </div>
                <!-- Kotak Visual Hero -->
                <div class="hidden lg:block">
                    <div class="aspect-video bg-gray-800 border border-gray-700 rounded-2xl flex flex-col items-center justify-center shadow-2xl relative overflow-hidden p-8 text-center">
                        <div class="w-16 h-16 rounded-2xl bg-amber-500/10 border border-amber-500/30 text-amber-400 flex items-center justify-center mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-white uppercase tracking-wider">Rutan Kelas IIB Pandeglang</h3>
                        <p class="text-xs text-gray-400 mt-1 max-w-xs">Wilayah Bebas dari Korupsi (WBK) & Wilayah Birokrasi Bersih Melayani (WBBM)</p>
                        <div class="absolute inset-0 bg-gradient-to-tr from-gray-950/60 via-transparent to-amber-500/5 pointer-events-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PANEL LAYANAN PUBLIK (Ciri khas instansi) -->
    <section id="layanan" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 -mt-10 mb-16">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 shadow-xl">
            <div class="bg-white p-6 border-t-4 border-amber-500 hover:-translate-y-1 transition duration-300 rounded-b-lg">
                <h3 class="font-bold text-gray-900 mb-2">Jadwal Besuk</h3>
                <p class="text-xs text-gray-500">Informasi jam kunjungan tatap muka Warga Binaan.</p>
            </div>
            <div class="bg-white p-6 border-t-4 border-gray-700 hover:-translate-y-1 transition duration-300 rounded-b-lg">
                <h3 class="font-bold text-gray-900 mb-2">Titipan Barang</h3>
                <p class="text-xs text-gray-500">SOP dan syarat penitipan barang & makanan.</p>
            </div>
            <div class="bg-white p-6 border-t-4 border-blue-700 hover:-translate-y-1 transition duration-300 rounded-b-lg">
                <h3 class="font-bold text-gray-900 mb-2">Program Integrasi</h3>
                <p class="text-xs text-gray-500">Layanan pengurusan PB, CB, dan CMB resmi.</p>
            </div>
            <div class="bg-white p-6 border-t-4 border-red-700 hover:-translate-y-1 transition duration-300 rounded-b-lg">
                <h3 class="font-bold text-gray-900 mb-2">Pengaduan</h3>
                <p class="text-xs text-gray-500">Saluran aspirasi dan pengaduan langsung masyarakat.</p>
            </div>
        </div>
    </section>

    <!-- SEKSI PUBLIKASI & BERITA (Layout Side-by-Side Dinamis) -->
    <main id="berita" class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 w-full">
        <div class="flex justify-between items-center mb-8 border-b border-gray-200 pb-4">
            <div>
                <h3 class="text-2xl font-extrabold text-gray-900 uppercase tracking-wide">Giat & Informasi Terkini</h3>
                <p class="text-xs text-gray-500 mt-1">Publikasi resmi transparansi kegiatan dan pembinaan warga binaan.</p>
            </div>
        </div>

        @if($beritaUtama)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Berita Utama (Sorotan) - Memakan 2 kolom -->
                <article class="lg:col-span-2 group">
                    <a href="{{ route('berita.show', $beritaUtama->slug) }}" class="block">
                        <div class="aspect-video bg-gray-900 rounded-2xl w-full relative overflow-hidden mb-4 shadow-lg border border-gray-200">
                            @if($beritaUtama->gambar_sampul)
                                <img src="{{ asset('storage/' . $beritaUtama->gambar_sampul) }}" 
                                     alt="{{ $beritaUtama->judul }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-gray-800 to-gray-950 text-gray-400 p-6 text-center">
                                    <svg class="w-12 h-12 text-amber-400/80 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                    </svg>
                                    <span class="text-xs font-semibold uppercase tracking-widest text-gray-300">Rilis Humas Rutan Pandeglang</span>
                                </div>
                            @endif
                        </div>

                        <div class="text-xs font-bold text-amber-600 uppercase tracking-widest mb-2 flex items-center gap-2">
                            <span>Humas Rutan</span>
                            <span>&bull;</span>
                            <span>{{ $beritaUtama->created_at->translatedFormat('d F Y') }}</span>
                        </div>

                        <h4 class="text-2xl font-extrabold text-gray-900 group-hover:text-amber-600 transition leading-snug mb-3">
                            {{ $beritaUtama->judul }}
                        </h4>

                        <p class="text-gray-600 leading-relaxed line-clamp-3 text-sm">
                            {{ Str::limit(strip_tags($beritaUtama->konten), 220) }}
                        </p>

                        <div class="mt-4 inline-flex items-center gap-1 text-xs font-bold text-gray-900 group-hover:text-amber-600 uppercase tracking-wider">
                            Baca Selengkapnya &rarr;
                        </div>
                    </a>
                </article>

                <!-- List Berita Samping (3 Artikel Lainnya) -->
                <div class="flex flex-col gap-6 border-l border-gray-200 pl-0 lg:pl-8">
                    @forelse ($beritaLainnya as $item)
                        <article class="group">
                            <a href="{{ route('berita.show', $item->slug) }}" class="block">
                                <div class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1">
                                    {{ $item->created_at->translatedFormat('d F Y') }}
                                </div>
                                <h5 class="font-bold text-gray-900 group-hover:text-amber-600 transition leading-tight mb-2 line-clamp-2">
                                    {{ $item->judul }}
                                </h5>
                                <p class="text-xs text-gray-600 line-clamp-2 leading-relaxed">
                                    {{ Str::limit(strip_tags($item->konten), 110) }}
                                </p>
                            </a>
                        </article>

                        @if(!$loop->last)
                            <div class="w-full h-px bg-gray-200"></div>
                        @endif
                    @empty
                        <div class="py-8 text-center text-gray-400 text-xs">
                            Tidak ada berita sampingan lainnya saat ini.
                        </div>
                    @endforelse
                </div>

            </div>
        @else
            <!-- Empty State jika belum ada berita -->
            <div class="bg-white rounded-2xl border border-gray-200 p-12 text-center shadow-sm">
                <div class="w-16 h-16 mx-auto rounded-full bg-gray-100 flex items-center justify-center text-gray-400 mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
                <h4 class="text-base font-bold text-gray-900">Belum Ada Berita Diterbitkan</h4>
                <p class="text-xs text-gray-500 mt-1 max-w-sm mx-auto">
                    Berita dan pengumuman resmi giat Rutan Pandeglang akan segera dipublikasikan di sini.
                </p>
            </div>
        @endif
    </main>

    <!-- FOOTER RESMI -->
    <footer id="kontak" class="bg-gray-900 text-gray-400 py-12 mt-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-1">
                <h4 class="text-white font-extrabold text-lg mb-4 uppercase tracking-wider flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-amber-400"></span>
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
                    <li>Sabtu: 08.00 - 12.00 WIB (Kunjungan Khusus)</li>
                    <li>Minggu & Hari Libur: Tutup</li>
                </ul>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 pt-8 border-t border-gray-800 text-sm flex flex-col md:flex-row justify-between items-center text-xs">
            <p>&copy; {{ date('Y') }} Rutan Kelas IIB Pandeglang. Hak Cipta Dilindungi.</p>
            <div class="mt-3 md:mt-0 flex items-center gap-4">
                <span class="uppercase tracking-widest text-gray-500 font-semibold">Sistem Informasi Publik</span>
                <span class="text-gray-700">&bull;</span>
                <a href="{{ route('login') }}" class="text-gray-500 hover:text-amber-400 transition-colors font-medium">
                    Akses Admin
                </a>
            </div>
        </div>
    </footer>

</body>
</html>