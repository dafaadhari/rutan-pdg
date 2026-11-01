@extends('layouts.admin')

@section('title', 'Ubah Berita')

@section('content')
<form action="{{ route('admin.berita.update', $berita) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        <div class="min-w-0">
            <a href="{{ route('admin.berita.index') }}" class="text-sm font-semibold text-gray-500 hover:text-navy-950"><x-panah arah="kiri" /> Daftar berita</a>
            <h1 class="mt-1 text-2xl font-extrabold tracking-tight text-navy-950">Perbarui berita</h1>
            <p class="mt-1 truncate text-sm text-gray-600">{{ $berita->judul }}</p>
        </div>
        <div class="flex flex-wrap gap-2">
            @if($berita->status === 'publikasi')
                <a href="{{ route('berita.show', $berita->slug) }}" target="_blank" rel="noopener" class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">Lihat <x-panah arah="serong" /></a>
            @endif
            <a href="{{ route('admin.berita.index') }}" class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">Batal</a>
            <button type="submit" class="rounded-lg bg-emas-500 px-5 py-2.5 text-sm font-bold text-navy-950 shadow-sm hover:bg-emas-400 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-500 focus-visible:ring-offset-2">Simpan perubahan</button>
        </div>
    </div>

    @include('admin.berita._form', ['berita' => $berita])
</form>
@endsection
