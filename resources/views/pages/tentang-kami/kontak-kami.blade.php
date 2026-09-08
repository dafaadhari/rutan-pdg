@extends('layouts.page')

@section('page_content')
<div class="space-y-6 text-gray-700 leading-relaxed text-sm">
    <div class="border-b border-gray-150 pb-4">
        <h2 class="text-xl font-bold text-gray-900">Kontak Resmi Instansi</h2>
        <p class="text-xs text-gray-500 mt-1">Saluran komunikasi, alamat, dan jam operasional pelayanan masyarakat.</p>
    </div>

    <!-- Info Kotak Kontak -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
        <div class="p-4 bg-gray-50 border border-gray-200 rounded-xl space-y-1">
            <span class="font-bold text-gray-900 block text-sm mb-2">Alamat Kantor</span>
            <p class="text-gray-600">Jalan Raya Pandeglang - Serang</p>
            <p class="text-gray-600">Kabupaten Pandeglang, Provinsi Banten</p>
            <p class="text-gray-600">Kode Pos: 42213</p>
        </div>

        <div class="p-4 bg-gray-50 border border-gray-200 rounded-xl space-y-1">
            <span class="font-bold text-gray-900 block text-sm mb-2">Saluran Digital</span>
            <p class="text-gray-600"><strong>Email:</strong> info@rutanpandeglang.go.id</p>
            <p class="text-gray-600"><strong>Telepon:</strong> (0253) 201234</p>
            <p class="text-gray-600"><strong>Layanan WhatsApp Humas:</strong> 0812-XXXX-XXXX</p>
        </div>
    </div>

    <!-- Jam Layanan Kunjungan -->
    <div class="p-5 bg-white border border-gray-200 rounded-xl space-y-2">
        <h3 class="text-sm font-bold text-gray-900">Jadwal Pelayanan Kunjungan & Penitipan Barang</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left text-gray-600 mt-2">
                <thead class="bg-gray-100 text-gray-800 uppercase text-[10px] tracking-wider">
                    <tr>
                        <th class="py-2 px-3">Hari</th>
                        <th class="py-2 px-3">Sesi Pagi</th>
                        <th class="py-2 px-3">Sesi Siang</th>
                        <th class="py-2 px-3">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="py-2.5 px-3 font-semibold text-gray-900">Senin - Kamis</td>
                        <td class="py-2.5 px-3">08.30 - 11.30 WIB</td>
                        <td class="py-2.5 px-3">13.00 - 14.30 WIB</td>
                        <td class="py-2.5 px-3 text-emerald-600 font-medium">Layanan Tatap Muka & Titipan</td>
                    </tr>
                    <tr>
                        <td class="py-2.5 px-3 font-semibold text-gray-900">Jumat</td>
                        <td class="py-2.5 px-3">08.30 - 11.00 WIB</td>
                        <td class="py-2.5 px-3">Tutup</td>
                        <td class="py-2.5 px-3 text-emerald-600 font-medium">Khusus Titipan Barang / Makanan</td>
                    </tr>
                    <tr>
                        <td class="py-2.5 px-3 font-semibold text-gray-900">Sabtu</td>
                        <td class="py-2.5 px-3">08.30 - 11.30 WIB</td>
                        <td class="py-2.5 px-3">Tutup</td>
                        <td class="py-2.5 px-3 text-blue-600 font-medium">Kunjungan Khusus Tahanan</td>
                    </tr>
                    <tr>
                        <td class="py-2.5 px-3 font-semibold text-gray-900">Minggu & Libur</td>
                        <td colspan="3" class="py-2.5 px-3 text-red-600 font-semibold">Tutup / Libur Nasional</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
