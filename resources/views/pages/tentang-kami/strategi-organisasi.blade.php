@extends('layouts.page')

@section('page_content')
<div class="space-y-6 text-gray-700 leading-relaxed text-sm">
    <div class="border-b border-gray-150 pb-4">
        <h2 class="text-xl font-bold text-gray-900">Strategi Organisasi</h2>
        <p class="text-xs text-gray-500 mt-1">Arah kebijakan, strategi pemasyarakatan, dan pembangunan Zona Integritas.</p>
    </div>

    <!-- 3 Kunci Pemasyarakatan Maju + Back to Basics -->
    <div class="space-y-4">
        <h3 class="text-base font-bold text-gray-900">3 Kunci Pemasyarakatan Maju + Back to Basics</h3>
        <p class="text-xs text-gray-600">
            Rutan Kelas IIB Pandeglang mengimplementasikan strategi instruksi Direktur Jenderal Pemasyarakatan:
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
            <div class="p-4 bg-red-50/50 border border-red-200 rounded-xl">
                <span class="font-bold text-red-700 block mb-1">1. Deteksi Dini</span>
                <p class="text-gray-600">Mencegah potensi gangguan keamanan melalui inspeksi mendadak, pemeliharaan gembok teralis, dan penggeledahan berkala.</p>
            </div>
            <div class="p-4 bg-red-50/50 border border-red-200 rounded-xl">
                <span class="font-bold text-red-700 block mb-1">2. Berantas Narkoba</span>
                <p class="text-gray-600">Komitmen Zero Narkoba dan Zero Handphone di dalam blok hunian dengan tes urine rutin pegawai dan warga binaan.</p>
            </div>
            <div class="p-4 bg-red-50/50 border border-red-200 rounded-xl">
                <span class="font-bold text-red-700 block mb-1">3. Sinergitas APH</span>
                <p class="text-gray-600">Memperkuat kerja sama operasional dengan TNI, Kepolisian, Pengadilan, dan Kejaksaan dalam proses penegakan hukum.</p>
            </div>
        </div>

        <div class="p-4 bg-gray-50 border border-gray-200 rounded-xl text-xs">
            <span class="font-bold text-gray-900 block mb-1">Prinsip Back to Basics</span>
            <p class="text-gray-600">
                Mengembalikan seluruh prosedur pelayanan, pembinaan, dan pengamanan pemasyarakatan sesuai Standar Operasional Prosedur (SOP) dan undang-undang yang berlaku.
            </p>
        </div>
    </div>

    <!-- Pembangunan Zona Integritas (WBK/WBBM) -->
    <div class="pt-2 border-t border-gray-150 space-y-2">
        <h3 class="text-base font-bold text-gray-900">Pembangunan Zona Integritas (ZI)</h3>
        <p class="text-xs text-gray-600">
            Fokus reformasi birokrasi pada 6 area perubahan: Manajemen Perubahan, Penataan Tatalaksana, Penataan Sistem Manajemen SDM, Penguatan Akuntabilitas Kinerja, Penguatan Pengawasan, dan Peningkatan Kualitas Pelayanan Publik menuju predikat <strong>Wilayah Bebas dari Korupsi (WBK)</strong>.
        </p>
    </div>
</div>
@endsection
