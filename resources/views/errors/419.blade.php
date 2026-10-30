@extends('errors.layout')

@section('kode', '419')
@section('judul', 'Sesi telah berakhir')
@section('pesan', 'Demi keamanan, sesi formulir ini sudah kedaluwarsa karena terlalu lama tidak digunakan. Muat ulang halaman, lalu kirim kembali formulir Anda.')

@section('aksi')
    <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 rounded-lg border border-white/25 px-6 py-3 text-sm font-bold text-white hover:bg-white/10 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-emas-300">
        Muat ulang halaman
    </a>
@endsection
