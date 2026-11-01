@extends('layouts.admin')

@section('title', 'Halaman')

@section('content')
<div class="space-y-6">

    <!-- Header & Action -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-navy-950 tracking-tight">Manajemen Halaman</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola isi halaman Tentang Kami, Layanan, dan Informasi Publik beserta urutan menunya.</p>
        </div>
        <div>
            <a href="{{ route('admin.halaman.create', $kategori ? ['kategori' => $kategori] : []) }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-emas-500 hover:bg-emas-400 text-navy-950 font-semibold text-sm rounded-lg shadow-lg shadow-emas-500/20 transition duration-150 active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Halaman Baru
            </a>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white border border-gray-200 rounded-lg p-4 flex items-center gap-4">
            <div class="w-11 h-11 rounded-lg bg-navy-50 border border-navy-200 text-navy-700 flex items-center justify-center shrink-0">
                <x-ikon nama="dokumen" class="w-6 h-6" />
            </div>
            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-gray-500">Total Halaman</p>
                <p class="text-2xl font-bold text-navy-950 mt-0.5">{{ $totalHalaman }}</p>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4 flex items-center gap-4">
            <div class="w-11 h-11 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-700 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-gray-500">Diterbitkan (Publik)</p>
                <p class="text-2xl font-bold text-emerald-700 mt-0.5">{{ $totalPublikasi }}</p>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4 flex items-center gap-4">
            <div class="w-11 h-11 rounded-lg bg-emas-50 border border-emas-200 text-emas-700 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-gray-500">Konsep (Draft)</p>
                <p class="text-2xl font-bold text-emas-700 mt-0.5">{{ $totalDraft }}</p>
            </div>
        </div>
    </div>

    <!-- Filter & Search Bar -->
    <div class="bg-white border border-gray-200 rounded-lg p-4">
        <form action="{{ route('admin.halaman.index') }}" method="GET" class="flex flex-col md:flex-row gap-3">
            <div class="flex-1 relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" name="search" value="{{ $search }}"
                       placeholder="Cari berdasarkan judul halaman..."
                       class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-300 rounded-lg text-sm text-navy-950 placeholder-gray-400 focus:outline-none focus:border-emas-500 focus:ring-2 focus:ring-emas-500/30 transition">
            </div>

            <div class="flex gap-2">
                <select name="kategori"
                        class="flex-1 md:flex-none min-w-0 bg-gray-50 border border-gray-300 rounded-lg px-3.5 py-2 text-sm text-gray-700 focus:outline-none focus:border-emas-500 focus:ring-2 focus:ring-emas-500/30">
                    <option value="">Semua Kategori</option>
                    @foreach (\App\Models\Halaman::KATEGORI as $nilai => $label)
                        <option value="{{ $nilai }}" {{ $kategori === $nilai ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>

                <button type="submit"
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-navy-950 text-sm font-medium rounded-lg border border-gray-300 transition">
                    Filter
                </button>

                @if($search || $kategori)
                    <a href="{{ route('admin.halaman.index') }}"
                       class="px-3 py-2 bg-gray-50 hover:bg-gray-100 text-gray-500 hover:text-navy-950 text-sm font-medium rounded-lg border border-gray-300 transition inline-flex items-center" title="Reset filter">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Daftar Halaman per Kategori -->
    @forelse ($halamanPerKategori as $kodeKategori => $halamans)
        <section class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
            <header class="flex items-center justify-between gap-3 px-4 py-3 bg-gray-50 border-b border-gray-200">
                <h2 class="text-sm font-bold uppercase tracking-wider text-navy-950 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emas-500"></span>
                    {{ \App\Models\Halaman::KATEGORI[$kodeKategori] ?? $kodeKategori }}
                    <span class="text-xs font-medium text-gray-500 normal-case tracking-normal">({{ $halamans->count() }} halaman)</span>
                    @if($kodeKategori !== 'tentang-kami')
                        <span class="text-xs font-medium text-navy-600 normal-case tracking-normal">· {{ $halamans->whereIn('id', $idHighlight)->count() }}/{{ \App\Http\Controllers\HomeController::MAKS_HIGHLIGHT }} highlight beranda</span>
                    @endif
                </h2>
                <a href="{{ route('admin.halaman.create', ['kategori' => $kodeKategori]) }}" class="text-xs font-semibold text-emas-700 hover:text-emas-600 shrink-0">
                    + Tambah
                </a>
            </header>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[720px] text-left text-sm text-gray-700">
                    <thead class="text-xs uppercase tracking-wider text-gray-500 border-b border-gray-200">
                        <tr>
                            <th scope="col" class="py-3 px-4 w-16 text-center">Urut</th>
                            <th scope="col" class="py-3 px-4">Judul & Slug</th>
                            <th scope="col" class="py-3 px-4 w-40">Grup</th>
                            <th scope="col" class="py-3 px-4 w-28 text-center">Beranda</th>
                            <th scope="col" class="py-3 px-4 w-32 text-center">Status</th>
                            <th scope="col" class="py-3 px-4 w-32 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($halamans as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 px-4 text-center text-gray-500 text-xs font-mono">{{ $item->urutan }}</td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 shrink-0 rounded-lg bg-gray-100 border border-gray-300 text-emas-700 flex items-center justify-center">
                                            <x-ikon :nama="$item->ikon" class="w-5 h-5" />
                                        </div>
                                        <div class="min-w-0">
                                            <a href="{{ route('admin.halaman.edit', $item) }}" class="font-semibold text-navy-950 line-clamp-1 hover:text-emas-700 transition">
                                                {{ $item->judul }}
                                            </a>
                                            <div class="text-xs text-gray-500 font-mono mt-0.5 flex items-center gap-1.5">
                                                <span class="truncate">/{{ $item->kategori }}/{{ $item->slug }}</span>
                                                @if($item->status === 'publikasi')
                                                    <a href="{{ $item->url }}" target="_blank" class="text-emas-700 hover:text-emas-600 shrink-0" title="Buka di halaman publik">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                                        </svg>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-xs text-gray-500">{{ $item->grup ?: '—' }}</td>
                                <td class="py-3 px-4 text-center">
                                    @if(in_array($item->id, $idHighlight, true))
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-navy-50 text-navy-800 border border-navy-200">Highlight</span>
                                    @elseif($item->tampil_di_beranda)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-500 border border-gray-300"
                                              title="{{ $item->status === 'draft' ? 'Halaman masih draft' : 'Melebihi batas ' . \App\Http\Controllers\HomeController::MAKS_HIGHLIGHT . ' highlight; naikkan nomor urut atau hapus centang halaman lain' }}">Tidak tampil</span>
                                    @else
                                        <span class="text-xs text-gray-600">—</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-center">
                                    @if($item->status === 'publikasi')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Publikasi
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-500 border border-gray-300">
                                            Draft
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <div class="inline-flex items-center gap-1.5">
                                        <a href="{{ route('admin.halaman.edit', $item) }}"
                                           class="p-1.5 text-gray-700 hover:text-emas-700 hover:bg-gray-100 rounded-lg transition"
                                           title="Ubah Halaman">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>

                                        <form action="{{ route('admin.halaman.destroy', $item) }}" method="POST" class="inline"
                                              onsubmit="return confirm({{ \Illuminate\Support\Js::from('Hapus halaman "' . $item->judul . '" secara permanen? Halaman akan hilang dari menu dan beranda.') }})">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="p-1.5 text-gray-700 hover:text-red-600 hover:bg-gray-100 rounded-lg transition"
                                                    title="Hapus Halaman">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    @empty
        <div class="bg-white border border-gray-200 rounded-lg py-12 text-center text-gray-500">
            <div class="flex flex-col items-center justify-center gap-2">
                <x-ikon nama="dokumen" class="w-10 h-10 text-gray-600" />
                <p class="text-sm font-medium">Belum ada halaman yang sesuai.</p>
                <a href="{{ route('admin.halaman.create') }}" class="text-xs text-emas-700 hover:underline mt-1">
                    + Buat halaman baru sekarang
                </a>
            </div>
        </div>
    @endforelse

</div>
@endsection
