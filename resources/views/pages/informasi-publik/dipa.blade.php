@extends('layouts.page')

@section('page_content')
<div class="space-y-6 text-gray-700 leading-relaxed text-sm">
    <div class="border-b border-gray-150 pb-4">
        <h2 class="text-xl font-bold text-gray-900">Daftar Isian Pelaksanaan Anggaran (DIPA)</h2>
        <p class="text-xs text-gray-500 mt-1">Transparansi alokasi pagu anggaran belanja dan program kerja tahun berjalan.</p>
    </div>

    <div class="space-y-4 text-xs">
        <p class="text-sm leading-relaxed">
            Sebagai bentuk komitmen keterbukaan informasi publik dan akuntabilitas keuangan negara, berikut disajikan ringkasan Daftar Isian Pelaksanaan Anggaran (DIPA) Rumah Tahanan Negara Kelas IIB Pandeglang.
        </p>

        <!-- Tabel Ringkasan Pagu Anggaran -->
        <div class="overflow-x-auto border border-gray-200 rounded-xl shadow-xs">
            <table class="w-full text-left">
                <thead class="bg-gray-100 text-gray-800 uppercase text-[10px] tracking-wider">
                    <tr>
                        <th class="py-3 px-4">Tahun Anggaran</th>
                        <th class="py-3 px-4">Nomor SP DIPA</th>
                        <th class="py-3 px-4">Program Utama</th>
                        <th class="py-3 px-4 text-center">Dokumen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="py-3 px-4 font-bold text-gray-900">TA 2026</td>
                        <td class="py-3 px-4 font-mono text-gray-600">SP DIPA-013.05.2.XXXXXX/2026</td>
                        <td class="py-3 px-4 text-gray-700">Program Penegakan dan Pelayanan Hukum / Pemasyarakatan</td>
                        <td class="py-3 px-4 text-center">
                            <span class="text-red-600 font-bold hover:underline cursor-pointer">Lihat Salinan</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-3 px-4 font-bold text-gray-900">TA 2025</td>
                        <td class="py-3 px-4 font-mono text-gray-600">SP DIPA-013.05.2.XXXXXX/2025</td>
                        <td class="py-3 px-4 text-gray-700">Program Penegakan dan Pelayanan Hukum / Pemasyarakatan</td>
                        <td class="py-3 px-4 text-center">
                            <span class="text-red-600 font-bold hover:underline cursor-pointer">Lihat Salinan</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="p-4 bg-gray-50 border border-gray-200 rounded-xl space-y-1">
            <span class="font-bold text-gray-900">Komponen Utama Anggaran DIPA:</span>
            <ul class="list-disc list-inside text-gray-600 space-y-0.5">
                <li>Belanja Pegawai (Gaji pokok dan tunjangan kinerja ASN)</li>
                <li>Belanja Barang Operasional (Bahan makanan WBP, pemeliharaan gedung & kendaraan dinas, listrik, air)</li>
                <li>Belanja Modal (Pengadaan sarana pengamanan dan inventaris perkantoran)</li>
            </ul>
        </div>
    </div>
</div>
@endsection
