@extends('layouts.page')

@section('page_content')
<div class="space-y-6 text-gray-700 leading-relaxed text-sm">
    <div class="border-b border-gray-150 pb-4">
        <h2 class="text-xl font-bold text-gray-900">Rencana Strategis (Renstra)</h2>
        <p class="text-xs text-gray-500 mt-1">Dokumen perencanaan jangka menengah yang memuat visi, misi, tujuan, dan arah kebijakan instansi.</p>
    </div>

    <div class="space-y-4 text-xs">
        <p class="text-sm leading-relaxed">
            Rencana Strategis (Renstra) Rumah Tahanan Negara Kelas IIB Pandeglang disusun sebagai penjabaran dari Rencana Strategis Direktorat Jenderal Pemasyarakatan dan Rencana Pembangunan Jangka Menengah Nasional (RPJMN) untuk periode lima tahun ke depan, memuat sasaran strategis, indikator kinerja, serta program dan kegiatan prioritas.
        </p>

        <!-- Arah Kebijakan Strategis -->
        <div class="p-4 bg-blue-50 border border-blue-200 rounded-xl space-y-2">
            <span class="font-bold text-blue-900 text-sm">Arah Kebijakan Strategis:</span>
            <ol class="list-decimal list-inside text-blue-800 space-y-1">
                <li>Peningkatan pelayanan tahanan berbasis hak asasi manusia</li>
                <li>Penguatan kapasitas pengamanan dan ketertiban dengan pendekatan humanis</li>
                <li>Optimalisasi pembinaan kepribadian dan kemandirian WBP</li>
                <li>Peningkatan kualitas SDM aparatur pemasyarakatan yang profesional dan berintegritas</li>
                <li>Percepatan reformasi birokrasi dan penguatan zona integritas menuju WBK/WBBM</li>
            </ol>
        </div>

        <!-- Tabel Unduh Dokumen Renstra -->
        <div class="overflow-x-auto border border-gray-200 rounded-xl shadow-xs">
            <table class="w-full text-left">
                <thead class="bg-gray-100 text-gray-800 uppercase text-[10px] tracking-wider">
                    <tr>
                        <th class="py-3 px-4">Nama Dokumen</th>
                        <th class="py-3 px-4">Periode</th>
                        <th class="py-3 px-4 text-center">Status</th>
                        <th class="py-3 px-4 text-center">Aksi Unduh</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="py-3 px-4 font-semibold text-gray-900">Renstra Rutan Kelas IIB Pandeglang 2025–2029</td>
                        <td class="py-3 px-4 text-gray-500">5 Tahun (2025–2029)</td>
                        <td class="py-3 px-4 text-center"><span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-700">Ditetapkan</span></td>
                        <td class="py-3 px-4 text-center">
                            <span class="inline-flex items-center gap-1 text-red-600 font-bold hover:underline cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Unduh PDF
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-3 px-4 font-semibold text-gray-900">Renstra Rutan Kelas IIB Pandeglang 2020–2024</td>
                        <td class="py-3 px-4 text-gray-500">5 Tahun (2020–2024)</td>
                        <td class="py-3 px-4 text-center"><span class="px-2 py-0.5 rounded text-[10px] font-bold bg-gray-200 text-gray-600">Arsip</span></td>
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
    </div>
</div>
@endsection
