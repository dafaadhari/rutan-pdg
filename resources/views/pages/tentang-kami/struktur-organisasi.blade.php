@extends('layouts.page')

@section('page_content')
<div class="space-y-6 text-gray-700 leading-relaxed text-sm">
    <div class="border-b border-gray-150 pb-4">
        <h2 class="text-xl font-bold text-gray-900">Struktur Organisasi</h2>
        <p class="text-xs text-gray-500 mt-1">Bagan susunan hirarki organisasi Rumah Tahanan Negara Kelas IIB Pandeglang.</p>
    </div>

    <!-- Bagan Visual Struktur -->
    <div class="p-6 bg-gray-50 border border-gray-200 rounded-2xl">
        <div class="flex flex-col items-center space-y-6">
            
            <!-- Pucuk Pimpinan -->
            <div class="bg-gray-900 text-white px-6 py-3 rounded-xl shadow-lg border-2 border-red-600 text-center w-64">
                <span class="text-[10px] font-bold text-red-400 uppercase tracking-widest block">Kepala Rutan</span>
                <span class="text-xs font-bold block mt-0.5">Rutan Kelas IIB Pandeglang</span>
            </div>

            <!-- Garis Penghubung Vertikal -->
            <div class="w-0.5 h-6 bg-gray-300"></div>

            <!-- Cabang Struktural (3 Seksi/Sub) -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 w-full">
                <!-- Sub 1 -->
                <div class="bg-white border border-gray-200 rounded-xl p-4 text-center shadow-xs">
                    <span class="text-[10px] font-bold text-gray-500 uppercase tracking-wider block">Kesatuan Keamanan</span>
                    <h4 class="text-xs font-bold text-gray-900 mt-1">Kesatuan Pengamanan Rutan (KPR)</h4>
                    <p class="text-[11px] text-gray-500 mt-1">Regu Pengamanan & Staf KPR</p>
                </div>

                <!-- Sub 2 -->
                <div class="bg-white border border-gray-200 rounded-xl p-4 text-center shadow-xs">
                    <span class="text-[10px] font-bold text-gray-500 uppercase tracking-wider block">Sub Seksi 1</span>
                    <h4 class="text-xs font-bold text-gray-900 mt-1">Subseksi Pelayanan Tahanan</h4>
                    <p class="text-[11px] text-gray-500 mt-1">Registrasi, Integrasi, Perawatan & Medis</p>
                </div>

                <!-- Sub 3 -->
                <div class="bg-white border border-gray-200 rounded-xl p-4 text-center shadow-xs">
                    <span class="text-[10px] font-bold text-gray-500 uppercase tracking-wider block">Sub Seksi 2</span>
                    <h4 class="text-xs font-bold text-gray-900 mt-1">Subseksi Pengelolaan</h4>
                    <p class="text-[11px] text-gray-500 mt-1">Kepegawaian, Keuangan, Rumah Tangga</p>
                </div>
            </div>

        </div>
    </div>

    <div class="text-xs text-gray-500 leading-relaxed pt-2">
        <p>
            * Bagan organisasi Rutan Kelas IIB Pandeglang disusun berdasarkan Peraturan Menteri yang membidangi Pemasyarakatan dan tata naskah dinas resmi instansi.
        </p>
    </div>
</div>
@endsection
