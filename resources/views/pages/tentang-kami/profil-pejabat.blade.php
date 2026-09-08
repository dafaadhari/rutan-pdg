@extends('layouts.page')

@section('page_content')
<div class="space-y-6 text-gray-700 leading-relaxed text-sm">
    <div class="border-b border-gray-150 pb-4">
        <h2 class="text-xl font-bold text-gray-900">Profil Pejabat Struktural</h2>
        <p class="text-xs text-gray-500 mt-1">Pimpinan dan jajaran pejabat struktural Rumah Tahanan Negara Kelas IIB Pandeglang.</p>
    </div>

    <!-- Pimpinan Tertinggi / Karutan -->
    <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6 flex flex-col sm:flex-row items-center gap-6">
        <div class="w-24 h-24 rounded-2xl bg-gray-900 border-2 border-red-600 flex items-center justify-center text-white shrink-0 shadow-lg">
            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
        </div>
        <div class="text-center sm:text-left space-y-1">
            <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-red-100 text-red-700 mb-1">
                Pimpinan Satuan Kerja
            </span>
            <h3 class="text-lg font-bold text-gray-900">Kepala Rumah Tahanan Negara (Karutan)</h3>
            <p class="text-xs text-gray-600">Rumah Tahanan Negara Kelas IIB Pandeglang</p>
            <p class="text-xs text-gray-500 pt-1 leading-relaxed">
                Bertanggung jawab memimpin, mengoordinasikan, dan mengawasi seluruh pelaksanaan tugas perawatan tahanan, pemeliharaan keamanan ketertiban, serta pengelolaan tata usaha rutan.
            </p>
        </div>
    </div>

    <!-- Pejabat Struktural Eselon V -->
    <div class="space-y-3 pt-2">
        <h3 class="text-sm font-bold uppercase tracking-wider text-gray-900">Pejabat Struktural Terkait</h3>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <!-- Ka KPR -->
            <div class="bg-white border border-gray-200 rounded-xl p-4 text-center space-y-2 hover:shadow-md transition">
                <div class="w-14 h-14 mx-auto rounded-full bg-gray-100 border border-gray-200 flex items-center justify-center text-gray-500">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h4 class="font-bold text-gray-900 text-xs">Kepala Kesatuan Pengamanan Rutan (Ka KPR)</h4>
                <p class="text-[11px] text-gray-500 leading-snug">Menjaga stabilitas ketertiban, penjagaan blok, dan pencegahan gangguan kamtib.</p>
            </div>

            <!-- Kasubsie Pelayanan Tahanan -->
            <div class="bg-white border border-gray-200 rounded-xl p-4 text-center space-y-2 hover:shadow-md transition">
                <div class="w-14 h-14 mx-auto rounded-full bg-gray-100 border border-gray-200 flex items-center justify-center text-gray-500">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h4 class="font-bold text-gray-900 text-xs">Kasubsie Pelayanan Tahanan</h4>
                <p class="text-[11px] text-gray-500 leading-snug">Mengelola registrasi tahanan, perawatan kesehatan, dan integrasi (PB, CB, CMB).</p>
            </div>

            <!-- Kasubsie Pengelolaan -->
            <div class="bg-white border border-gray-200 rounded-xl p-4 text-center space-y-2 hover:shadow-md transition">
                <div class="w-14 h-14 mx-auto rounded-full bg-gray-100 border border-gray-200 flex items-center justify-center text-gray-500">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h4 class="font-bold text-gray-900 text-xs">Kasubsie Pengelolaan</h4>
                <p class="text-[11px] text-gray-500 leading-snug">Mengelola tata usaha kepegawaian, keuangan, perlengkapan, dan logistik bahan makanan.</p>
            </div>
        </div>
    </div>
</div>
@endsection
