<?php

namespace Database\Seeders;

use App\Models\StrukturOrganisasi;
use Illuminate\Database\Seeder;

class StrukturOrganisasiSeeder extends Seeder
{
    /**
     * Kerangka jabatan struktural Rutan Kelas IIB. Nama pejabat diisi Humas lewat panel admin.
     */
    public function run(): void
    {
        if (StrukturOrganisasi::query()->exists()) {
            return;
        }

        $karutan = StrukturOrganisasi::create([
            'jabatan' => 'Kepala Rumah Tahanan Negara Kelas IIB Pandeglang',
            'urutan' => 1,
        ]);

        foreach ([
            'Kepala Kesatuan Pengamanan Rutan',
            'Kepala Subseksi Pelayanan Tahanan',
            'Kepala Subseksi Pengelolaan',
        ] as $i => $jabatan) {
            StrukturOrganisasi::create(['parent_id' => $karutan->id, 'jabatan' => $jabatan, 'urutan' => $i + 1]);
        }
    }
}
