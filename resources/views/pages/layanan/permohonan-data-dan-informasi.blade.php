@extends('layouts.page')

@section('page_content')
<div class="space-y-6 text-gray-700 leading-relaxed text-sm">
    <div class="border-b border-gray-150 pb-4">
        <h2 class="text-xl font-bold text-gray-900">Permohonan Data & Informasi Publik (PPID)</h2>
        <p class="text-xs text-gray-500 mt-1">Layanan Pejabat Pengelola Informasi dan Dokumentasi (PPID) Rutan Pandeglang.</p>
    </div>

    <div class="space-y-4">
        <p>
            Berdasarkan Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik, setiap warga negara berhak memperoleh informasi publik yang dikelola oleh instansi pemerintah secara cepat, tepat waktu, dan berbiaya ringan.
        </p>

        <!-- Tahapan Alur Permohonan -->
        <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 space-y-3">
            <h3 class="font-bold text-gray-900 text-sm">Alur & Prosedur Permohonan Informasi:</h3>
            <ol class="list-decimal list-inside text-xs text-gray-600 space-y-2 leading-relaxed">
                <li><strong>Pengajuan Permohonan:</strong> Pemohon mengisi formulir permohonan informasi publik dengan melampirkan fotokopi/scan KTP atau identitas diri yang sah.</li>
                <li><strong>Verifikasi Dokumen:</strong> Petugas PPID Rutan Pandeglang memeriksa kelengkapan administrasi dan keabsahan tujuan permohonan.</li>
                <li><strong>Penyusunan Tanggapan:</strong> PPID memproses dan mengoordinasikan ketersediaan dokumen maksimal dalam 10 (sepuluh) hari kerja.</li>
                <li><strong>Pemberian Informasi:</strong> Pemohon menerima dokumen informasi publik yang diminta secara langsung atau melalui surat elektronik (email).</li>
            </ol>
        </div>

        <div class="p-4 bg-red-50/60 border border-red-200 rounded-xl text-xs space-y-1">
            <span class="font-bold text-red-800">Catatan Penting:</span>
            <p class="text-gray-700">
                Layanan permohonan informasi publik ini <strong>TIDAK DIPUNGUT BIAYA (GRATIS)</strong>. Informasi yang dikecualikan (rahasia negara/keamanan blok hunian tahanan) tidak dapat dipublikasikan sesuai peraturan perundang-undangan.
            </p>
        </div>
    </div>
</div>
@endsection
