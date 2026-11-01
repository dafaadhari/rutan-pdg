@extends('layouts.admin')

@section('title', 'Tambah Halaman')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <!-- Header Navigation -->
    <div>
        <a href="{{ route('admin.halaman.index') }}" class="inline-flex items-center gap-1.5 text-xs text-gray-500 hover:text-emas-700 mb-2 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar Halaman
        </a>
        <h1 class="text-2xl font-bold text-navy-950 tracking-tight">Tambah Halaman Baru</h1>
        <p class="text-sm text-gray-500 mt-1">Halaman berstatus publikasi otomatis muncul di menu navbar dan sidebar kategorinya.</p>
    </div>

    <!-- Create Form Card -->
    <div class="bg-white border border-gray-200 rounded-2xl p-4 sm:p-8 shadow-sm">
        <form action="{{ route('admin.halaman.store') }}" method="POST" class="space-y-6">
            @csrf

            @include('admin.halaman._form')

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.halaman.index') }}"
                   class="px-4 py-2.5 text-sm font-medium text-gray-700 hover:text-navy-950 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-2.5 bg-emas-500 hover:bg-emas-400 text-navy-950 font-semibold text-sm rounded-lg shadow-lg shadow-emas-500/20 transition duration-150 active:scale-95">
                    Simpan Halaman
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
