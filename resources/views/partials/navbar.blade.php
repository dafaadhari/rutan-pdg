<!-- TOP BAR KEMENTERIAN -->
<div class="bg-gray-900 text-gray-300 py-1.5 text-xs font-semibold border-b border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <span class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-red-600"></span>
            Kementerian Imigrasi dan Pemasyarakatan Republik Indonesia
        </span>
        <span class="hidden md:inline text-gray-400">Reformasi Hukum & Pelayanan PASTI Berakhlak</span>
    </div>
</div>

<!-- HEADER INSTANSI (Logo & Nama Satker) -->
<div class="bg-white border-b border-gray-100 py-3.5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
        <a href="{{ url('/') }}" class="flex items-center gap-3.5 group">
            <!-- Lambang Pemasyarakatan / Rutan -->
            <div class="w-12 h-12 bg-gradient-to-br from-gray-900 to-blue-950 rounded-xl flex items-center justify-center text-amber-400 shadow-md border border-gray-800 group-hover:scale-105 transition">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-bold text-gray-600 uppercase tracking-tight leading-tight">
                    Kementerian Imigrasi dan Pemasyarakatan Republik Indonesia
                </p>
                <h1 class="text-base sm:text-lg font-black text-gray-900 uppercase tracking-tight leading-none mt-0.5">
                    Rumah Tahanan Negara Kelas IIB Pandeglang
                </h1>
            </div>
        </a>

        <!-- Mobile Hamburger Button -->
        <button id="mobile-menu-btn" type="button" class="md:hidden p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path id="hamburger-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                <path id="close-icon" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</div>

