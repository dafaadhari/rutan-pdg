@extends('layouts.page')

@section('page_content')
<div class="space-y-6 text-gray-700 leading-relaxed text-sm">
    <div class="border-b border-gray-150 pb-4">
        <h2 class="text-xl font-bold text-gray-900 leading-tight">SIMONEV Bahan Makanan (Bama) Kemenimipas</h2>
        <p class="text-xs text-gray-500 mt-1">Sistem Informasi Monitoring dan Evaluasi Penyelenggaraan Makanan bagi Warga Binaan.</p>
    </div>

    <div class="space-y-4 text-xs">
        <p class="text-sm leading-relaxed">
            Rutan Kelas IIB Pandeglang mengimplementasikan pengawasan ketat terhadap penyelenggaraan makanan bagi tahanan dan warga binaan melalui integrasi pelaporan <strong>SIMONEV Bama</strong> dari Direktorat Jenderal Pemasyarakatan.
        </p>

        <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 space-y-3">
            <h3 class="font-bold text-gray-900 text-sm">Standar Penyelenggaraan Makanan di Rutan Pandeglang:</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                <div class="p-3 bg-white border border-gray-200 rounded-lg">
                    <span class="font-bold text-gray-900 block mb-1">Kecukupan Angka Gizi & Kalori</span>
                    <p class="text-gray-600">Pemberian menu harian yang seimbang dan bervariasi sesuai standar Permenkumham/Kemenimipas.</p>
                </div>
                <div class="p-3 bg-white border border-gray-200 rounded-lg">
                    <span class="font-bold text-gray-900 block mb-1">Sertifikat Laik Higiene Sanitasi</span>
                    <p class="text-gray-600">Dapur rutan telah melalui uji laboratorium kesehatan berkala dari Dinas Kesehatan setempat.</p>
                </div>
                <div class="p-3 bg-white border border-gray-200 rounded-lg">
                    <span class="font-bold text-gray-900 block mb-1">Distribusi Makanan Tepat Waktu</span>
                    <p class="text-gray-600">Jadwal pembagian makan 3 kali sehari (Pagi, Siang, dan Sore) secara tertib dan terjaga suhunya.</p>
                </div>
                <div class="p-3 bg-white border border-gray-200 rounded-lg">
                    <span class="font-bold text-gray-900 block mb-1">Peralatan Dapur Higienis</span>
                    <p class="text-gray-600">Seluruh perkakas masak, tempat makan ompreng, dan air minum diproses melalui sterilisasi bersih.</p>
                </div>
            </div>
        </div>

        <p class="text-gray-600 leading-relaxed">
            Data pemenuhan bahan makanan diinput secara berkala ke aplikasi pusat sebagai bentuk akuntabilitas pertanggungjawaban anggaran negara dan pemenuhan hak asasi dasar warga binaan.
        </p>
    </div>
</div>
@endsection
