@php
    $labelMenu = fn ($kategori, $label) => $kategori === 'layanan' ? 'Layanan' : $label;
    $kelasMenu = 'relative inline-flex items-center gap-1 px-3 py-2 rounded-md text-sm font-semibold transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-500';
    $kelasAktif = 'text-navy-950 after:absolute after:inset-x-3 after:-bottom-[17px] after:h-[3px] after:rounded-full after:bg-emas-500';
    $kelasPasif = 'text-gray-600 hover:text-navy-950 hover:bg-navy-50';
@endphp

<!-- TOPBAR KEMENTERIAN -->
<div class="bg-navy-950 text-navy-200 text-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-9 flex items-center justify-between gap-4">
        <span class="flex items-center gap-2 min-w-0">
            <span class="truncate">Kementerian Imigrasi dan Pemasyarakatan Republik Indonesia</span>
        </span>
        <div class="hidden md:flex items-center gap-5 shrink-0">
            @if($kontak['telepon'])
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $kontak['telepon']) }}" class="hover:text-white transition">Telp. {{ $kontak['telepon'] }}</a>
            @endif
            @if($kontak['email'])
                <a href="mailto:{{ $kontak['email'] }}" class="hover:text-white transition">{{ $kontak['email'] }}</a>
            @endif
            @if($kontak['lapor'])
                <a href="{{ $kontak['lapor'] }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 font-semibold text-red-300 hover:text-red-200 transition">
                    <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>
                    Pengaduan
                </a>
            @endif
        </div>
    </div>
</div>

