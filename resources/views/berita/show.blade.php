@extends('layouts.publik')

@php
    $ringkasan = Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags($berita->konten))), 160);
    $urlBerita = route('berita.show', $berita->slug);
    $teksBagikan = rawurlencode($berita->judul . ' - ' . $urlBerita);
    $hariKunjungan = collect(config('rutan.jadwal_kunjungan'))->keys()
        ->map(fn ($hari) => config('rutan.nama_hari')[$hari])
        ->join(', ', ', dan ');
@endphp

@section('judul', $berita->judul)
@section('deskripsi', $ringkasan)
@section('og_type', 'article')
@if($berita->gambar_sampul)
    @section('og_image', asset('storage/' . $berita->gambar_sampul))
@endif

@section('konten')
    <!-- HEADER BERITA -->
    <section class="relative overflow-hidden bg-navy-950 text-white">
        <div class="absolute -right-24 -bottom-24 w-96 h-96 rounded-full bg-emas-500/10 blur-3xl" aria-hidden="true"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12">
            <nav aria-label="Breadcrumb">
                <ol class="flex flex-wrap items-center gap-x-2 text-sm text-navy-300">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                    <li aria-hidden="true">/</li>
                    <li><a href="{{ route('berita.index') }}" class="hover:text-white transition">Berita</a></li>
                    <li aria-hidden="true">/</li>
                    <li aria-current="page" class="text-navy-100 truncate max-w-[16rem] sm:max-w-md">{{ $berita->judul }}</li>
                </ol>
            </nav>

            <p class="mt-6 inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-emas-300">
                <a href="{{ route('berita.index', ['kategori' => $berita->kategori]) }}" class="hover:text-emas-200">{{ $berita->kategori_label }}</a>
            </p>
            <h1 class="mt-2 max-w-4xl text-3xl sm:text-4xl font-extrabold leading-tight tracking-tight">{{ $berita->judul }}</h1>
            <div class="mt-5 flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-navy-200">
                <span class="inline-flex items-center gap-2">
                    <x-logo class="w-7 h-7 rounded-lg" />
                    Tim Humas Rutan Pandeglang
                </span>
                <span aria-hidden="true" class="text-navy-500">•</span>
                <time datetime="{{ $berita->created_at->toIso8601String() }}">
                    {{ $berita->created_at->translatedFormat('l, d F Y') }} · {{ $berita->created_at->format('H.i') }} WIB
                </time>
            </div>
        </div>
    </section>

    <!-- ISI & SIDEBAR -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            <article class="lg:col-span-8">
                @if($berita->gambar_sampul)
                    <figure class="mb-8 overflow-hidden rounded-2xl border border-gray-200 bg-navy-950 shadow-sm">
                        <img src="{{ asset('storage/' . $berita->gambar_sampul) }}" alt="{{ $berita->judul }}" class="w-full max-h-[520px] object-cover">
                    </figure>
                @endif

                <div class="konten-halaman text-[17px] max-w-[70ch]">
                    {!! $berita->konten !!}
                </div>

                <!-- Bagikan -->
                <div class="mt-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-y border-gray-200 py-5">
                    <p class="text-sm font-semibold text-navy-950">Bagikan berita ini</p>
                    <div class="flex flex-wrap gap-2">
                        <a href="https://wa.me/?text={{ $teksBagikan }}" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-semibold text-gray-700 hover:border-emerald-400 hover:text-emerald-700 transition">
                            WhatsApp
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ rawurlencode($urlBerita) }}" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-semibold text-gray-700 hover:border-blue-400 hover:text-blue-700 transition">
                            Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ rawurlencode($urlBerita) }}&text={{ rawurlencode($berita->judul) }}" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-semibold text-gray-700 hover:border-gray-400 hover:text-gray-950 transition">
                            X
                        </a>
                        <button type="button" data-salin-tautan="{{ $urlBerita }}"
                                class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-semibold text-gray-700 hover:border-emas-500 hover:text-navy-950 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-500">
                            <span data-label>Salin tautan</span>
                        </button>
                    </div>
                </div>

                <a href="{{ route('berita.index') }}" class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-navy-800 hover:text-navy-950 hover:underline underline-offset-4">
                    <span aria-hidden="true"><x-panah arah="kiri" /></span> Kembali ke daftar berita
                </a>
            </article>

            <aside class="lg:col-span-4 space-y-6">
                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm lg:sticky lg:top-24">
                    <h2 class="pb-3 text-xs font-bold uppercase tracking-wider text-emas-700 border-b border-gray-100">Berita lainnya</h2>

                    @if($beritaTerbaru->isNotEmpty())
                        <ul class="divide-y divide-gray-100">
                            @foreach ($beritaTerbaru as $terbaru)
                                <li>
                                    <a href="{{ route('berita.show', $terbaru->slug) }}" class="group flex gap-3 py-4 focus:outline-none focus-visible:bg-navy-50">
                                        <x-sampul-berita :berita="$terbaru" ukuran="kecil" class="w-20 h-16 shrink-0 rounded-lg" />
                                        <div class="min-w-0">
                                            <p class="text-xs text-gray-500"><span class="font-semibold text-emas-700">{{ $terbaru->kategori_label }}</span> · <time datetime="{{ $terbaru->created_at->toDateString() }}">{{ $terbaru->created_at->translatedFormat('d F Y') }}</time></p>
                                            <h3 class="mt-0.5 text-sm font-semibold leading-snug text-navy-950 group-hover:text-navy-700 line-clamp-3">{{ $terbaru->judul }}</h3>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="py-6 text-center text-sm text-gray-500">Belum ada berita lainnya.</p>
                    @endif

                    <div class="mt-4 rounded-xl bg-navy-950 p-5 text-white">
                        <p class="flex items-center gap-2 text-sm font-bold text-emas-300">
                            <x-ikon nama="kalender" class="w-4 h-4" />
                            Jadwal Kunjungan
                        </p>
                        <p class="mt-1.5 text-sm leading-relaxed text-navy-200">{{ $hariKunjungan }}. Bawa identitas resmi (KTP/KK). Layanan gratis.</p>
                        <a href="#kontak" class="mt-3 inline-flex items-center gap-1 text-sm font-semibold text-white hover:text-emas-300">
                            Lihat jadwal <span aria-hidden="true"><x-panah /></span>
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Salin tautan berita ke clipboard
        document.querySelectorAll('[data-salin-tautan]').forEach(function (tombol) {
            tombol.addEventListener('click', function () {
                const label = tombol.querySelector('[data-label]');
                navigator.clipboard.writeText(tombol.dataset.salinTautan).then(function () {
                    label.textContent = 'Tautan disalin ✓';
                    setTimeout(function () { label.textContent = 'Salin tautan'; }, 2000);
                });
            });
        });
    </script>
@endpush
