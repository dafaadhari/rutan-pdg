@extends('layouts.page')

@section('page_content')
<div class="space-y-6 text-gray-700 leading-relaxed text-sm">
    <div class="border-b border-gray-150 pb-4">
        <h2 class="text-xl font-bold text-gray-900">Hasil Survei SPAK/SPKP</h2>
        <p class="text-xs text-gray-500 mt-1">Survei Persepsi Anti Korupsi (SPAK) dan Survei Penilaian Kepuasan Pelayanan (SPKP) sebagai barometer integritas dan kualitas layanan.</p>
    </div>

    <div class="space-y-4 text-xs">
        <p class="text-sm leading-relaxed">
            Rumah Tahanan Negara Kelas IIB Pandeglang secara berkala melaksanakan Survei Persepsi Anti Korupsi (SPAK) dan Survei Penilaian Kepuasan Pelayanan (SPKP) sebagai bagian dari penilaian pembangunan Zona Integritas menuju Wilayah Bebas dari Korupsi (WBK) dan Wilayah Birokrasi Bersih dan Melayani (WBBM).
        </p>

        <!-- Penjelasan Singkat SPAK dan SPKP -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="p-4 bg-red-50 border border-red-200 rounded-xl">
                <h3 class="font-bold text-red-900 text-sm mb-1">SPAK</h3>
                <p class="text-red-800 leading-relaxed">
                    Survei Persepsi Anti Korupsi mengukur persepsi stakeholder terhadap praktik korupsi, gratifikasi, dan integritas pelayanan di lingkungan UPT Pemasyarakatan.
                </p>
            </div>
            <div class="p-4 bg-blue-50 border border-blue-200 rounded-xl">
                <h3 class="font-bold text-blue-900 text-sm mb-1">SPKP</h3>
                <p class="text-blue-800 leading-relaxed">
                    Survei Penilaian Kepuasan Pelayanan mengukur tingkat kepuasan pengguna layanan terhadap aspek kecepatan, transparansi, keramahan, dan kualitas pelayanan publik rutan.
                </p>
            </div>
        </div>

        <!-- Tabel Ringkasan Skor -->
        <div class="overflow-x-auto border border-gray-200 rounded-xl shadow-xs">
            <table class="w-full text-left">
                <thead class="bg-gray-100 text-gray-800 uppercase text-[10px] tracking-wider">
                    <tr>
                        <th class="py-3 px-4">Jenis Survei</th>
                        <th class="py-3 px-4 text-center">Tahun</th>
                        <th class="py-3 px-4 text-center">Skor / Indeks</th>
                        <th class="py-3 px-4 text-center">Kategori</th>
                        <th class="py-3 px-4 text-center">Dokumen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="py-3 px-4 font-semibold text-gray-900">Survei Persepsi Anti Korupsi (SPAK)</td>
                        <td class="py-3 px-4 text-center text-gray-500">2025</td>
                        <td class="py-3 px-4 text-center font-bold text-gray-900">3,72 / 4,00</td>
                        <td class="py-3 px-4 text-center"><span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-700">Sangat Baik</span></td>
                        <td class="py-3 px-4 text-center">
                            <span class="inline-flex items-center gap-1 text-red-600 font-bold hover:underline cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Unduh
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-3 px-4 font-semibold text-gray-900">Survei Kepuasan Pelayanan (SPKP)</td>
                        <td class="py-3 px-4 text-center text-gray-500">2025</td>
                        <td class="py-3 px-4 text-center font-bold text-gray-900">88,4 / 100</td>
                        <td class="py-3 px-4 text-center"><span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-700">Sangat Baik</span></td>
                        <td class="py-3 px-4 text-center">
                            <span class="inline-flex items-center gap-1 text-red-600 font-bold hover:underline cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Unduh
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-3 px-4 font-semibold text-gray-900">Survei Persepsi Anti Korupsi (SPAK)</td>
                        <td class="py-3 px-4 text-center text-gray-500">2024</td>
                        <td class="py-3 px-4 text-center font-bold text-gray-900">3,65 / 4,00</td>
                        <td class="py-3 px-4 text-center"><span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-700">Baik</span></td>
                        <td class="py-3 px-4 text-center">
                            <span class="inline-flex items-center gap-1 text-red-600 font-bold hover:underline cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Unduh
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-3 px-4 font-semibold text-gray-900">Survei Kepuasan Pelayanan (SPKP)</td>
                        <td class="py-3 px-4 text-center text-gray-500">2024</td>
                        <td class="py-3 px-4 text-center font-bold text-gray-900">85,7 / 100</td>
                        <td class="py-3 px-4 text-center"><span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-700">Baik</span></td>
                        <td class="py-3 px-4 text-center">
                            <span class="inline-flex items-center gap-1 text-red-600 font-bold hover:underline cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Unduh
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="p-4 bg-gray-50 border border-gray-200 rounded-xl space-y-1">
            <span class="font-bold text-gray-900">Catatan:</span>
            <p class="text-gray-600 leading-relaxed">
                Survei dilaksanakan oleh Tim Penilai Internal (TPI) dan diverifikasi oleh Tim Penilai Nasional (TPN) Kementerian PAN-RB sebagai bagian dari penilaian pembangunan Zona Integritas menuju WBK/WBBM.
            </p>
        </div>
    </div>
</div>
@endsection