<!-- HEADER UTAMA: LOGO + NAVIGASI (Sticky) -->
<header data-header-sticky class="bg-white/95 backdrop-blur border-b border-gray-200 sticky top-0 z-50 shadow-[0_1px_0_0_rgba(6,13,29,0.05)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between gap-4 h-[68px] lg:h-[72px]">
            <!-- Identitas -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 min-w-0 group focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-500 rounded-lg">
                <x-logo class="w-11 h-11 lg:w-12 lg:h-12 group-hover:scale-[1.03] transition-transform" />
                <span class="min-w-0 leading-tight">
                    <span class="block text-[11px] sm:text-xs font-semibold text-gray-500 truncate"><span class="sm:hidden">Kanwil Ditjenpas Banten</span><span class="hidden sm:inline">Kantor Wilayah Ditjen Pemasyarakatan Banten</span></span>
                    <span class="block text-[15px] sm:text-lg font-extrabold text-navy-950 tracking-tight truncate">Rutan Kelas IIB Pandeglang</span>
                </span>
            </a>

            <!-- Navigasi Desktop -->
            <nav aria-label="Navigasi utama" class="relative hidden lg:flex items-center gap-1">
                <a href="{{ route('home') }}" @if(request()->routeIs('home')) aria-current="page" @endif
                   class="{{ $kelasMenu }} {{ request()->routeIs('home') ? $kelasAktif : $kelasPasif }}">
                    Beranda
                </a>

                @foreach (\App\Models\Halaman::KATEGORI as $kategori => $labelKategori)
                    @php $itemMenu = $menuHalaman->get($kategori, collect()); @endphp
                    @continue($itemMenu->isEmpty())
                    {{-- Panel dropdown menempel di tepi kanan area menu agar tidak keluar layar --}}
                    <div class="group" data-dropdown>
                        <button type="button" aria-haspopup="true"
                                class="{{ $kelasMenu }} {{ request()->routeIs($kategori) ? $kelasAktif : $kelasPasif }}">
                            {{ $labelMenu($kategori, $labelKategori) }}
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200 group-hover:rotate-180 group-focus-within:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        @php
                            $banyak = $itemMenu->count() > 4;
                            $deskripsi = \App\Models\Halaman::DESKRIPSI_KATEGORI[$kategori] ?? null;
                        @endphp
                        <div class="absolute top-full right-0 z-50 pt-5 opacity-0 invisible translate-y-1 transition duration-200 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 group-focus-within:opacity-100 group-focus-within:visible group-focus-within:translate-y-0">
                            <div class="flex {{ $banyak ? 'w-[46rem]' : 'w-[34rem]' }} overflow-hidden rounded-2xl bg-white shadow-2xl shadow-navy-950/15 ring-1 ring-navy-950/[0.06]">
                                {{-- Pengantar menu --}}
                                <div class="flex w-56 shrink-0 flex-col border-t-[3px] border-emas-500 bg-navy-950 p-5 text-white">
                                    <p class="text-[11px] font-bold uppercase tracking-widest text-emas-400">Rutan Pandeglang</p>
                                    <p class="mt-1.5 text-lg font-extrabold tracking-tight">{{ $labelMenu($kategori, $labelKategori) }}</p>
                                    @if($deskripsi)
                                        <p class="mt-2 text-[13px] leading-relaxed text-navy-200">{{ $deskripsi }}</p>
                                    @endif
                                    <a href="{{ route($kategori) }}"
                                       class="mt-auto inline-flex items-center gap-1.5 pt-5 text-sm font-semibold text-emas-300 transition hover:text-emas-200 focus:outline-none focus-visible:underline">
                                        Buka halaman <x-panah />
                                    </a>
                                </div>

                                {{-- Sub-bab --}}
                                <ul class="grid flex-1 content-start gap-0.5 p-2.5 {{ $banyak ? 'grid-cols-2' : 'grid-cols-1' }}">
                                    @foreach ($itemMenu as $item)
                                        <li>
                                            {{-- Di halaman kategorinya sendiri, item ditandai sesuai seksi yang sedang dibaca --}}
                                            <a href="{{ $item->url }}" @if(request()->routeIs($kategori)) data-penanda="{{ $item->slug }}" @endif
                                               class="group/item flex items-start gap-3 rounded-xl p-2.5 transition-colors hover:bg-navy-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-500 data-aktif:bg-navy-50">
                                                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-navy-50 text-navy-700 ring-1 ring-navy-100 transition-colors group-hover/item:bg-navy-950 group-hover/item:text-emas-400 group-hover/item:ring-navy-950 group-data-aktif/item:bg-navy-950 group-data-aktif/item:text-emas-400 group-data-aktif/item:ring-navy-950">
                                                    <x-ikon :nama="$item->ikon" class="h-[18px] w-[18px]" />
                                                </span>
                                                <span class="min-w-0 pt-px">
                                                    <span class="block text-sm font-semibold leading-snug text-navy-950">{{ $item->judul }}</span>
                                                    @if($item->ringkasan)
                                                        <span class="mt-0.5 text-xs leading-snug text-gray-500 line-clamp-2">{{ $item->ringkasan }}</span>
                                                    @endif
                                                </span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach

                <a href="{{ route('berita.index') }}" @if(request()->routeIs('berita.*')) aria-current="page" @endif
                   class="{{ $kelasMenu }} {{ request()->routeIs('berita.*') ? $kelasAktif : $kelasPasif }}">
                    Berita
                </a>
            </nav>

            <!-- Tombol Menu Mobile -->
            <button id="mobile-menu-btn" type="button" aria-controls="mobile-menu" aria-expanded="false" aria-label="Buka menu navigasi"
                    class="lg:hidden inline-flex items-center gap-2 -mr-1 px-3 py-2 rounded-lg text-sm font-semibold text-navy-950 border border-gray-200 hover:bg-navy-50 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path id="hamburger-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path id="close-icon" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                <span>Menu</span>
            </button>
        </div>

        <!-- Drawer Menu Mobile -->
        <nav id="mobile-menu" aria-label="Navigasi utama (seluler)"
             class="hidden lg:hidden border-t border-gray-100 py-3 space-y-1 max-h-[calc(100dvh-4.5rem)] overflow-y-auto overscroll-contain">
            <a href="{{ route('home') }}" class="block px-3 py-2.5 rounded-lg text-sm font-semibold {{ request()->routeIs('home') ? 'bg-navy-50 text-navy-950' : 'text-gray-700 hover:bg-gray-50' }}">
                Beranda
            </a>

            @foreach (\App\Models\Halaman::KATEGORI as $kategori => $labelKategori)
                @php $itemMenu = $menuHalaman->get($kategori, collect()); @endphp
                @continue($itemMenu->isEmpty())
                <details class="group/m" {{ request()->routeIs($kategori) ? 'open' : '' }}>
                    <summary class="flex justify-between items-center px-3 py-2.5 rounded-lg cursor-pointer text-sm font-semibold {{ request()->routeIs($kategori) ? 'text-navy-950' : 'text-gray-700' }} hover:bg-gray-50 list-none [&::-webkit-details-marker]:hidden">
                        <span>{{ $labelMenu($kategori, $labelKategori) }}</span>
                        <svg class="w-4 h-4 text-gray-400 transition-transform group-open/m:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </summary>
                    <div class="ml-3 pl-3 border-l-2 border-emas-400/60 py-1 space-y-0.5">
                        @foreach ($itemMenu as $item)
                            <a href="{{ $item->url }}" @if(request()->routeIs($kategori)) data-penanda="{{ $item->slug }}" @endif
                               class="block px-3 py-2 rounded-md text-sm text-gray-600 hover:bg-gray-50 hover:text-navy-950 data-aktif:bg-navy-50 data-aktif:font-semibold data-aktif:text-navy-950">{{ $item->judul }}</a>
                        @endforeach
                    </div>
                </details>
            @endforeach

            <a href="{{ route('berita.index') }}" class="block px-3 py-2.5 rounded-lg text-sm font-semibold {{ request()->routeIs('berita.*') ? 'bg-navy-50 text-navy-950' : 'text-gray-700 hover:bg-gray-50' }}">
                Berita
            </a>

            @if($kontak['lapor'])
                <a href="{{ $kontak['lapor'] }}" target="_blank" rel="noopener" class="mt-2 flex items-center justify-center gap-2 px-3 py-2.5 rounded-lg text-sm font-bold text-white bg-red-600 hover:bg-red-700">
                    Sampaikan Pengaduan (SP4N-LAPOR!) <x-panah arah="serong" />
                </a>
            @endif
        </nav>
    </div>
</header>

<script>
    (function () {
        const tombol = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        if (!tombol || !menu) return;

        function atur(terbuka) {
            menu.classList.toggle('hidden', !terbuka);
            document.getElementById('hamburger-icon').classList.toggle('hidden', terbuka);
            document.getElementById('close-icon').classList.toggle('hidden', !terbuka);
            tombol.setAttribute('aria-expanded', terbuka ? 'true' : 'false');
            tombol.setAttribute('aria-label', terbuka ? 'Tutup menu navigasi' : 'Buka menu navigasi');
        }

        tombol.addEventListener('click', function () {
            atur(menu.classList.contains('hidden'));
        });

        // Sub-bab berupa tautan ke seksi: tutup menu setelah dipilih agar seksinya terlihat
        menu.querySelectorAll('a[href*="#"]').forEach(function (a) {
            a.addEventListener('click', function () { atur(false); });
        });

        // Dropdown desktop: lepas fokus setelah memilih agar panel menutup
        document.querySelectorAll('[data-dropdown] a').forEach(function (a) {
            a.addEventListener('click', function () { a.blur(); });
        });
    })();
</script>
