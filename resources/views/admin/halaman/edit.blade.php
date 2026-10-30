@extends('layouts.admin')

@section('title', 'Ubah Halaman: ' . $halaman->judul)

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <!-- Header Navigation -->
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        <div>
            <a href="{{ route('admin.halaman.index', ['kategori' => $halaman->kategori]) }}" class="inline-flex items-center gap-1.5 text-xs text-gray-400 hover:text-amber-400 mb-2 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Daftar Halaman
            </a>
            <h1 class="text-2xl font-bold text-white tracking-tight">Perbarui Halaman</h1>
            <p class="text-sm text-gray-400 mt-1">{{ $halaman->kategori_label }} &rsaquo; {{ $halaman->judul }}</p>
        </div>
        @if($halaman->status === 'publikasi')
            <a href="{{ $halaman->url }}" target="_blank"
               class="inline-flex items-center gap-1.5 self-start sm:self-auto px-3 py-2 text-xs font-medium text-gray-300 hover:text-white bg-gray-800/80 hover:bg-gray-700 border border-gray-700/80 rounded-lg transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                Lihat Halaman Publik
            </a>
        @endif
    </div>

    <!-- Edit Form Card -->
    <div class="bg-gray-900/80 border border-gray-800 rounded-2xl p-4 sm:p-8 shadow-xl">
        <form action="{{ route('admin.halaman.update', $halaman) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            @include('admin.halaman._form')

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-800">
                <a href="{{ route('admin.halaman.index', ['kategori' => $halaman->kategori]) }}"
                   class="px-4 py-2.5 text-sm font-medium text-gray-300 hover:text-white bg-gray-800 hover:bg-gray-700 rounded-xl transition">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-2.5 bg-amber-500 hover:bg-amber-400 text-gray-950 font-semibold text-sm rounded-xl shadow-lg shadow-amber-500/20 transition duration-150 active:scale-95">
                    Perbarui Halaman
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
