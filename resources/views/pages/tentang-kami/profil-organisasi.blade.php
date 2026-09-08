@extends('layouts.page')

@section('page_content')
<div class="space-y-6 text-gray-700 leading-relaxed text-sm">
    <div class="border-b border-gray-150 pb-4">
        <h2 class="text-xl font-bold text-gray-900">Profil Organisasi</h2>
        <p class="text-xs text-gray-500 mt-1">Visi, misi, tugas pokok, dan fungsi institusi.</p>
    </div>

    <!-- Visi & Misi Card -->
    <div class="space-y-4">
        <div class="bg-red-50/50 border border-red-200 rounded-xl p-5">
            <h3 class="text-sm font-extrabold text-red-700 uppercase tracking-wider mb-2">Visi Organisasi</h3>
            <p class="text-xs text-gray-800 italic leading-relaxed font-medium">
                "Terwujudnya Penegakan Hukum Pemasyarakatan yang Berkeadilan, Menjunjung Tinggi HAM, dan Terpercaya dalam Membangun Kemandirian Warga Binaan Pemasyarakatan."
            </p>
        </div>

        <div class="bg-gray-50 border border-gray-200 rounded-xl p-5">
            <h3 class="text-sm font-extrabold text-gray-900 uppercase tracking-wider mb-2">Misi Organisasi</h3>
            <ol class="list-decimal list-inside text-xs text-gray-700 space-y-1.5 leading-relaxed">
                <li>Melaksanakan perawatan dan pelayanan tahanan secara profesional dan humanis.</li>
                <li>Melaksanakan pembinaan kepribadian dan kemandirian narapidana secara berkesinambungan.</li>
                <li>Menjaga keamanan dan ketertiban rutan melalui deteksi dini dan sinergitas APH.</li>
                <li>Mewujudkan tata kelola pemerintahan yang bersih, transparan, dan bebas dari korupsi (WBK).</li>
                <li>Memberikan pelayanan publik berbasis teknologi informasi yang cepat dan bebas pungli.</li>
            </ol>
        </div>
    </div>

    <!-- Tugas Pokok & Fungsi -->
    <div class="pt-2 border-t border-gray-150">
        <h3 class="text-base font-bold text-gray-900 mb-2">Tugas Pokok & Fungsi</h3>
        <p class="text-xs text-gray-600 mb-3">
            Berdasarkan regulasi yang berlaku, Rutan Kelas IIB Pandeglang mempunyai tugas pokok melaksanakan perawatan terhadap tersangka atau terdakwa sesuai dengan peraturan perundang-undangan.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
            <div class="p-3 border border-gray-200 rounded-lg bg-white">
                <span class="font-bold text-gray-900 block mb-1">1. Pelayanan Tahanan</span>
                <p class="text-gray-600">Penerimaan, pendaftaran, administrasi penahanan, perawatan jasmani, dan bantuan hukum.</p>
            </div>
            <div class="p-3 border border-gray-200 rounded-lg bg-white">
                <span class="font-bold text-gray-900 block mb-1">2. Pemeliharaan Keamanan</span>
                <p class="text-gray-600">Penjagaan, pengawalan, penggeledahan rutin, dan penegakan tata tertib rutan.</p>
            </div>
            <div class="p-3 border border-gray-200 rounded-lg bg-white">
                <span class="font-bold text-gray-900 block mb-1">3. Pengelolaan Rutan</span>
                <p class="text-gray-600">Urusan kepegawaian, keuangan, surat-menyurat, perlengkapan, dan rumah tangga rutan.</p>
            </div>
            <div class="p-3 border border-gray-200 rounded-lg bg-white">
                <span class="font-bold text-gray-900 block mb-1">4. Pembinaan Kepribadian</span>
                <p class="text-gray-600">Kegiatan keagamaan, penyuluhan mental, dan pembekalan keterampilan dasar.</p>
            </div>
        </div>
    </div>
</div>
@endsection
