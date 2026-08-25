<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rutan Kelas IIB Pandeglang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased flex flex-col min-h-screen">

    <!-- TOP BAR KEMENTERIAN -->
    <div class="bg-gray-900 text-gray-300 py-1.5 text-xs font-semibold">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <span>Kementerian Imigrasi dan Pemasyarakatan RI</span>
            <span class="hidden md:inline">Reformasi Hukum dan HAM PASTI</span>
        </div>
    </div>

    <!-- NAVBAR INSTANSI -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <!-- Placeholder Logo Pengayoman/Rutan -->
                <div class="w-12 h-12 bg-gray-900 flex items-center justify-center text-white font-bold rounded-md shadow-inner">
                    R
                </div>
                <div>
                    <h1 class="font-extrabold text-gray-900 text-lg tracking-wide uppercase leading-none">
                        Rutan Kelas IIB
                    </h1>
                    <p class="text-xs text-gray-500 font-semibold tracking-widest uppercase mt-1">
                        Pandeglang
                    </p>
                </div>
            </div>
            
            <nav class="hidden md:flex gap-6 text-sm font-bold text-gray-600 uppercase tracking-wide">
                <a href="#" class="text-gray-900">Beranda</a>
                <a href="#layanan" class="hover:text-gray-900 transition">Layanan</a>
                <a href="#berita" class="hover:text-gray-900 transition">Publikasi</a>
                <a href="#kontak" class="hover:text-gray-900 transition">Kontak</a>
            </nav>
        </div>
    </header>

    <!-- HERO SECTION (TATA LETAK SPLIT) -->
    <section class="bg-gray-900 text-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-24">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Teks Hero -->
                <div>
                    <div class="inline-block bg-gray-800 border border-gray-700 text-gray-300 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest mb-6">
                        Portal Informasi Resmi
                    </div>
                    <h2 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6">
                        Mewujudkan Pelayanan <span class="text-gray-400">Pemasyarakatan yang PASTI.</span>
                    </h2>
                    <p class="text-gray-300 text-lg mb-8 leading-relaxed">
                        Kami berkomitmen memberikan pelayanan yang Profesional, Akuntabel, Sinergi, Transparan, dan Inovatif bagi Warga Binaan dan masyarakat luas.
                    </p>
                    <a href="#layanan" class="inline-block bg-white text-gray-900 px-6 py-3 font-bold text-sm uppercase tracking-wide hover:bg-gray-200 transition">
                        Lihat Layanan Publik
                    </a>
                </div>
                <!-- Kotak Placeholder Foto Gedung / Kegiatan -->
                <div class="hidden lg:block">
                    <div class="aspect-video bg-gray-800 border border-gray-700 rounded-lg flex items-center justify-center shadow-2xl relative overflow-hidden">
                        <span class="text-gray-500 text-sm font-bold uppercase tracking-widest">
                            [ Area Foto Gedung / Kepala Rutan ]
                        </span>
                        <!-- Elemen Dekoratif -->
                        <div class="absolute inset-0 bg-gradient-to-tr from-gray-900/50 to-transparent"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PANEL LAYANAN PUBLIK (Ciri khas instansi) -->
    <section id="layanan" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 -mt-10 mb-16">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 shadow-xl">
            <div class="bg-white p-6 border-t-4 border-gray-900 hover:-translate-y-1 transition duration-300">
                <h3 class="font-bold text-gray-900 mb-2">Jadwal Besuk</h3>
                <p class="text-xs text-gray-500">Informasi jam kunjungan tatap muka Warga Binaan.</p>
            </div>
            <div class="bg-white p-6 border-t-4 border-gray-700 hover:-translate-y-1 transition duration-300">
                <h3 class="font-bold text-gray-900 mb-2">Titipan Barang</h3>
                <p class="text-xs text-gray-500">SOP dan syarat penitipan barang & makanan.</p>
            </div>
            <div class="bg-white p-6 border-t-4 border-gray-500 hover:-translate-y-1 transition duration-300">
                <h3 class="font-bold text-gray-900 mb-2">Program Integrasi</h3>
                <p class="text-xs text-gray-500">Layanan pengurusan PB, CB, dan CMB.</p>
            </div>
            <div class="bg-gray-100 p-6 border-t-4 border-red-800 hover:-translate-y-1 transition duration-300">
                <h3 class="font-bold text-gray-900 mb-2">Pengaduan</h3>
                <p class="text-xs text-gray-600">Saluran aspirasi dan pengaduan masyarakat.</p>
            </div>
        </div>
    </section>

    <!-- SEKSI PUBLIKASI & BERITA (Layout Side-by-Side) -->
    <main id="berita" class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 w-full">
        <div class="flex justify-between items-center mb-8">
            <h3 class="text-2xl font-extrabold text-gray-900 uppercase tracking-wide">Giat & Informasi Terkini</h3>
            <a href="#" class="text-sm font-bold text-gray-600 hover:text-gray-900 uppercase tracking-widest transition">Semua Berita &rarr;</a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Berita Utama (Sorotan) - Memakan 2 kolom -->
            <div class="lg:col-span-2 group cursor-pointer">
                <div class="aspect-video bg-gray-200 w-full relative overflow-hidden mb-4">
                     <span class="absolute inset-0 flex items-center justify-center text-gray-400 font-bold text-sm uppercase">[ Foto Berita Utama ]</span>
                </div>
                <div class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Humas Rutan &bull; 24 Agustus 2026</div>
                <h4 class="text-2xl font-extrabold text-gray-900 group-hover:text-gray-600 transition leading-snug mb-3">
                    Pelaksanaan Razia Insidentil Blok Hunian Guna Cegah Gangguan Kamtib
                </h4>
                <p class="text-gray-600 leading-relaxed">
                    Menindaklanjuti arahan pimpinan pusat, jajaran kesatuan pengamanan Rutan Kelas IIB Pandeglang melaksanakan inspeksi mendadak ke seluruh blok hunian warga binaan pada pagi ini. Kegiatan ini bertujuan untuk memastikan tidak ada barang terlarang...
                </p>
            </div>

            <!-- List Berita Samping (Artikel Lainnya) -->
            <div class="flex flex-col gap-6 border-l border-gray-200 pl-0 lg:pl-8">
                
                <div class="group cursor-pointer">
                    <div class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1">22 Agustus 2026</div>
                    <h5 class="font-bold text-gray-900 group-hover:text-gray-600 transition leading-tight mb-2">
                        Pembinaan Kemandirian: Warga Binaan Produksi Handicraft
                    </h5>
                    <p class="text-sm text-gray-600 line-clamp-2">Pelatihan kerajinan tangan terus digencarkan sebagai bekal keterampilan saat bebas nanti.</p>
                </div>
                
                <div class="w-full h-px bg-gray-100"></div>

                <div class="group cursor-pointer">
                    <div class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1">20 Agustus 2026</div>
                    <h5 class="font-bold text-gray-900 group-hover:text-gray-600 transition leading-tight mb-2">
                        Upacara Peringatan Hari Pengayoman Ke-81 Berlangsung Khidmat
                    </h5>
                    <p class="text-sm text-gray-600 line-clamp-2">Seluruh petugas melangsungkan upacara bendera dengan mengenakan pakaian dinas lengkap.</p>
                </div>

                <div class="w-full h-px bg-gray-100"></div>

                <div class="group cursor-pointer">
                    <div class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1">15 Agustus 2026</div>
                    <h5 class="font-bold text-gray-900 group-hover:text-gray-600 transition leading-tight mb-2">
                        Kunjungan Tim Medis Dinkes Pandeglang Pantau Kesehatan Tahanan
                    </h5>
                    <p class="text-sm text-gray-600 line-clamp-2">Pemeriksaan kesehatan rutin dilakukan guna memastikan hak dasar kesehatan terpenuhi.</p>
                </div>

            </div>
        </div>
    </main>

    <!-- FOOTER RESMI -->
    <footer id="kontak" class="bg-gray-900 text-gray-400 py-12 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-1">
                <h4 class="text-white font-extrabold text-lg mb-4 uppercase tracking-wider">Rutan Pandeglang</h4>
                <p class="text-sm leading-relaxed mb-4">
                    Unit Pelaksana Teknis Pemasyarakatan di bawah naungan Kantor Wilayah Kementerian Imigrasi dan Pemasyarakatan Banten.
                </p>
            </div>
            
            <div>
                <h4 class="text-white font-bold text-sm mb-4 uppercase tracking-widest">Informasi Kontak</h4>
                <ul class="text-sm space-y-2">
                    <li>Jl. Raya Pandeglang - Serang</li>
                    <li>Banten, Indonesia</li>
                    <li class="mt-4">Email: info@rutanpandeglang.go.id</li>
                    <li>Telp: (0253) XXXXXX</li>
                </ul>
            </div>
            
            <div>
                <h4 class="text-white font-bold text-sm mb-4 uppercase tracking-widest">Jam Layanan</h4>
                <ul class="text-sm space-y-2">
                    <li>Senin: 08.00 - 14.00 WIB</li>
                    <li>Rabu: 08.00 - 14.00 WIB</li>
                    <li>Sabtu: 08.00 - 12.00 WIB</li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 pt-8 border-t border-gray-800 text-sm flex flex-col md:flex-row justify-between items-center">
            <p>&copy; {{ date('Y') }} Rutan Kelas IIB Pandeglang.</p>
            <p class="mt-2 md:mt-0 font-bold uppercase tracking-widest text-xs">Sistem Informasi Publik</p>
        </div>
    </footer>

</body>
</html>