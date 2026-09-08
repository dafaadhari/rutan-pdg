@extends('layouts.page')

@section('page_content')
<div class="space-y-6 text-gray-700 leading-relaxed text-sm">
    <div class="border-b border-gray-150 pb-4">
        <h2 class="text-xl font-bold text-gray-900">Perizinan Peliputan Jurnalistik</h2>
        <p class="text-xs text-gray-500 mt-1">SOP pengambilan dokumentasi visual, video, dan liputan berita di area rutan.</p>
    </div>

    <div class="space-y-4 text-xs">
        <p class="text-sm leading-relaxed">
            Demi menjaga keamanan, ketertiban, dan hak privasi narapidana/tahanan, peliputan oleh media massa, stasiun televisi, dan jurnalis di dalam area Rumah Tahanan Negara Kelas IIB Pandeglang wajib mematuhi standar operasional prosedur (SOP) yang ketat.
        </p>

        <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 space-y-2">
            <h3 class="font-bold text-gray-900 text-sm mb-2">Prosedur Pengajuan Izin Peliputan:</h3>
            <ol class="list-decimal list-inside text-gray-600 space-y-2 leading-relaxed">
                <li>Mengirimkan surat tugas peliputan dari pimpinan redaksi resmi minimal H-2 sebelum kegiatan.</li>
                <li>Mencantumkan topik liputan, daftar kru, serta jenis peralatan kamera/video yang dibawa.</li>
                <li>Melakukan registrasi dan pemeriksaan identitas pers di pos penjagaan pintu utama (P2U).</li>
                <li>Menandatangani lembar persetujuan tata tertib pengamanan dan etika jurnalistik pemasyarakatan.</li>
            </ol>
        </div>

        <div class="p-4 bg-amber-50 border border-amber-200 rounded-xl space-y-1 text-amber-950">
            <span class="font-bold">Ketentuan Khusus Perlindungan Hak WBP:</span>
            <p class="leading-relaxed">
                Dilarang mengambil foto/video wajah warga binaan secara jelas tanpa izin tertulis (informed consent) dari yang bersangkutan demi menjunjung tinggi asas praduga tak bersalah dan perlindungan masa depan anak/keluarga binaan.
            </p>
        </div>
    </div>
</div>
@endsection
