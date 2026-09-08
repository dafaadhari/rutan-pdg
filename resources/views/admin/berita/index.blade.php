@extends('layouts.admin')

@section('title', 'Manajemen Berita')

@section('content')
<div class="space-y-6">

    <!-- Header & Action -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Manajemen Artikel & Berita</h1>
            <p class="text-sm text-gray-400 mt-1">Kelola seluruh publikasi giat dan rilis berita resmi Rutan Pandeglang.</p>
        </div>
        <div>
            <a href="{{ route('admin.berita.create') }}" 
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-amber-500 hover:bg-amber-400 text-gray-950 font-semibold text-sm rounded-xl shadow-lg shadow-amber-500/20 transition duration-150 active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Berita Baru
            </a>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-gray-900/60 border border-gray-800 rounded-xl p-4 flex items-center gap-4">
            <div class="w-11 h-11 rounded-lg bg-blue-500/10 border border-blue-500/30 text-blue-400 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-gray-400">Total Berita</p>
                <p class="text-2xl font-bold text-white mt-0.5">{{ $totalBerita }}</p>
            </div>
        </div>

        <div class="bg-gray-900/60 border border-gray-800 rounded-xl p-4 flex items-center gap-4">
            <div class="w-11 h-11 rounded-lg bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-gray-400">Diterbitkan (Publik)</p>
                <p class="text-2xl font-bold text-emerald-400 mt-0.5">{{ $totalPublikasi }}</p>
            </div>
        </div>

        <div class="bg-gray-900/60 border border-gray-800 rounded-xl p-4 flex items-center gap-4">
            <div class="w-11 h-11 rounded-lg bg-amber-500/10 border border-amber-500/30 text-amber-400 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-gray-400">Konsep (Draft)</p>
                <p class="text-2xl font-bold text-amber-400 mt-0.5">{{ $totalDraft }}</p>
            </div>
        </div>
    </div>

    <!-- Filter & Search Bar -->
    <div class="bg-gray-900/80 border border-gray-800 rounded-xl p-4">
        <form action="{{ route('admin.berita.index') }}" method="GET" class="flex flex-col md:flex-row gap-3">
            <div class="flex-1 relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" name="search" value="{{ $search }}" 
                       placeholder="Cari berdasarkan judul berita..." 
                       class="w-full pl-10 pr-4 py-2 bg-gray-850 border border-gray-700/80 rounded-lg text-sm text-white placeholder-gray-500 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition">
            </div>

            <div class="flex gap-2">
                <select name="status" 
                        class="bg-gray-850 border border-gray-700/80 rounded-lg px-3.5 py-2 text-sm text-gray-200 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500">
                    <option value="">Semua Status</option>
                    <option value="publikasi" {{ $status === 'publikasi' ? 'selected' : '' }}>Publikasi</option>
                    <option value="draft" {{ $status === 'draft' ? 'selected' : '' }}>Draft</option>
                </select>

                <button type="submit" 
                        class="px-4 py-2 bg-gray-800 hover:bg-gray-700 text-white text-sm font-medium rounded-lg border border-gray-700 transition">
                    Filter
                </button>

                @if($search || $status)
                    <a href="{{ route('admin.berita.index') }}" 
                       class="px-3 py-2 bg-gray-850 hover:bg-gray-800 text-gray-400 hover:text-white text-sm font-medium rounded-lg border border-gray-700/60 transition inline-flex items-center" title="Reset filter">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Data Table -->
    <div class="bg-gray-900/80 border border-gray-800 rounded-xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-300">
                <thead class="bg-gray-850 text-xs uppercase tracking-wider text-gray-400 border-b border-gray-800">
                    <tr>
                        <th scope="col" class="py-3.5 px-4 w-16 text-center">No</th>
                        <th scope="col" class="py-3.5 px-4 w-24">Sampul</th>
                        <th scope="col" class="py-3.5 px-4">Judul & Slug</th>
                        <th scope="col" class="py-3.5 px-4 w-32 text-center">Status</th>
                        <th scope="col" class="py-3.5 px-4 w-40">Tanggal Dibuat</th>
                        <th scope="col" class="py-3.5 px-4 w-36 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800/80">
                    @forelse ($beritas as $index => $item)
                        <tr class="hover:bg-gray-850/50 transition">
                            <td class="py-3.5 px-4 text-center text-gray-400 text-xs font-mono">
                                {{ $beritas->firstItem() + $index }}
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="w-16 h-11 rounded-lg bg-gray-800 border border-gray-700/70 overflow-hidden flex items-center justify-center">
                                    @if($item->gambar_sampul)
                                        <img src="{{ asset('storage/' . $item->gambar_sampul) }}" 
                                             alt="{{ $item->judul }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    @endif
                                </div>
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="font-semibold text-white line-clamp-1 hover:text-amber-400 transition">
                                    {{ $item->judul }}
                                </div>
                                <div class="text-xs text-gray-500 font-mono mt-0.5 flex items-center gap-1.5">
                                    <span>/berita/{{ $item->slug }}</span>
                                    @if($item->status === 'publikasi')
                                        <a href="{{ route('berita.show', $item->slug) }}" target="_blank" class="text-amber-400/80 hover:text-amber-300" title="Buka di halaman publik">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                @if($item->status === 'publikasi')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-950/60 text-emerald-400 border border-emerald-800/80">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                        Publikasi
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-800 text-gray-400 border border-gray-700">
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-xs text-gray-400">
                                {{ $item->created_at->format('d M Y, H:i') }} WIB
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <div class="inline-flex items-center gap-1.5">
                                    <a href="{{ route('admin.berita.edit', $item) }}" 
                                       class="p-1.5 text-gray-300 hover:text-amber-400 hover:bg-gray-800 rounded-lg transition" 
                                       title="Ubah Berita">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>

                                    <form action="{{ route('admin.berita.destroy', $item) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini secara permanen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="p-1.5 text-gray-300 hover:text-red-400 hover:bg-gray-800 rounded-lg transition" 
                                                title="Hapus Berita">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                    </svg>
                                    <p class="text-sm font-medium">Belum ada data berita yang sesuai.</p>
                                    <a href="{{ route('admin.berita.create') }}" class="text-xs text-amber-400 hover:underline mt-1">
                                        + Buat berita baru sekarang
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($beritas->hasPages())
            <div class="px-4 py-3 bg-gray-850 border-t border-gray-800">
                {{ $beritas->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
