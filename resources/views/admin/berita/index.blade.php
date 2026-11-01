@extends('layouts.admin')

@section('title', 'Berita')

@section('content')
@php
    $kelasInput = 'rounded-lg border border-gray-300 bg-white px-3.5 py-2 text-sm text-navy-950 placeholder-gray-400 focus:border-emas-500 focus:outline-none focus:ring-2 focus:ring-emas-500/30';
@endphp
<div class="space-y-6">

    <!-- Judul & Aksi -->
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold tracking-tight text-navy-950">Berita & Kegiatan</h1>
            <p class="mt-1 text-sm text-gray-600">Kelola publikasi giat, pengumuman, dan rilis pers resmi Rutan Pandeglang.</p>
        </div>
        <a href="{{ route('admin.berita.create') }}"
           class="inline-flex items-center gap-2 self-start rounded-lg bg-emas-500 px-4 py-2.5 text-sm font-bold text-navy-950 shadow-sm hover:bg-emas-400 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-500 focus-visible:ring-offset-2 sm:self-auto">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            Tulis berita
        </a>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        @foreach ([
            ['label' => 'Total berita', 'nilai' => $totalBerita, 'warna' => 'text-navy-950'],
            ['label' => 'Diterbitkan', 'nilai' => $totalPublikasi, 'warna' => 'text-emerald-700'],
            ['label' => 'Draft', 'nilai' => $totalDraft, 'warna' => 'text-emas-700'],
        ] as $kartu)
            <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
                <p class="text-sm text-gray-500">{{ $kartu['label'] }}</p>
                <p class="mt-1 text-2xl font-extrabold {{ $kartu['warna'] }}">{{ $kartu['nilai'] }}</p>
            </div>
        @endforeach
    </div>

    <!-- Filter -->
    <form action="{{ route('admin.berita.index') }}" method="GET" class="flex flex-col gap-3 rounded-xl border border-gray-200 bg-white p-4 shadow-sm md:flex-row">
        <label for="cari" class="sr-only">Cari judul</label>
        <input id="cari" type="search" name="search" value="{{ $search }}" placeholder="Cari judul berita…" class="{{ $kelasInput }} min-w-0 flex-1">

        <div class="flex flex-wrap gap-2">
            <label for="filter-kategori" class="sr-only">Kategori</label>
            <select id="filter-kategori" name="kategori" class="{{ $kelasInput }}">
                <option value="">Semua kategori</option>
                @foreach (\App\Models\Berita::KATEGORI as $nilai => $label)
                    <option value="{{ $nilai }}" @selected($kategori === $nilai)>{{ $label }}</option>
                @endforeach
            </select>

            <label for="filter-status" class="sr-only">Status</label>
            <select id="filter-status" name="status" class="{{ $kelasInput }}">
                <option value="">Semua status</option>
                <option value="publikasi" @selected($status === 'publikasi')>Publikasi</option>
                <option value="draft" @selected($status === 'draft')>Draft</option>
            </select>

            <button type="submit" class="rounded-lg bg-navy-900 px-4 py-2 text-sm font-semibold text-white hover:bg-navy-800 transition">Terapkan</button>
            @if($search || $status || $kategori)
                <a href="{{ route('admin.berita.index') }}" class="inline-flex items-center rounded-lg border border-gray-300 px-3 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Reset</a>
            @endif
        </div>
    </form>

    <!-- Tabel -->
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[820px] text-left text-sm">
                <thead class="border-b border-gray-200 bg-gray-50 text-xs font-semibold uppercase tracking-wider text-gray-500">
                    <tr>
                        <th scope="col" class="px-4 py-3 w-28">Sampul</th>
                        <th scope="col" class="px-4 py-3">Judul</th>
                        <th scope="col" class="px-4 py-3 w-36">Kategori</th>
                        <th scope="col" class="px-4 py-3 w-32">Status</th>
                        <th scope="col" class="px-4 py-3 w-40">Tanggal</th>
                        <th scope="col" class="px-4 py-3 w-28 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($beritas as $item)
                        <tr class="hover:bg-gray-50/80 transition">
                            <td class="px-4 py-3">
                                @if($item->gambar_sampul)
                                    <img src="{{ asset('storage/' . $item->gambar_sampul) }}" alt="" class="h-12 w-20 rounded-md object-cover ring-1 ring-gray-200">
                                @else
                                    <span class="flex h-12 w-20 items-center justify-center rounded-md border border-dashed border-amber-300 bg-amber-50 text-[10px] font-semibold text-amber-700">Belum ada</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <a href="{{ route('admin.berita.edit', $item) }}" class="font-semibold text-navy-950 hover:text-navy-700 line-clamp-1">{{ $item->judul }}</a>
                                <div class="mt-0.5 flex items-center gap-1.5 text-xs text-gray-500">
                                    <span class="truncate font-mono">/berita/{{ $item->slug }}</span>
                                    @if($item->status === 'publikasi')
                                        <a href="{{ route('berita.show', $item->slug) }}" target="_blank" rel="noopener" class="shrink-0 text-emas-700 hover:text-emas-600" title="Buka di portal"><x-panah arah="serong" /></a>
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="inline-flex rounded-full bg-navy-50 px-2.5 py-1 text-xs font-semibold text-navy-800">{{ $item->kategori_label }}</span>
                            </td>
                            <td class="px-4 py-3">
                                @if($item->status === 'publikasi')
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-emerald-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Publikasi
                                    </span>
                                @else
                                    <span class="inline-flex rounded-full bg-gray-100 px-2.5 py-1 text-xs font-semibold text-gray-600 ring-1 ring-gray-200">Draft</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-xs text-gray-600">{{ $item->created_at->translatedFormat('d M Y, H.i') }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.berita.edit', $item) }}" title="Ubah berita" aria-label="Ubah {{ $item->judul }}"
                                       class="rounded-lg p-2 text-gray-500 hover:bg-navy-50 hover:text-navy-900 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.berita.destroy', $item) }}" method="POST"
                                          onsubmit="return confirm({{ \Illuminate\Support\Js::from('Hapus berita "' . $item->judul . '" secara permanen?') }})">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus berita" aria-label="Hapus {{ $item->judul }}"
                                                class="rounded-lg p-2 text-gray-500 hover:bg-red-50 hover:text-red-600 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-12 text-center">
                                <p class="text-sm font-semibold text-navy-950">Belum ada berita yang sesuai.</p>
                                <a href="{{ route('admin.berita.create') }}" class="mt-1 inline-block text-sm font-semibold text-emas-700 hover:underline">+ Tulis berita baru</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($beritas->hasPages())
            <div class="border-t border-gray-200 bg-gray-50 px-4 py-3">
                {{ $beritas->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
