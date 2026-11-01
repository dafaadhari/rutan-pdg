<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use Illuminate\Database\Seeder;

/**
 * DATA DUMMY untuk sambutan pimpinan & banner pengumuman.
 * Ganti lewat panel admin (menu Sambutan & Pengumuman) setelah data resmi dari humas tersedia.
 */
class PengaturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pengaturan::simpan('sambutan', [
            'tampil' => true,
            'judul' => 'Melayani dengan integritas, membina dengan hati',
            'isi' => "Assalamu'alaikum warahmatullahi wabarakatuh, salam sejahtera bagi kita semua.\n\n"
                . "Selamat datang di portal informasi resmi Rumah Tahanan Negara Kelas IIB Pandeglang. Portal ini kami hadirkan sebagai wujud komitmen keterbukaan informasi publik, agar masyarakat dan keluarga Warga Binaan dapat memperoleh informasi layanan secara mudah, cepat, dan akurat.\n\n"
                . "Kami terus berbenah membangun Zona Integritas menuju Wilayah Bebas dari Korupsi dan Wilayah Birokrasi Bersih Melayani. Seluruh layanan tidak dipungut biaya. Apabila menemukan pelanggaran, sampaikan melalui saluran pengaduan resmi kami.",
            'nama' => 'Nama Kepala Rutan, S.H., M.H.',
            'jabatan' => 'Kepala Rumah Tahanan Negara Kelas IIB Pandeglang',
            'foto' => null,
        ]);

        Pengaturan::simpan('pengumuman', [
            'aktif' => true,
            'tingkat' => 'penting',
            'teks' => 'Layanan kunjungan tatap muka ditiadakan sementara pada Senin, 17 November 2026 karena kegiatan internal. Penitipan barang tetap dilayani.',
            'tautan' => '/layanan/jadwal-besuk',
            'label_tautan' => 'Lihat jadwal',
            'mulai' => now()->toDateString(),
            'selesai' => now()->addDays(14)->toDateString(),
        ]);
    }
}
