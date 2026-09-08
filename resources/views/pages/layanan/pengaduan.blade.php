@extends('layouts.page')

@section('page_content')
<div class="space-y-6 text-gray-700 leading-relaxed text-sm">
    <div class="border-b border-gray-150 pb-4">
        <h2 class="text-xl font-bold text-gray-900">Saluran Layanan Pengaduan Masyarakat</h2>
        <p class="text-xs text-gray-500 mt-1">Sarana aspirasi, laporan pungli, gratifikasi, dan ketidakpuasan layanan rutan.</p>
    </div>

    <div class="space-y-4 text-xs">
        <p class="text-sm leading-relaxed">
            Rutan Kelas IIB Pandeglang berkomitmen memberikan pelayanan yang bersih, transparan, dan bebas pungutan liar. Masyarakat yang menemukan pelanggaran kode etik, indikasi pungli, diskriminasi layanan, atau peredaran barang terlarang dipersilakan melapor melalui kanal resmi kami.
        </p>

        <!-- Kanal Pengaduan Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- SP4N LAPOR -->
            <div class="p-5 bg-red-50/50 border border-red-200 rounded-xl space-y-2">
                <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-red-600 text-white">Nasional</span>
                <h3 class="font-bold text-gray-900 text-sm">SP4N - LAPOR!</h3>
                <p class="text-gray-600 leading-relaxed">Layanan Aspirasi dan Pengaduan Online Rakyat yang terhubung langsung ke Kantor Staf Presiden & Ombudsman.</p>
                <a href="https://www.lapor.go.id" target="_blank" class="inline-block text-xs font-bold text-red-600 hover:underline">Kunjungi lapor.go.id &rarr;</a>
            </div>

            <!-- Whistleblowing System -->
            <div class="p-5 bg-gray-50 border border-gray-200 rounded-xl space-y-2">
                <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-gray-900 text-white">Internal Kemenimipas</span>
                <h3 class="font-bold text-gray-900 text-sm">WBS (Whistleblowing System)</h3>
                <p class="text-gray-600 leading-relaxed">Saluran pengaduan pelanggaran disiplin dan tindak pidana korupsi pegawai yang terhubung ke Inspektorat Jenderal.</p>
                <span class="inline-block text-xs font-semibold text-gray-700">Kerahasiaan Identitas Dijamin 100%</span>
            </div>
        </div>

        <!-- Pengaduan Langsung Rutan Pandeglang -->
        <div class="p-5 bg-white border border-gray-200 rounded-xl space-y-3">
            <h3 class="font-bold text-gray-900 text-sm">Pengaduan Langsung Unit Rutan Pandeglang</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-gray-600">
                <div class="p-3 bg-gray-50 rounded-lg">
                    <span class="font-bold text-gray-900 block">WhatsApp Pengaduan / Dumas:</span>
                    <span class="text-sm font-semibold text-red-600">0812-XXXX-XXXX</span>
                </div>
                <div class="p-3 bg-gray-50 rounded-lg">
                    <span class="font-bold text-gray-900 block">Email Pengaduan:</span>
                    <span class="text-sm font-semibold text-gray-900">pengaduan@rutanpandeglang.go.id</span>
                </div>
            </div>
            <p class="text-gray-500 pt-1">
                Atau masukkan surat pengaduan fisik ke dalam <strong>Kotak Pengaduan</strong> yang tersedia di ruang tunggu pendaftaran kunjungan rutan.
            </p>
        </div>
    </div>
</div>
@endsection
