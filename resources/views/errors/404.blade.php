@extends('errors.layout')

@section('kode', '404')
@section('judul', 'Halaman tidak ditemukan')
@section('pesan', 'Halaman yang Anda cari mungkin telah dipindahkan, dihapus, atau alamatnya keliru. Silakan kembali ke beranda atau cari informasi yang Anda butuhkan.')

@section('aksi')
    <a href="{{ route('layanan') }}" class="inline-flex items-center gap-2 rounded-lg border border-white/25 px-6 py-3 text-sm font-bold text-white hover:bg-white/10 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-300">
        Layanan publik
    </a>
    <a href="{{ route('berita.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-white/25 px-6 py-3 text-sm font-bold text-white hover:bg-white/10 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-300">
        Berita terbaru
    </a>
@endsection

@section('tambahan')
    <form action="{{ route('berita.index') }}" method="GET" role="search" class="mt-10 max-w-md">
        <label for="cari-404" class="block text-sm text-navy-300">Atau cari berita dan pengumuman:</label>
        <div class="mt-2 flex rounded-xl bg-white/10 ring-1 ring-white/15 focus-within:ring-2 focus-within:ring-emas-400">
            <input id="cari-404" type="search" name="q" placeholder="Contoh: jadwal kunjungan"
                   class="min-w-0 flex-1 bg-transparent px-4 py-3 text-sm text-white placeholder-navy-300 focus:outline-none">
            <button type="submit" class="m-1 rounded-lg bg-white/10 px-4 text-sm font-bold text-white hover:bg-white/20 transition">Cari</button>
        </div>
    </form>
@endsection
