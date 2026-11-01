@extends('layouts.publik')

@section('konten')
    @php
        $fotoGedung = \App\Support\Aset::gedung();
        $kelasEyebrow = 'inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest';
    @endphp

    <!-- HERO -->
    <section class="relative overflow-hidden bg-navy-950 text-white">
        @if($fotoGedung)
            <img src="{{ $fotoGedung }}" alt="" class="absolute inset-0 w-full h-full object-cover object-[center_35%] opacity-60" aria-hidden="true">
            <div class="absolute inset-0 bg-gradient-to-r from-navy-950 via-navy-950/85 to-navy-950/35" aria-hidden="true"></div>
            <div class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-navy-950/80 to-transparent" aria-hidden="true"></div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-navy-900 via-navy-950 to-navy-950" aria-hidden="true"></div>
            <div class="absolute inset-0 opacity-[0.06] bg-[linear-gradient(to_right,#fff_1px,transparent_1px),linear-gradient(to_bottom,#fff_1px,transparent_1px)] [background-size:44px_44px] [mask-image:radial-gradient(ellipse_at_top_right,#000_30%,transparent_75%)]" aria-hidden="true"></div>
            <div class="absolute -top-24 right-0 w-[520px] h-[520px] rounded-full bg-emas-500/10 blur-3xl" aria-hidden="true"></div>
        @endif

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-14 pb-28 sm:pt-20 sm:pb-32 lg:pt-24 lg:pb-36">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-7">
                    <p class="{{ $kelasEyebrow }} text-emas-300">
                        Portal Informasi Resmi
                    </p>
                    <h1 class="mt-5 text-4xl sm:text-5xl lg:text-[3.5rem] font-extrabold leading-[1.08] tracking-tight">
                        Mewujudkan pelayanan pemasyarakatan yang <span class="text-emas-400">PASTI</span>
                    </h1>
                    <p class="mt-6 max-w-xl text-base sm:text-lg leading-relaxed text-navy-100">
                        Pelayanan yang Profesional, Akuntabel, Sinergi, Transparan, dan Inovatif bagi Warga Binaan dan masyarakat luas.
                    </p>
                    <div class="mt-9 flex flex-wrap gap-3">
                        <a href="#layanan"
                           class="inline-flex items-center gap-2 rounded-lg bg-emas-500 px-6 py-3 text-sm font-bold text-navy-950 shadow-lg shadow-emas-500/20 hover:bg-emas-400 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-300 focus-visible:ring-offset-2 focus-visible:ring-offset-navy-950">
                            Lihat Layanan <span aria-hidden="true"><x-panah /></span>
                        </a>
                        @if($halamanPengaduan)
                            <a href="{{ $halamanPengaduan->url }}"
                               class="inline-flex items-center gap-2 rounded-lg border border-white/25 px-6 py-3 text-sm font-bold text-white hover:bg-white/10 hover:border-white/40 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-300">
                                Sampaikan Pengaduan
                            </a>
                        @endif
                    </div>

                    <!-- Identitas ringkas (seluler) -->
                    <div class="mt-10 flex items-center gap-3 lg:hidden">
                        <x-logo class="w-12 h-12" />
                        <div class="text-sm leading-tight">
                            <p class="font-bold">Zona Integritas</p>
                            <p class="text-navy-200">WBK · WBBM · PASTI Berakhlak</p>
                        </div>
                    </div>
                </div>

                <!-- Logo & identitas (desktop) -->
                <div class="hidden lg:block lg:col-span-5">
                    <div class="relative rounded-3xl border border-white/15 bg-navy-950/55 p-10 text-center backdrop-blur-md shadow-2xl">
                        <x-logo class="w-36 h-36 mx-auto drop-shadow-[0_8px_24px_rgba(0,0,0,0.45)]" />
                        <p class="mt-6 text-xs font-bold uppercase tracking-widest text-emas-300">Zona Integritas</p>
                        <p class="mt-2 text-xl font-extrabold leading-snug">Wilayah Bebas dari Korupsi &amp;<br>Wilayah Birokrasi Bersih Melayani</p>
                        <ul class="mt-6 flex flex-wrap justify-center gap-2 text-xs font-bold">
                            <li class="rounded-full border border-emas-400/40 bg-emas-500/10 px-3 py-1 text-emas-200">WBK</li>
                            <li class="rounded-full border border-emas-400/40 bg-emas-500/10 px-3 py-1 text-emas-200">WBBM</li>
                            <li class="rounded-full border border-emas-400/40 bg-emas-500/10 px-3 py-1 text-emas-200">PASTI Berakhlak</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- HIGHLIGHT LAYANAN (dipilih admin: "Tampilkan di beranda", maks. 4) -->
    @if($layananHighlight->isNotEmpty())
        <section id="layanan" aria-labelledby="judul-layanan" class="relative z-10 -mt-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 scroll-mt-28">
            <h2 id="judul-layanan" class="sr-only">Layanan utama</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($layananHighlight as $layanan)
                    <a href="{{ $layanan->url }}"
                       class="group relative flex gap-4 sm:flex-col sm:gap-0 overflow-hidden rounded-2xl border border-gray-200 bg-white p-5 sm:p-6 shadow-lg shadow-navy-950/5 hover:-translate-y-1 hover:shadow-xl hover:shadow-navy-950/10 transition duration-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-500 focus-visible:ring-offset-2">
                        <span class="absolute inset-x-0 top-0 h-1 origin-left scale-x-0 bg-emas-500 transition-transform duration-300 group-hover:scale-x-100" aria-hidden="true"></span>
                        <span class="flex w-12 h-12 shrink-0 items-center justify-center rounded-xl bg-navy-900 text-emas-400 group-hover:bg-navy-800 transition">
                            <x-ikon :nama="$layanan->ikon" class="w-6 h-6" />
                        </span>
                        <span class="flex min-w-0 flex-1 flex-col sm:mt-5">
                            <span class="text-base font-bold text-navy-950">{{ $layanan->judul }}</span>
                            <span class="mt-1.5 text-sm leading-relaxed text-gray-600 line-clamp-2">{{ $layanan->ringkasan }}</span>
                            <span class="mt-auto pt-4 text-sm font-semibold text-emas-700">
                                Selengkapnya <span class="inline-block transition-transform group-hover:translate-x-1" aria-hidden="true"><x-panah /></span>
                            </span>
                        </span>
                    </a>
                @endforeach
            </div>
            <div class="mt-4 flex justify-end">
                <a href="{{ route('layanan') }}" class="inline-flex items-center gap-1 text-sm font-semibold text-navy-800 hover:text-navy-950 hover:underline underline-offset-4 focus:outline-none focus-visible:underline">
                    Lihat semua layanan <span aria-hidden="true"><x-panah /></span>
                </a>
            </div>
        </section>
    @endif

    <!-- BERITA TERKINI -->
    <section id="berita" aria-labelledby="judul-berita" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 scroll-mt-28">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mb-8">
            <div>
                <p class="{{ $kelasEyebrow }} text-emas-700">
                    Berita & Kegiatan
                </p>
                <h2 id="judul-berita" class="mt-2 text-2xl sm:text-3xl font-extrabold tracking-tight text-navy-950">Giat & informasi terkini</h2>
                <p class="mt-1 text-sm text-gray-600">Publikasi resmi kegiatan dan pembinaan Warga Binaan.</p>
            </div>
            <a href="{{ route('berita.index') }}" class="inline-flex items-center gap-1 text-sm font-semibold text-navy-800 hover:text-navy-950 hover:underline underline-offset-4 focus:outline-none focus-visible:underline">
                Lihat semua berita <span aria-hidden="true"><x-panah /></span>
            </a>
        </div>

        @if($beritaUtama)
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 lg:gap-10">
                <!-- Berita utama -->
                <article class="group lg:col-span-3">
                    <a href="{{ route('berita.show', $beritaUtama->slug) }}" class="block focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-500 rounded-2xl">
                        <x-sampul-berita :berita="$beritaUtama" class="aspect-[2/1] rounded-2xl shadow-md" />
                        <p class="mt-5 text-sm font-semibold text-emas-700">
                            <span class="font-bold">{{ $beritaUtama->kategori_label }}</span>
                            <span class="mx-1.5 text-gray-300" aria-hidden="true">•</span>
                            <time datetime="{{ $beritaUtama->created_at->toDateString() }}" class="font-medium text-gray-500">{{ $beritaUtama->created_at->translatedFormat('l, d F Y') }}</time>
                        </p>
                        <h3 class="mt-2 text-xl sm:text-2xl font-bold leading-snug text-navy-950 group-hover:text-navy-700 transition">
                            {{ $beritaUtama->judul }}
                        </h3>
                        <p class="mt-3 text-[15px] leading-relaxed text-gray-600 line-clamp-3">
                            {{ Str::limit(strip_tags($beritaUtama->konten), 240) }}
                        </p>
                        <span class="mt-4 inline-flex items-center gap-1 text-sm font-semibold text-navy-800 group-hover:text-navy-950">
                            Baca selengkapnya <span class="inline-block transition-transform group-hover:translate-x-1" aria-hidden="true"><x-panah /></span>
                        </span>
                    </a>
                </article>

                <!-- Berita lainnya -->
                <div class="lg:col-span-2">
                    @if($beritaLainnya->isNotEmpty())
                        <ul class="divide-y divide-gray-200 border-y border-gray-200">
                            @foreach ($beritaLainnya as $item)
                                <li>
                                    <a href="{{ route('berita.show', $item->slug) }}" class="group flex gap-4 py-4 focus:outline-none focus-visible:bg-navy-50">
                                        <x-sampul-berita :berita="$item" ukuran="kecil" class="w-28 h-20 sm:w-32 sm:h-24 shrink-0 rounded-xl" />
                                        <div class="min-w-0">
                                            <p class="text-xs text-gray-500"><span class="font-bold text-emas-700">{{ $item->kategori_label }}</span> · <time datetime="{{ $item->created_at->toDateString() }}">{{ $item->created_at->translatedFormat('d F Y') }}</time></p>
                                            <h3 class="mt-1 text-[15px] font-semibold leading-snug text-navy-950 group-hover:text-navy-700 line-clamp-3">{{ $item->judul }}</h3>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="py-8 text-center text-sm text-gray-500">Belum ada berita lainnya.</p>
                    @endif
                </div>
            </div>
        @else
            <div class="rounded-2xl border border-dashed border-gray-300 bg-white p-12 text-center">
                <x-ikon nama="dokumen" class="w-10 h-10 mx-auto text-navy-300" />
                <h3 class="mt-4 text-base font-bold text-navy-950">Belum ada berita diterbitkan</h3>
                <p class="mt-1 text-sm text-gray-600">Berita dan pengumuman resmi Rutan Pandeglang akan tampil di sini.</p>
            </div>
        @endif
    </section>

    <!-- SAMBUTAN KEPALA RUTAN (diatur admin: menu Sambutan Pimpinan) -->
    @if($sambutan['tampil'] && $sambutan['isi'])
        <section id="sambutan" aria-labelledby="judul-sambutan" class="bg-white border-y border-gray-200 scroll-mt-28">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center">
                <!-- Foto -->
                <div class="lg:col-span-4">
                    <div class="relative mx-auto max-w-xs lg:max-w-none">
                        <div class="absolute -bottom-3 -right-3 h-full w-full rounded-2xl border-2 border-emas-400" aria-hidden="true"></div>
                        <div class="relative aspect-[4/5] overflow-hidden rounded-2xl bg-navy-950 shadow-xl">
                            @if($sambutan['foto'])
                                <img src="{{ asset('storage/' . $sambutan['foto']) }}" alt="Foto {{ $sambutan['nama'] }}" class="h-full w-full object-cover" loading="lazy">
                            @else
                                <div class="absolute inset-0 bg-gradient-to-br from-navy-800 to-navy-950" aria-hidden="true"></div>
                                <div class="absolute inset-0 flex flex-col items-center justify-center gap-4 text-navy-300">
                                    <x-ikon nama="pengguna" class="w-20 h-20" />
                                    <x-logo class="w-12 h-12 opacity-80" />
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Teks -->
                <div class="lg:col-span-8">
                    <p class="{{ $kelasEyebrow }} text-emas-700">
                        Sambutan Kepala Rutan
                    </p>
                    <h2 id="judul-sambutan" class="mt-3 text-2xl sm:text-3xl font-extrabold leading-tight tracking-tight text-navy-950">
                        &ldquo;{{ $sambutan['judul'] }}&rdquo;
                    </h2>
                    <div class="mt-6 space-y-4 text-[15px] leading-relaxed text-gray-700">
                        @foreach (preg_split('/\R\s*\R/', trim($sambutan['isi'])) as $paragraf)
                            <p>{{ $paragraf }}</p>
                        @endforeach
                    </div>
                    <div class="mt-8 flex items-center gap-4 border-t border-gray-200 pt-6">
                        <span class="h-10 w-1 rounded-full bg-emas-500" aria-hidden="true"></span>
                        <div>
                            <p class="text-base font-bold text-navy-950">{{ $sambutan['nama'] }}</p>
                            <p class="text-sm text-gray-600">{{ $sambutan['jabatan'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- HIGHLIGHT INFORMASI PUBLIK (dipilih admin, maks. 4) -->
    @if($informasiHighlight->isNotEmpty())
        <section id="informasi-publik" aria-labelledby="judul-informasi" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 scroll-mt-28">
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mb-6">
                <div>
                    <p class="{{ $kelasEyebrow }} text-emas-700">
                        Transparansi
                    </p>
                    <h2 id="judul-informasi" class="mt-2 text-2xl sm:text-3xl font-extrabold tracking-tight text-navy-950">Informasi publik</h2>
                    <p class="mt-1 text-sm text-gray-600">Dokumen perencanaan, kinerja, dan anggaran Rutan Kelas IIB Pandeglang.</p>
                </div>
                <a href="{{ route('informasi-publik') }}" class="inline-flex items-center gap-1 text-sm font-semibold text-navy-800 hover:text-navy-950 hover:underline underline-offset-4 focus:outline-none focus-visible:underline">
                    Semua dokumen <span aria-hidden="true"><x-panah /></span>
                </a>
            </div>
            <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-8 border-t border-gray-200">
                @foreach ($informasiHighlight as $info)
                    <li class="border-b border-gray-200">
                        <a href="{{ $info->url }}" class="group flex gap-3 py-5 focus:outline-none focus-visible:bg-navy-50">
                            <span class="flex w-10 h-10 shrink-0 items-center justify-center rounded-lg bg-emas-50 text-emas-700 group-hover:bg-emas-100 transition">
                                <x-ikon :nama="$info->ikon" class="w-5 h-5" />
                            </span>
                            <span class="min-w-0">
                                <span class="block text-[15px] font-bold text-navy-950 group-hover:text-navy-700">{{ $info->judul }}</span>
                                @if($info->ringkasan)
                                    <span class="mt-1 block text-sm leading-relaxed text-gray-600 line-clamp-2">{{ $info->ringkasan }}</span>
                                @endif
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>
    @endif

    <!-- MAKLUMAT PELAYANAN & SALURAN PENGADUAN -->
    <section id="maklumat" aria-labelledby="judul-maklumat" class="bg-white border-t border-gray-200 scroll-mt-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">

            <!-- Maklumat -->
            <figure class="lg:col-span-7">
                <h2 id="judul-maklumat" class="{{ $kelasEyebrow }} text-emas-700">
                    Maklumat Pelayanan
                </h2>
                <blockquote class="mt-6 border-l-4 border-emas-500 pl-6">
                    <p class="text-xl sm:text-2xl font-semibold leading-snug tracking-tight text-navy-950">
                        &ldquo;{{ $maklumat['isi'] }}&rdquo;
                    </p>
                </blockquote>
                <figcaption class="mt-6 flex items-center gap-3 pl-7">
                    <x-logo class="w-10 h-10" />
                    <span class="text-sm font-semibold text-gray-700">{{ $maklumat['penanda_tangan'] }}</span>
                </figcaption>
                <ul class="mt-8 flex flex-wrap gap-2 pl-7">
                    @foreach ($maklumat['komitmen'] as $komitmen)
                        <li class="inline-flex items-center gap-1.5 rounded-full bg-navy-950 px-3.5 py-1.5 text-xs font-bold text-white">
                            <svg class="w-3.5 h-3.5 text-emas-400" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            {{ $komitmen }}
                        </li>
                    @endforeach
                </ul>
            </figure>

            <!-- Saluran pengaduan -->
            <div class="lg:col-span-5">
                <p class="{{ $kelasEyebrow }} text-red-700">
                    Saluran Pengaduan
                </p>
                <h3 class="mt-2 text-2xl font-extrabold tracking-tight text-navy-950">Temukan pelanggaran? Laporkan.</h3>
                <p class="mt-1 text-sm text-gray-600">Pungutan liar, gratifikasi, atau pelayanan yang tidak sesuai standar.</p>

                <ul class="mt-6 divide-y divide-gray-200 border-y border-gray-200">
                    @foreach ($saluranPengaduan as $kanal)
                        <li>
                            @if($kanal['url'])
                                <a href="{{ $kanal['url'] }}" @if($kanal['luar']) target="_blank" rel="noopener" @endif
                                   class="group flex items-center gap-4 py-4 focus:outline-none focus-visible:bg-navy-50">
                                    <span class="flex w-10 h-10 shrink-0 items-center justify-center rounded-lg bg-navy-950 text-emas-400">
                                        <x-ikon :nama="$kanal['ikon']" class="w-5 h-5" />
                                    </span>
                                    <span class="min-w-0 flex-1">
                                        <span class="block text-[15px] font-bold text-navy-950 group-hover:text-navy-700">{{ $kanal['judul'] }}</span>
                                        <span class="block text-sm text-gray-600">{{ $kanal['ket'] }}</span>
                                    </span>
                                    <x-panah :arah="$kanal['luar'] ? 'serong' : 'kanan'" class="h-4 w-4 text-gray-300 group-hover:text-navy-900 transition" />
                                </a>
                            @else
                                <div class="flex items-center gap-4 py-4">
                                    <span class="flex w-10 h-10 shrink-0 items-center justify-center rounded-lg bg-navy-950 text-emas-400">
                                        <x-ikon :nama="$kanal['ikon']" class="w-5 h-5" />
                                    </span>
                                    <span class="min-w-0 flex-1">
                                        <span class="block text-[15px] font-bold text-navy-950">{{ $kanal['judul'] }}</span>
                                        <span class="block text-sm text-gray-600">{{ $kanal['ket'] }}</span>
                                    </span>
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
                <p class="mt-4 flex items-center gap-2 text-xs text-gray-500">
                    <x-ikon nama="perisai" class="w-4 h-4 text-emas-600" />
                    Identitas pelapor dijamin kerahasiaannya.
                </p>
            </div>
        </div>
    </section>
@endsection
