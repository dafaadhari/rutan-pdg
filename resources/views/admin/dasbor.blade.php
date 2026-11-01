@extends('layouts.admin')

@section('title', 'Dasbor')

@section('content')
@php
    $labelStatus = [
        'aktif' => ['Tayang', 'bg-emerald-50 text-emerald-700 ring-emerald-200'],
        'terjadwal' => ['Terjadwal', 'bg-navy-50 text-navy-800 ring-navy-200'],
        'kedaluwarsa' => ['Kedaluwarsa', 'bg-amber-50 text-amber-800 ring-amber-200'],
        'nonaktif' => ['Nonaktif', 'bg-gray-100 text-gray-600 ring-gray-200'],
    ][$statusPengumuman];
    $jam = (int) now()->format('H');
    $salam = $jam < 11 ? 'Selamat pagi' : ($jam < 15 ? 'Selamat siang' : ($jam < 19 ? 'Selamat sore' : 'Selamat malam'));
@endphp
<div class="space-y-8">

    <!-- Sapaan & aksi cepat -->
    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4">
        <div>
            <p class="text-sm font-semibold text-emas-700">{{ now()->translatedFormat('l, d F Y') }}</p>
            <h1 class="mt-1 text-2xl font-extrabold tracking-tight text-navy-950">{{ $salam }}, {{ Auth::user()->name ?? 'Admin' }}</h1>
            <p class="mt-1 text-sm text-gray-600">Ringkasan portal informasi Rutan Kelas IIB Pandeglang.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.berita.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-emas-500 px-4 py-2.5 text-sm font-bold text-navy-950 shadow-sm hover:bg-emas-400 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                Tulis berita
            </a>
            <a href="{{ route('admin.halaman.create') }}" class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">Tambah halaman</a>
            <a href="{{ route('admin.pengumuman.edit') }}" class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">Ubah pengumuman</a>
        </div>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach ([
            ['label' => 'Berita terbit', 'nilai' => $statistik['beritaPublikasi'], 'ket' => $statistik['berita'] . ' total', 'ikon' => 'buku', 'url' => route('admin.berita.index', ['status' => 'publikasi'])],
            ['label' => 'Draft berita', 'nilai' => $statistik['beritaDraft'], 'ket' => 'menunggu terbit', 'ikon' => 'dokumen', 'url' => route('admin.berita.index', ['status' => 'draft'])],
            ['label' => 'Halaman informasi', 'nilai' => $statistik['halaman'], 'ket' => $statistik['halamanDraft'] . ' draft', 'ikon' => 'gedung', 'url' => route('admin.halaman.index')],
            ['label' => 'Banner pengumuman', 'nilai' => $labelStatus[0], 'ket' => $pengumuman['selesai'] ? 's.d. ' . \Illuminate\Support\Carbon::parse($pengumuman['selesai'])->translatedFormat('d M Y') : 'tanpa batas', 'ikon' => 'megafon', 'url' => route('admin.pengumuman.edit')],
        ] as $kartu)
            <a href="{{ $kartu['url'] }}" class="group rounded-xl border border-gray-200 bg-white p-5 shadow-sm hover:border-navy-200 hover:shadow-md transition focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-500">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-500">{{ $kartu['label'] }}</p>
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-navy-900 text-emas-400">
                        <x-ikon :nama="$kartu['ikon']" class="w-5 h-5" />
                    </span>
                </div>
                <p class="mt-2 text-2xl font-extrabold text-navy-950">{{ $kartu['nilai'] }}</p>
                <p class="mt-0.5 text-xs text-gray-500">{{ $kartu['ket'] }}</p>
            </a>
        @endforeach
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <!-- Berita terbaru -->
        <section class="xl:col-span-2 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm" aria-labelledby="judul-berita-terbaru">
            <div class="flex items-center justify-between border-b border-gray-200 px-5 py-4">
                <h2 id="judul-berita-terbaru" class="text-base font-bold text-navy-950">Berita terbaru</h2>
                <a href="{{ route('admin.berita.index') }}" class="text-sm font-semibold text-emas-700 hover:underline">Lihat semua</a>
            </div>
            <ul class="divide-y divide-gray-100">
                @forelse ($beritaTerbaru as $berita)
                    <li>
                        <a href="{{ route('admin.berita.edit', $berita) }}" class="flex items-center gap-4 px-5 py-3.5 hover:bg-gray-50 transition">
                            @if($berita->gambar_sampul)
                                <img src="{{ asset('storage/' . $berita->gambar_sampul) }}" alt="" class="h-11 w-16 shrink-0 rounded-md object-cover ring-1 ring-gray-200">
                            @else
                                <span class="flex h-11 w-16 shrink-0 items-center justify-center rounded-md border border-dashed border-amber-300 bg-amber-50 text-[10px] font-semibold text-amber-700">Tanpa sampul</span>
                            @endif
                            <span class="min-w-0 flex-1">
                                <span class="block truncate text-sm font-semibold text-navy-950">{{ $berita->judul }}</span>
                                <span class="block text-xs text-gray-500">{{ $berita->kategori_label }} · {{ $berita->created_at->translatedFormat('d M Y') }}</span>
                            </span>
                            @if($berita->status === 'publikasi')
                                <span class="shrink-0 rounded-full bg-emerald-50 px-2 py-0.5 text-xs font-semibold text-emerald-700 ring-1 ring-emerald-200">Publikasi</span>
                            @else
                                <span class="shrink-0 rounded-full bg-gray-100 px-2 py-0.5 text-xs font-semibold text-gray-600 ring-1 ring-gray-200">Draft</span>
                            @endif
                        </a>
                    </li>
                @empty
                    <li class="px-5 py-10 text-center text-sm text-gray-500">Belum ada berita.</li>
                @endforelse
            </ul>
        </section>

        <div class="space-y-6">
            <!-- Perlu perhatian -->
            <section class="rounded-xl border border-gray-200 bg-white shadow-sm" aria-labelledby="judul-perhatian">
                <div class="border-b border-gray-200 px-5 py-4">
                    <h2 id="judul-perhatian" class="text-base font-bold text-navy-950">Perlu perhatian</h2>
                </div>
                @if($perhatian)
                    <ul class="divide-y divide-gray-100">
                        @foreach ($perhatian as $item)
                            <li class="flex items-start gap-3 px-5 py-3.5">
                                <span class="mt-1.5 h-2 w-2 shrink-0 rounded-full bg-amber-500" aria-hidden="true"></span>
                                <span class="min-w-0 flex-1">
                                    <span class="block text-sm text-gray-700">{{ $item['teks'] }}</span>
                                    <a href="{{ $item['url'] }}" class="mt-0.5 inline-block text-xs font-semibold text-emas-700 hover:underline">{{ $item['aksi'] }} <x-panah /></a>
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="flex items-center gap-2 px-5 py-6 text-sm text-emerald-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Semua konten utama sudah lengkap.
                    </p>
                @endif
            </section>

            <!-- Banner pengumuman -->
            <section class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm" aria-labelledby="judul-banner">
                <div class="flex items-center justify-between gap-2">
                    <h2 id="judul-banner" class="text-base font-bold text-navy-950">Banner pengumuman</h2>
                    <span class="rounded-full px-2.5 py-0.5 text-xs font-semibold ring-1 {{ $labelStatus[1] }}">{{ $labelStatus[0] }}</span>
                </div>
                <p class="mt-2 text-sm leading-relaxed text-gray-600 line-clamp-3">{{ $pengumuman['teks'] ?: 'Belum ada teks pengumuman.' }}</p>
                <a href="{{ route('admin.pengumuman.edit') }}" class="mt-3 inline-block text-sm font-semibold text-emas-700 hover:underline">Kelola banner <x-panah /></a>
            </section>
        </div>
    </div>
</div>
@endsection