<!-- NAVBAR DENGAN DROPDOWN MULTI-LEVEL (Sticky) -->
<nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="hidden md:flex items-center space-x-1 h-12 text-xs font-bold uppercase tracking-wider">
            
            <!-- 1. HOME -->
            <a href="{{ url('/') }}" 
               class="px-3.5 py-3 transition {{ request()->is('/') ? 'text-red-600 border-b-2 border-red-600 font-extrabold' : 'text-gray-700 hover:text-red-600' }}">
                HOME
            </a>

            <!-- 2. TENTANG KAMI (Dropdown) -->
            <div class="relative group">
                <button type="button" 
                        class="flex items-center gap-1 px-3.5 py-3 transition {{ request()->routeIs('tentang-kami') ? 'text-red-600 border-b-2 border-red-600 font-extrabold' : 'text-gray-700 group-hover:text-red-600' }}">
                    <span>TENTANG KAMI</span>
                    <svg class="w-3.5 h-3.5 text-gray-400 group-hover:text-red-600 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div class="absolute top-full left-0 pt-1 w-64 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                    <div class="bg-white border border-gray-200 rounded-xl shadow-xl py-2 overflow-hidden">
                        <a href="{{ route('tentang-kami', 'motto-dan-logo') }}" class="block px-4 py-2 text-xs normal-case font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                            Motto dan Logo
                        </a>
                        <a href="{{ route('tentang-kami', 'sejarah') }}" class="block px-4 py-2 text-xs normal-case font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                            Sejarah
                        </a>
                        <a href="{{ route('tentang-kami', 'unit-pelaksana-teknis') }}" class="block px-4 py-2 text-xs normal-case font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                            Unit Pelaksana Teknis
                        </a>
                        <a href="{{ route('tentang-kami', 'profil-organisasi') }}" class="block px-4 py-2 text-xs normal-case font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                            Profil Organisasi
                        </a>
                        <a href="{{ route('tentang-kami', 'profil-pejabat') }}" class="block px-4 py-2 text-xs normal-case font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                            Profil Pejabat
                        </a>
                        <a href="{{ route('tentang-kami', 'struktur-organisasi') }}" class="block px-4 py-2 text-xs normal-case font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                            Struktur Organisasi
                        </a>
                        <a href="{{ route('tentang-kami', 'strategi-organisasi') }}" class="block px-4 py-2 text-xs normal-case font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                            Strategi Organisasi
                        </a>
                        <div class="h-px bg-gray-100 my-1"></div>
                        <a href="{{ route('tentang-kami', 'kontak-kami') }}" class="block px-4 py-2 text-xs normal-case font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                            Kontak Kami
                        </a>
                    </div>
                </div>
            </div>

            <!-- 3. LAYANAN (Dropdown) -->
            <div class="relative group">
                <button type="button" 
                        class="flex items-center gap-1 px-3.5 py-3 transition {{ request()->routeIs('layanan') ? 'text-red-600 border-b-2 border-red-600 font-extrabold' : 'text-gray-700 group-hover:text-red-600' }}">
                    <span>LAYANAN</span>
                    <svg class="w-3.5 h-3.5 text-gray-400 group-hover:text-red-600 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div class="absolute top-full left-0 pt-1 w-96 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                    <div class="bg-white border border-gray-200 rounded-xl shadow-xl py-2 overflow-hidden">
                        <a href="{{ route('layanan', 'permohonan-data-dan-informasi') }}" class="block px-4 py-2 text-xs normal-case font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                            Permohonan Data dan Informasi
                        </a>
                        <a href="{{ route('layanan', 'media-massa') }}" class="block px-4 py-2 text-xs normal-case font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                            Media Massa
                        </a>
                        <a href="{{ route('layanan', 'simonev-bama') }}" class="block px-4 py-2 text-xs normal-case font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition leading-snug">
                            Sistem Informasi Monitoring dan Evaluasi Bahan Makanan Kementerian Imigrasi dan Pemasyarakatan
                        </a>
                        <div class="h-px bg-gray-100 my-1"></div>
                        <a href="{{ route('layanan', 'perizinan-penelitian') }}" class="block px-4 py-2 text-xs normal-case font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                            Perizinan Penelitian
                        </a>
                        <a href="{{ route('layanan', 'perizinan-magang') }}" class="block px-4 py-2 text-xs normal-case font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                            Perizinan Magang
                        </a>
                        <a href="{{ route('layanan', 'perizinan-peliputan') }}" class="block px-4 py-2 text-xs normal-case font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                            Perizinan Peliputan
                        </a>
                        <div class="h-px bg-gray-100 my-1"></div>
                        <a href="{{ route('layanan', 'pengaduan') }}" class="block px-4 py-2 text-xs normal-case font-semibold text-red-600 hover:bg-red-50 transition">
                            Pengaduan
                        </a>
                    </div>
                </div>
            </div>

            <!-- 4. INFORMASI PUBLIK (Dropdown) -->
            <div class="relative group">
                <button type="button" 
                        class="flex items-center gap-1 px-3.5 py-3 transition {{ request()->routeIs('informasi-publik') ? 'text-red-600 border-b-2 border-red-600 font-extrabold' : 'text-gray-700 group-hover:text-red-600' }}">
                    <span>INFORMASI PUBLIK</span>
                    <svg class="w-3.5 h-3.5 text-gray-400 group-hover:text-red-600 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div class="absolute top-full left-0 pt-1 w-64 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                    <div class="bg-white border border-gray-200 rounded-xl shadow-xl py-2 overflow-hidden">
                        <a href="{{ route('informasi-publik', 'lakip') }}" class="block px-4 py-2 text-xs normal-case font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                            LAKIP
                        </a>
                        <a href="{{ route('informasi-publik', 'dipa') }}" class="block px-4 py-2 text-xs normal-case font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                            DIPA
                        </a>
                        <a href="{{ route('informasi-publik', 'laporan-tahunan') }}" class="block px-4 py-2 text-xs normal-case font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                            Laporan Tahunan
                        </a>
                        <a href="{{ route('informasi-publik', 'laporan-keuangan') }}" class="block px-4 py-2 text-xs normal-case font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                            Laporan Keuangan
                        </a>
                        <a href="{{ route('informasi-publik', 'rencana-strategis') }}" class="block px-4 py-2 text-xs normal-case font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                            Rencana Strategis
                        </a>
                        <a href="{{ route('informasi-publik', 'iku') }}" class="block px-4 py-2 text-xs normal-case font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                            IKU
                        </a>
                        <a href="{{ route('informasi-publik', 'perjanjian-kinerja') }}" class="block px-4 py-2 text-xs normal-case font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                            Perjanjian Kinerja
                        </a>
                        <div class="h-px bg-gray-100 my-1"></div>
                        <a href="{{ route('informasi-publik', 'hasil-survei-spak-spkp') }}" class="block px-4 py-2 text-xs normal-case font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                            Hasil Survei SPAK/SPKP
                        </a>
                    </div>
                </div>
            </div>

            <!-- 5. BERITA & PUBLIKASI -->
            <a href="{{ url('/#berita') }}" 
               class="px-3.5 py-3 transition {{ request()->routeIs('berita.*') ? 'text-red-600 border-b-2 border-red-600 font-extrabold' : 'text-gray-700 hover:text-red-600' }}">
                BERITA
            </a>

        </div>

        <!-- Mobile Menu Drawer (Hidden by default) -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-gray-200 py-3 space-y-1 text-sm font-medium">
            <a href="{{ url('/') }}" class="block px-3 py-2 text-red-600 font-bold hover:bg-gray-50 rounded-lg">
                HOME
            </a>
            
            <!-- Mobile Accordion: Tentang Kami -->
            <details class="group/m" {{ request()->routeIs('tentang-kami') ? 'open' : '' }}>
                <summary class="flex justify-between items-center px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg cursor-pointer font-bold">
                    <span>TENTANG KAMI</span>
                    <svg class="w-4 h-4 transition-transform group-open/m:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </summary>
                <div class="pl-5 pr-2 py-1 space-y-1 text-xs text-gray-600">
                    <a href="{{ route('tentang-kami', 'motto-dan-logo') }}" class="block py-1.5 hover:text-red-600">Motto dan Logo</a>
                    <a href="{{ route('tentang-kami', 'sejarah') }}" class="block py-1.5 hover:text-red-600">Sejarah</a>
                    <a href="{{ route('tentang-kami', 'unit-pelaksana-teknis') }}" class="block py-1.5 hover:text-red-600">Unit Pelaksana Teknis</a>
                    <a href="{{ route('tentang-kami', 'profil-organisasi') }}" class="block py-1.5 hover:text-red-600">Profil Organisasi</a>
                    <a href="{{ route('tentang-kami', 'profil-pejabat') }}" class="block py-1.5 hover:text-red-600">Profil Pejabat</a>
                    <a href="{{ route('tentang-kami', 'struktur-organisasi') }}" class="block py-1.5 hover:text-red-600">Struktur Organisasi</a>
                    <a href="{{ route('tentang-kami', 'strategi-organisasi') }}" class="block py-1.5 hover:text-red-600">Strategi Organisasi</a>
                    <a href="{{ route('tentang-kami', 'kontak-kami') }}" class="block py-1.5 hover:text-red-600">Kontak Kami</a>
                </div>
            </details>

            <!-- Mobile Accordion: Layanan -->
            <details class="group/m" {{ request()->routeIs('layanan') ? 'open' : '' }}>
                <summary class="flex justify-between items-center px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg cursor-pointer font-bold">
                    <span>LAYANAN</span>
                    <svg class="w-4 h-4 transition-transform group-open/m:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </summary>
                <div class="pl-5 pr-2 py-1 space-y-1 text-xs text-gray-600">
                    <a href="{{ route('layanan', 'permohonan-data-dan-informasi') }}" class="block py-1.5 hover:text-red-600">Permohonan Data dan Informasi</a>
                    <a href="{{ route('layanan', 'media-massa') }}" class="block py-1.5 hover:text-red-600">Media Massa</a>
                    <a href="{{ route('layanan', 'simonev-bama') }}" class="block py-1.5 hover:text-red-600">SIMONEV Bama Kemenimipas</a>
                    <a href="{{ route('layanan', 'perizinan-penelitian') }}" class="block py-1.5 hover:text-red-600">Perizinan Penelitian</a>
                    <a href="{{ route('layanan', 'perizinan-magang') }}" class="block py-1.5 hover:text-red-600">Perizinan Magang</a>
                    <a href="{{ route('layanan', 'perizinan-peliputan') }}" class="block py-1.5 hover:text-red-600">Perizinan Peliputan</a>
                    <a href="{{ route('layanan', 'pengaduan') }}" class="block py-1.5 hover:text-red-600 font-semibold text-red-600">Pengaduan</a>
                </div>
            </details>

            <!-- Mobile Accordion: Informasi Publik -->
            <details class="group/m" {{ request()->routeIs('informasi-publik') ? 'open' : '' }}>
                <summary class="flex justify-between items-center px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg cursor-pointer font-bold">
                    <span>INFORMASI PUBLIK</span>
                    <svg class="w-4 h-4 transition-transform group-open/m:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </summary>
                <div class="pl-5 pr-2 py-1 space-y-1 text-xs text-gray-600">
                    <a href="{{ route('informasi-publik', 'lakip') }}" class="block py-1.5 hover:text-red-600">LAKIP</a>
                    <a href="{{ route('informasi-publik', 'dipa') }}" class="block py-1.5 hover:text-red-600">DIPA</a>
                    <a href="{{ route('informasi-publik', 'laporan-tahunan') }}" class="block py-1.5 hover:text-red-600">Laporan Tahunan</a>
                    <a href="{{ route('informasi-publik', 'laporan-keuangan') }}" class="block py-1.5 hover:text-red-600">Laporan Keuangan</a>
                    <a href="{{ route('informasi-publik', 'rencana-strategis') }}" class="block py-1.5 hover:text-red-600">Rencana Strategis</a>
                    <a href="{{ route('informasi-publik', 'iku') }}" class="block py-1.5 hover:text-red-600">IKU</a>
                    <a href="{{ route('informasi-publik', 'perjanjian-kinerja') }}" class="block py-1.5 hover:text-red-600">Perjanjian Kinerja</a>
                    <a href="{{ route('informasi-publik', 'hasil-survei-spak-spkp') }}" class="block py-1.5 hover:text-red-600">Hasil Survei SPAK/SPKP</a>
                </div>
            </details>

            <a href="{{ url('/#berita') }}" class="block px-3 py-2 text-gray-700 font-bold hover:bg-gray-50 rounded-lg">
                BERITA
            </a>
        </div>
    </div>
</nav>

<script>
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const closeIcon = document.getElementById('close-icon');

    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            hamburgerIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });
    }
</script>
