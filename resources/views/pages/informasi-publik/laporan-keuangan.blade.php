@extends('layouts.page')

@section('page_content')
<div class="space-y-6 text-gray-700 leading-relaxed text-sm">
    <div class="border-b border-gray-150 pb-4">
        <h2 class="text-xl font-bold text-gray-900">Laporan Keuangan</h2>
        <p class="text-xs text-gray-500 mt-1">Transparansi realisasi anggaran dan pertanggungjawaban keuangan negara Rutan Kelas IIB Pandeglang.</p>
    </div>

    <div class="space-y-4 text-xs">
        <p class="text-sm leading-relaxed">
            Sebagai bentuk akuntabilitas pengelolaan keuangan negara, Rumah Tahanan Negara Kelas IIB Pandeglang mempublikasikan laporan keuangan yang mencakup neraca, laporan realisasi anggaran (LRA), laporan operasional (LO), dan catatan atas laporan keuangan (CaLK) sesuai Standar Akuntansi Pemerintahan (SAP).
        </p>

        <!-- Tabel Unduh Dokumen Laporan Keuangan -->
        <div class="overflow-x-auto border border-gray-200 rounded-xl shadow-xs">
            <table class="w-full text-left">
                <thead class="bg-gray-100 text-gray-800 uppercase text-[10px] tracking-wider">
                    <tr>
                        <th class="py-3 px-4">Nama Dokumen</th>
                        <th class="py-3 px-4">Periode</th>
                        <th class="py-3 px-4 text-center">Status Audit</th>
                        <th class="py-3 px-4 text-center">Aksi Unduh</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="py-3 px-4 font-semibold text-gray-900">Laporan Keuangan Semester II TA 2025</td>
                        <td class="py-3 px-4 text-gray-500">Juli – Desember 2025</td>
                        <td class="py-3 px-4 text-center"><span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-700">Audited BPK</span></td>
                        <td class="py-3 px-4 text-center">
                            <span class="inline-flex items-center gap-1 text-red-600 font-bold hover:underline cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Unduh PDF
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-3 px-4 font-semibold text-gray-900">Laporan Keuangan Semester I TA 2025</td>
                        <td class="py-3 px-4 text-gray-500">Januari – Juni 2025</td>
                        <td class="py-3 px-4 text-center"><span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-700">Audited BPK</span></td>
                        <td class="py-3 px-4 text-center">
                            <span class="inline-flex items-center gap-1 text-red-600 font-bold hover:underline cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Unduh PDF
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-3 px-4 font-semibold text-gray-900">Laporan Keuangan Tahunan TA 2024</td>
                        <td class="py-3 px-4 text-gray-500">Januari – Desember 2024</td>
                        <td class="py-3 px-4 text-center"><span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-700">Audited BPK</span></td>
                        <td class="py-3 px-4 text-center">
                            <span class="inline-flex items-center gap-1 text-red-600 font-bold hover:underline cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Unduh PDF
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="p-4 bg-gray-50 border border-gray-200 rounded-xl space-y-1">
            <span class="font-bold text-gray-900">Komponen Laporan Keuangan:</span>
            <ul class="list-disc list-inside text-gray-600 space-y-0.5">
                <li>Neraca (Laporan Posisi Keuangan)</li>
                <li>Laporan Realisasi Anggaran (LRA)</li>
                <li>Laporan Operasional (LO)</li>
                <li>Laporan Perubahan Ekuitas (LPE)</li>
                <li>Catatan atas Laporan Keuangan (CaLK)</li>
            </ul>
        </div>
    </div>
</div>
@endsection
