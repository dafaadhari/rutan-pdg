<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rutan Kelas IIB Pandeglang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased flex flex-col min-h-screen">

    <!-- NAVBAR -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <!-- Placeholder Logo Instansi -->
                <div class="w-10 h-10 bg-blue-950 rounded-full flex items-center justify-center text-white font-bold text-xs">
                    R
                </div>
                <div>
                    <h1 class="font-bold text-blue-950 text-lg leading-tight">RUTAN KELAS IIB</h1>
                    <p class="text-xs text-gray-500 font-semibold tracking-widest uppercase">Pandeglang</p>
                </div>
            </div>
            
            <nav class="hidden md:flex gap-8 text-sm font-semibold text-gray-600">
                <a href="#" class="text-blue-950 border-b-2 border-blue-950 pb-1">Beranda</a>
                <a href="#profil" class="hover:text-blue-950 transition">Profil</a>
                <a href="#berita" class="hover:text-blue-950 transition">Berita Publik</a>
                <a href="#kontak" class="hover:text-blue-950 transition">Kontak</a>
            </nav>
        </div>
    </header>

    <!-- HERO SECTION (Warna Navy Instansi) -->
    <section class="bg-blue-950 text-white relative overflow-hidden">
        <!-- Aksen Dekoratif -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-blue-900 opacity-50 blur-3xl"></div>
        
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32 relative z-10">
            <div class="max-w-2xl">
                <span class="text-blue-200 text-sm font-bold tracking-widest uppercase mb-4 block">
                    Kementerian Imigrasi dan Pemasyarakatan
                </span>
                <h2 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6">
                    Mewujudkan Pelayanan Pemasyarakatan yang PASTI.
                </h2>
                <p class="text-blue-100 text-lg mb-10 leading-relaxed max-w-xl">
                    Portal informasi resmi Rumah Tahanan Negara Kelas IIB Pandeglang. Profesional, Akuntabel, Sinergi, Transparan, dan Inovatif.
                </p>
                <div class="flex gap-4">
                    <a href="#berita" class="bg-white text-blue-950 px-6 py-3 rounded text-sm font-bold shadow-lg hover:bg-gray-100 transition">
                        Seputar Rutan
                    </a>
                    <a href="#kontak" class="border border-blue-400 text-white px-6 py-3 rounded text-sm font-bold hover:bg-blue-900 transition">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- SEKSI BERITA TERKINI (Placeholder UI) -->
    <main id="berita" class="flex-grow max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20 w-full">
        <div class="mb-12 flex justify-between items-end border-b border-gray-200 pb-4">
            <div>
                <h3 class="text-2xl font-extrabold text-blue-950">Berita Publikasi</h3>
                <p class="text-gray-500 text-sm mt-1">Kabar terbaru dari Rutan Kelas IIB Pandeglang</p>
            </div>
            <a href="#" class="text-sm font-semibold text-blue-700 hover:text-blue-900 transition">Lihat Semua &rarr;</a>
        </div>

        <!-- Grid Berita -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card Contoh -->
            <div class="bg-white rounded-lg border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition">
                <div class="aspect-video bg-gray-200"></div>
                <div class="p-6">
                    <div class="text-xs text-blue-600 font-bold mb-2">24 Agustus 2026</div>
                    <h4 class="font-bold text-gray-900 text-lg mb-3 leading-snug">Kegiatan Pembinaan Kemandirian Warga Binaan</h4>
                    <p class="text-sm text-gray-600 line-clamp-3">
                        Sebagai bentuk komitmen dalam memberikan bekal keterampilan, Rutan Pandeglang melaksanakan program pelatihan...
                    </p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition">
                <div class="aspect-video bg-gray-200"></div>
                <div class="p-6">
                    <div class="text-xs text-blue-600 font-bold mb-2">22 Agustus 2026</div>
                    <h4 class="font-bold text-gray-900 text-lg mb-3 leading-snug">Sidak Blok Hunian Bersama Tim Gabungan</h4>
                    <p class="text-sm text-gray-600 line-clamp-3">
                        Guna memastikan keamanan dan ketertiban, jajaran kesatuan pengamanan melakukan inspeksi mendadak...
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-lg border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition">
                <div class="aspect-video bg-gray-200"></div>
                <div class="p-6">
                    <div class="text-xs text-blue-600 font-bold mb-2">20 Agustus 2026</div>
                    <h4 class="font-bold text-gray-900 text-lg mb-3 leading-snug">Peringatan Hari Pengayoman Ke-81</h4>
                    <p class="text-sm text-gray-600 line-clamp-3">
                        Seluruh jajaran pegawai Rutan Kelas IIB Pandeglang melangsungkan upacara bendera dalam rangka memperingati...
                    </p>
                </div>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer id="kontak" class="bg-gray-900 text-gray-400 py-12 mt-auto border-t-4 border-blue-950">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h4 class="text-white font-bold text-lg mb-4">Rutan Kelas IIB Pandeglang</h4>
                <p class="text-sm leading-relaxed max-w-sm">
                    Unit Pelaksana Teknis Pemasyarakatan di bawah Kantor Wilayah Kementerian Hukum dan HAM / Imigrasi dan Pemasyarakatan Banten.
                </p>
            </div>
            <div class="md:text-right">
                <h4 class="text-white font-bold text-lg mb-4">Hubungi Kami</h4>
                <p class="text-sm">Jl. Raya Pandeglang - Serang</p>
                <p class="text-sm mt-1">Banten, Indonesia</p>
            </div>
        </div>
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 pt-8 border-t border-gray-800 text-sm text-center md:text-left flex flex-col md:flex-row justify-between">
            <p>&copy; {{ date('Y') }} Rutan Kelas IIB Pandeglang. Hak Cipta Dilindungi.</p>
            <p class="mt-2 md:mt-0">Sistem Informasi Publik</p>
        </div>
    </footer>

</body>
</html>