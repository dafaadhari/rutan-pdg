@extends('layouts.admin')

@section('title', 'Tambah Halaman Baru')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <!-- Header Navigation -->
    <div>
        <a href="{{ route('admin.halaman.index') }}" class="inline-flex items-center gap-1.5 text-xs text-gray-400 hover:text-amber-400 mb-2 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar Halaman
        </a>
        <h1 class="text-2xl font-bold text-white tracking-tight">Tambah Halaman Baru</h1>
        <p class="text-sm text-gray-400 mt-1">Halaman berstatus publikasi otomatis muncul di menu navbar dan sidebar kategorinya.</p>
    </div>

    <!-- Create Form Card -->
    <div class="bg-gray-900/80 border border-gray-800 rounded-2xl p-4 sm:p-8 shadow-xl">
        <form action="{{ route('admin.halaman.store') }}" method="POST" class="space-y-6">
            @csrf

            @include('admin.halaman._form')

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-800">
                <a href="{{ route('admin.halaman.index') }}"
                   class="px-4 py-2.5 text-sm font-medium text-gray-300 hover:text-white bg-gray-800 hover:bg-gray-700 rounded-xl transition">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-2.5 bg-amber-500 hover:bg-amber-400 text-gray-950 font-semibold text-sm rounded-xl shadow-lg shadow-amber-500/20 transition duration-150 active:scale-95">
                    Simpan Halaman
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
