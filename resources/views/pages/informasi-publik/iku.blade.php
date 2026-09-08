@extends('layouts.page')

@section('page_content')
<div class="space-y-6 text-gray-700 leading-relaxed text-sm">
    <div class="border-b border-gray-150 pb-4">
        <h2 class="text-xl font-bold text-gray-900">Indikator Kinerja Utama (IKU)</h2>
        <p class="text-xs text-gray-500 mt-1">Tolok ukur pencapaian sasaran strategis yang menjadi dasar evaluasi kinerja instansi setiap tahun.</p>
    </div>

    <div class="space-y-4 text-xs">
        <p class="text-sm leading-relaxed">
            Indikator Kinerja Utama (IKU) Rumah Tahanan Negara Kelas IIB Pandeglang ditetapkan berdasarkan Keputusan Menteri dan menjadi acuan dalam mengukur keberhasilan pelaksanaan program serta kebijakan pelayanan pemasyarakatan secara terukur dan akuntabel.
        </p>

        <!-- Tabel Capaian IKU -->
        <div class="overflow-x-auto border border-gray-200 rounded-xl shadow-xs">
            <table class="w-full text-left">
                <thead class="bg-gray-100 text-gray-800 uppercase text-[10px] tracking-wider">
                    <tr>
                        <th class="py-3 px-4">Indikator Kinerja</th>
                        <th class="py-3 px-4 text-center">Target</th>
                        <th class="py-3 px-4 text-center">Realisasi</th>
                        <th class="py-3 px-4 text-center">Capaian</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="py-3 px-4 font-semibold text-gray-900">Indeks Kepuasan Layanan Pemasyarakatan</td>
                        <td class="py-3 px-4 text-center text-gray-600">85%</td>
                        <td class="py-3 px-4 text-center text-gray-600">87,5%</td>
                        <td class="py-3 px-4 text-center"><span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-700">102,9%</span></td>
                    </tr>
                    <tr>
                        <td class="py-3 px-4 font-semibold text-gray-900">Persentase Penyelesaian Pengaduan Masyarakat</td>
                        <td class="py-3 px-4 text-center text-gray-600">100%</td>
                        <td class="py-3 px-4 text-center text-gray-600">100%</td>
                        <td class="py-3 px-4 text-center"><span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-700">100%</span></td>
                    </tr>
                    <tr>
                        <td class="py-3 px-4 font-semibold text-gray-900">Tingkat Keamanan dan Ketertiban UPT</td>
                        <td class="py-3 px-4 text-center text-gray-600">95%</td>
                        <td class="py-3 px-4 text-center text-gray-600">96,8%</td>
                        <td class="py-3 px-4 text-center"><span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-700">101,9%</span></td>
                    </tr>
                    <tr>
                        <td class="py-3 px-4 font-semibold text-gray-900">Realisasi Penyerapan Anggaran</td>
                        <td class="py-3 px-4 text-center text-gray-600">95%</td>
                        <td class="py-3 px-4 text-center text-gray-600">93,2%</td>
                        <td class="py-3 px-4 text-center"><span class="px-2 py-0.5 rounded text-[10px] font-bold bg-amber-100 text-amber-700">98,1%</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Dokumen IKU Unduh -->
        <div class="overflow-x-auto border border-gray-200 rounded-xl shadow-xs">
            <table class="w-full text-left">
                <thead class="bg-gray-100 text-gray-800 uppercase text-[10px] tracking-wider">
                    <tr>
                        <th class="py-3 px-4">Nama Dokumen</th>
                        <th class="py-3 px-4">Tahun</th>
                        <th class="py-3 px-4 text-center">Aksi Unduh</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="py-3 px-4 font-semibold text-gray-900">Dokumen Penetapan IKU Rutan Kelas IIB Pandeglang Tahun 2025</td>
                        <td class="py-3 px-4 text-gray-500">2025</td>
                        <td class="py-3 px-4 text-center">
                            <span class="inline-flex items-center gap-1 text-red-600 font-bold hover:underline cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Unduh PDF
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-3 px-4 font-semibold text-gray-900">Dokumen Penetapan IKU Rutan Kelas IIB Pandeglang Tahun 2024</td>
                        <td class="py-3 px-4 text-gray-500">2024</td>
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
