<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $berita->judul }} - Rutan Kelas IIB Pandeglang</title>
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

    <!-- BREADCRUMB & HERO HEADER -->
    <section class="bg-gray-900 text-white py-8 border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-xs text-gray-400 mb-4">
                <a href="{{ url('/') }}" class="hover:text-amber-400 transition">Beranda</a>
                <span>&gt;</span>
                <a href="{{ url('/#berita') }}" class="hover:text-amber-400 transition">Publikasi</a>
                <span>&gt;</span>
                <span class="text-gray-300 truncate max-w-md">{{ $berita->judul }}</span>
            </nav>
            <div class="flex items-center gap-3 text-xs text-amber-400 font-semibold uppercase tracking-wider mb-2">
                <span>Rilis Resmi</span>
                <span>&bull;</span>
                <span>{{ $berita->created_at->translatedFormat('l, d F Y') }}</span>
                <span>&bull;</span>
                <span>{{ $berita->created_at->format('H:i') }} WIB</span>
            </div>
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold leading-tight text-white max-w-4xl">
                {{ $berita->judul }}
            </h1>
        </div>
    </section>

    <!-- CONTENT BODY & SIDEBAR -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <!-- Main Article Content (2 Kolom) -->
            <article class="lg:col-span-2 space-y-6">
                
                <!-- Gambar Sampul Utama -->
                @if($berita->gambar_sampul)
                    <div class="rounded-2xl overflow-hidden border border-gray-200 shadow-md bg-gray-900">
                        <img src="{{ asset('storage/' . $berita->gambar_sampul) }}" 
                             alt="{{ $berita->judul }}" 
                             class="w-full h-auto max-h-[500px] object-cover">
                    </div>
                @endif

                <!-- Metadata Penulis -->
                <div class="flex items-center justify-between py-3 border-y border-gray-200 text-xs text-gray-500">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-600 flex items-center justify-center font-bold">
                            H
                        </div>
                        <span class="font-medium text-gray-700">Ditulis oleh: Tim Humas Rutan Pandeglang</span>
                    </div>
                    <span class="bg-gray-100 px-2.5 py-1 rounded-md text-gray-600 font-mono">
                        {{ $berita->slug }}
                    </span>
                </div>

                <!-- Isi Artikel Berita -->
                <div class="prose prose-base max-w-none text-gray-700 leading-relaxed space-y-4 text-justify font-normal">
                    {!! nl2br(e($berita->konten)) !!}
                </div>

                <!-- Back Navigation Action -->
                <div class="pt-8 border-t border-gray-200 flex items-center justify-between">
                    <a href="{{ url('/#berita') }}" 
                       class="inline-flex items-center gap-2 px-4 py-2 bg-gray-900 hover:bg-gray-800 text-white text-xs font-bold uppercase tracking-wider rounded-lg transition">
                        &larr; Kembali ke Daftar Berita
                    </a>
                </div>
            </article>

            <!-- Sidebar Berita Terbaru Lainnya (1 Kolom) -->
            <aside class="space-y-6">
                <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm sticky top-28">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-gray-900 border-b border-gray-200 pb-3 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                        Berita Terkini Lainnya
                    </h3>

                    <div class="divide-y divide-gray-100 mt-4">
                        @forelse ($beritaTerbaru as $terbaru)
                            <div class="py-4 first:pt-0 last:pb-0 group">
                                <a href="{{ route('berita.show', $terbaru->slug) }}" class="block">
                                    <div class="text-[10px] font-bold text-amber-600 uppercase tracking-wider mb-1">
                                        {{ $terbaru->created_at->translatedFormat('d M Y') }}
                                    </div>
                                    <h4 class="font-semibold text-gray-900 group-hover:text-amber-600 transition leading-snug line-clamp-2 text-sm">
                                        {{ $terbaru->judul }}
                                    </h4>
                                </a>
                            </div>
                        @empty
                            <div class="py-6 text-center text-xs text-gray-400">
                                Belum ada artikel terkait lainnya.
                            </div>
                        @endforelse
                    </div>

                    <!-- Banner Info Layanan -->
                    <div class="mt-8 bg-gray-900 text-white rounded-xl p-5 border border-gray-800">
                        <h4 class="font-bold text-sm text-amber-400 mb-1">Layanan Kunjungan Besuk</h4>
                        <p class="text-xs text-gray-300 leading-relaxed mb-3">
                            Pastikan Anda telah mematuhi protokol dan membawa identitas resmi (KTP/KK) saat berkunjung ke rutan.
                        </p>
                        <a href="{{ url('/#layanan') }}" class="inline-block text-[11px] font-bold uppercase text-white hover:text-amber-400 transition">
                            Lihat Jadwal &rarr;
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
                <a href="{{ route('login') }}" class="text-gray-500 hover:text-amber-400 transition-colors font-medium">
                    Akses Admin
                </a>
            </div>
        </div>
    </footer>

</body>
</html>
