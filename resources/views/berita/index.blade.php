@extends('layouts.publik')

@section('judul', $q !== '' ? "Pencarian \"{$q}\" - Berita" : 'Berita & Kegiatan')
@section('deskripsi', 'Arsip berita, pengumuman, dan kegiatan resmi Rumah Tahanan Negara Kelas IIB Pandeglang.')

@section('konten')
    <!-- HEADER HALAMAN -->
    <section class="relative overflow-hidden bg-navy-950 text-white">
        <div class="absolute -right-24 -bottom-24 w-96 h-96 rounded-full bg-emas-500/10 blur-3xl" aria-hidden="true"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12">
            <nav aria-label="Breadcrumb">
                <ol class="flex flex-wrap items-center gap-x-2 text-sm text-navy-300">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                    <li aria-hidden="true">/</li>
                    <li aria-current="page" class="text-navy-100">Berita</li>
                </ol>
            </nav>

            <div class="mt-6 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
                <div>
                    <p class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-emas-300">
                        <span class="w-6 h-px bg-emas-400"></span>
                        Humas Rutan Pandeglang
                    </p>
                    <h1 class="mt-2 text-3xl sm:text-4xl font-extrabold tracking-tight">Berita &amp; kegiatan</h1>
                    <p class="mt-3 max-w-2xl text-base text-navy-200">Pengumuman, rilis resmi, dan dokumentasi kegiatan pembinaan Warga Binaan.</p>
                </div>

                <form action="{{ route('berita.index') }}" method="GET" role="search" class="w-full lg:w-96">
                    <label for="cari-berita" class="sr-only">Cari berita</label>
                    <div class="flex rounded-xl bg-white/10 ring-1 ring-white/15 focus-within:ring-2 focus-within:ring-emas-400">
                        <input id="cari-berita" type="search" name="q" value="{{ $q }}" placeholder="Cari judul berita…"
                               class="min-w-0 flex-1 bg-transparent px-4 py-3 text-sm text-white placeholder-navy-300 focus:outline-none">
                        <button type="submit" class="m-1 rounded-lg bg-emas-500 px-4 text-sm font-bold text-navy-950 hover:bg-emas-400 transition">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- DAFTAR BERITA -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-12">
        @if($q !== '')
            <p class="mb-6 text-sm text-gray-600">
                {{ $beritas->total() }} hasil untuk <strong class="text-navy-950">"{{ $q }}"</strong> ·
                <a href="{{ route('berita.index') }}" class="font-semibold text-navy-800 underline decoration-emas-500 underline-offset-4">Tampilkan semua</a>
            </p>
        @endif

        @if($beritas->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-10">
                @foreach ($beritas as $berita)
                    <article class="group">
                        <a href="{{ route('berita.show', $berita->slug) }}" class="block focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-500 rounded-2xl">
                            <x-sampul-berita :berita="$berita" class="aspect-[16/10] rounded-2xl shadow-sm" />
                            <p class="mt-4 text-sm font-semibold text-emas-700">
                                <time datetime="{{ $berita->created_at->toDateString() }}">{{ $berita->created_at->translatedFormat('d F Y') }}</time>
                            </p>
                            <h2 class="mt-1.5 text-lg font-bold leading-snug text-navy-950 group-hover:text-navy-700 transition line-clamp-3">{{ $berita->judul }}</h2>
                            <p class="mt-2 text-sm leading-relaxed text-gray-600 line-clamp-3">{{ Str::limit(strip_tags($berita->konten), 180) }}</p>
                        </a>
                    </article>
                @endforeach
            </div>

            @if($beritas->hasPages())
                <div class="mt-12">
                    {{ $beritas->links('pagination.publik') }}
                </div>
            @endif
        @else
            <div class="rounded-2xl border border-dashed border-gray-300 bg-white p-12 text-center">
                <x-ikon nama="dokumen" class="w-10 h-10 mx-auto text-navy-300" />
                <h2 class="mt-4 text-base font-bold text-navy-950">
                    {{ $q !== '' ? 'Tidak ada berita yang cocok' : 'Belum ada berita diterbitkan' }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    {{ $q !== '' ? 'Coba kata kunci lain atau tampilkan semua berita.' : 'Berita dan pengumuman resmi akan tampil di sini.' }}
                </p>
            </div>
        @endif
    </div>
@endsection
