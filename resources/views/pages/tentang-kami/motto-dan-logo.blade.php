@extends('layouts.page')

@section('page_content')
<div class="space-y-6 text-gray-700 leading-relaxed text-sm">
    <div class="border-b border-gray-150 pb-4">
        <h2 class="text-xl font-bold text-gray-900">Motto & Logo Pemasyarakatan</h2>
        <p class="text-xs text-gray-500 mt-1">Identitas dan nilai-nilai fundamental Rumah Tahanan Negara Kelas IIB Pandeglang.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 items-center py-4 bg-gray-50 p-6 rounded-2xl border border-gray-150">
        <div class="flex flex-col items-center text-center sm:border-r border-gray-200 pr-0 sm:pr-4">
            <div class="w-20 h-20 bg-gradient-to-br from-gray-900 to-blue-950 rounded-2xl flex items-center justify-center text-amber-400 shadow-md mb-3">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                </svg>
            </div>
            <span class="text-xs font-bold text-gray-900">Lambang Pemasyarakatan</span>
            <span class="text-[10px] text-gray-500 mt-0.5">Pengayoman & Pembinaan</span>
        </div>
        <div class="sm:col-span-2 space-y-2">
            <h3 class="text-base font-bold text-gray-900">Makna dan Filosofi Lambang</h3>
            <p class="text-xs text-gray-600 leading-relaxed">
                Lambang Pemasyarakatan melambangkan perlindungan, pengayoman, serta tekad kuat untuk membimbing Warga Binaan Pemasyarakatan (WBP) agar menyadari kesalahan, memperbaiki diri, dan tidak mengulangi tindak pidana sehingga dapat diterima kembali oleh lingkungan masyarakat.
            </p>
        </div>
    </div>

    <div>
        <h3 class="text-base font-bold text-gray-900 mb-3">Tata Nilai Budaya Kerja: PASTI</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div class="p-3.5 bg-white border border-gray-200 rounded-xl shadow-xs">
                <span class="font-extrabold text-red-600 text-sm">P - Profesional</span>
                <p class="text-xs text-gray-600 mt-1">Aparat rutan bekerja tuntas dan akurat atas dasar kompetensi terbaik.</p>
            </div>
            <div class="p-3.5 bg-white border border-gray-200 rounded-xl shadow-xs">
                <span class="font-extrabold text-red-600 text-sm">A - Akuntabel</span>
                <p class="text-xs text-gray-600 mt-1">Setiap pelaksanaan tugas dan anggaran dapat dipertanggungjawabkan kepada publik.</p>
            </div>
            <div class="p-3.5 bg-white border border-gray-200 rounded-xl shadow-xs">
                <span class="font-extrabold text-red-600 text-sm">S - Sinergi</span>
                <p class="text-xs text-gray-600 mt-1">Membangun komitmen kerja sama produktif dengan aparat penegak hukum (APH) & stakeholder.</p>
            </div>
            <div class="p-3.5 bg-white border border-gray-200 rounded-xl shadow-xs">
                <span class="font-extrabold text-red-600 text-sm">T - Transparan</span>
                <p class="text-xs text-gray-600 mt-1">Menjamin keterbukaan informasi publik dan kepastian seluruh layanan tanpa pungli.</p>
            </div>
            <div class="p-3.5 bg-white border border-gray-200 rounded-xl shadow-xs sm:col-span-2">
                <span class="font-extrabold text-red-600 text-sm">I - Inovatif</span>
                <p class="text-xs text-gray-600 mt-1">Selalu berdaya cipta memberikan terobosan kemudahan layanan bagi masyarakat dan keluarga warga binaan.</p>
            </div>
        </div>
    </div>

    <div class="pt-2 border-t border-gray-150">
        <h3 class="text-base font-bold text-gray-900 mb-2">Core Values ASN BerAKHLAK</h3>
        <p class="text-xs text-gray-600 leading-relaxed">
            Seluruh pegawai Rutan Kelas IIB Pandeglang memegang teguh core values ASN: <strong>Berorientasi Pelayanan, Akuntabel, Kompeten, Harmonis, Loyal, Adaptif, dan Kolaboratif</strong> dengan semboyan bangga melayani bangsa.
        </p>
    </div>
</div>
@endsection
