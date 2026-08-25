<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $beritas = [
            [
                'judul' => 'Pengarahan Karutan Mengenai Peningkatan Kinerja dan Pelayanan Publik PASTI',
                'slug' => Str::slug('Pengarahan Karutan Mengenai Peningkatan Kinerja dan Pelayanan Publik PASTI'),
                'konten' => '<p>Pandeglang — Kepala Rumah Tahanan Negara Kelas IIB Pandeglang memberikan pengarahan kepada seluruh jajaran pegawai dalam rangka memperkuat komitmen pelayanan publik yang transparan, akuntabel, dan berintegritas tinggi.</p><p>Karutan menegaskan pentingnya implementasi nilai PASTI (Profesional, Akuntabel, Sinergi, Transparan, dan Inovatif) dalam menjalankan tugas sehari-hari demi menciptakan lingkungan Pemasyarakatan yang aman dan tertib.</p>',
                'gambar_sampul' => null,
                'status' => 'publikasi',
                'created_at' => now()->subHours(2),
                'updated_at' => now()->subHours(2),
            ],
            [
                'judul' => 'Jadwal dan Ketentuan Layanan Kunjungan Tatap Muka Terbaru Rutan Pandeglang',
                'slug' => Str::slug('Jadwal dan Ketentuan Layanan Kunjungan Tatap Muka Terbaru Rutan Pandeglang'),
                'konten' => '<p>Pandeglang — Rutan Kelas IIB Pandeglang mengumumkan penyesuaian jadwal layanan kunjungan tatap muka bagi keluarga warga binaan. Kunjungan dilaksanakan setiap hari Senin hingga Kamis dengan pembagian sesi pagi dan siang.</p><p>Seluruh pengunjung diimbau membawa identitas diri sah (KTP/SIM) dan mematuhi tata tertib kunjungan yang berlaku. Seluruh layanan kunjungan tidak dipungut biaya apapun (GRATIS).</p>',
                'gambar_sampul' => null,
                'status' => 'publikasi',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'judul' => 'Program Pembinaan Kerohanian dan Pelatihan Kemandirian Warga Binaan',
                'slug' => Str::slug('Program Pembinaan Kerohanian dan Pelatihan Kemandirian Warga Binaan'),
                'konten' => '<p>Pandeglang — Dalam upaya memberikan bekal positif bagi Warga Binaan Pemasyarakatan (WBP), Rutan Kelas IIB Pandeglang secara rutin menggelar kegiatan pengajian bersama dan pelatihan keterampilan kerajinan tangan.</p><p>Kegiatan ini bertujuan untuk membentuk kepribadian yang lebih baik sehingga warga binaan siap kembali dan diterima dengan baik oleh masyarakat.</p>',
                'gambar_sampul' => null,
                'status' => 'publikasi',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'judul' => 'Draft Rencana Kegiatan Penyuluhan Hukum Bagi Warga Binaan Baru',
                'slug' => Str::slug('Draft Rencana Kegiatan Penyuluhan Hukum Bagi Warga Binaan Baru'),
                'konten' => '<p>Artikel ini masih berupa draf internal mengenai jadwal penyuluhan bantuan hukum gratis bagi warga binaan yang baru masuk.</p>',
                'gambar_sampul' => null,
                'status' => 'draft',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
        ];

        foreach ($beritas as $berita) {
            Berita::updateOrCreate(['slug' => $berita['slug']], $berita);
        }
    }
}
