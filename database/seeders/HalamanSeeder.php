<?php

namespace Database\Seeders;

use App\Models\Halaman;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class HalamanSeeder extends Seeder
{
    /**
     * Metadata halaman bawaan: [slug, judul, ringkasan, ikon, grup?].
     * Konten diambil dari database/seeders/halaman/{kategori}/{slug}.html
     * Urutan dalam array = nomor urut menu & seksi.
     */
    public const HALAMAN = [
        'tentang-kami' => [
            ['profil', 'Profil', 'Kedudukan, tugas pokok, dan fungsi Rumah Tahanan Negara Kelas IIB Pandeglang.', 'gedung'],
            ['sejarah', 'Sejarah', 'Perjalanan sejarah berdirinya Rumah Tahanan Negara Kelas IIB Pandeglang.', 'buku'],
            ['visi-misi', 'Visi Misi', 'Visi dan misi Rumah Tahanan Negara Kelas IIB Pandeglang.', 'target'],
            ['motto-dan-logo', 'Motto dan Logo', 'Identitas dan nilai-nilai fundamental Rumah Tahanan Negara Kelas IIB Pandeglang.', 'bintang'],
            ['struktur-organisasi', 'Struktur Organisasi', 'Susunan jabatan dan pejabat Rumah Tahanan Negara Kelas IIB Pandeglang.', 'pengguna'],
            ['strategi-organisasi', 'Strategi Organisasi', 'Arah kebijakan dan strategi pencapaian sasaran organisasi.', 'ceklis'],
            ['kontak-kami', 'Kontak Kami', 'Alamat kantor dan saluran komunikasi resmi Rutan Pandeglang.', 'telepon'],
        ],
        'layanan' => [
            ['jadwal-besuk', 'Jadwal Besuk', 'Informasi jam kunjungan tatap muka Warga Binaan beserta syarat pengunjung.', 'kalender', 'Kunjungan & WBP'],
            ['titipan-barang', 'Titipan Barang', 'SOP dan syarat penitipan barang & makanan untuk Warga Binaan.', 'paket', 'Kunjungan & WBP'],
            ['program-integrasi', 'Program Integrasi', 'Layanan pengurusan PB, CB, dan CMB resmi tanpa biaya.', 'pintu-keluar', 'Kunjungan & WBP'],
        ],
        'informasi-publik' => [
            ['lakip', 'LAKIP', 'Laporan pertanggungjawaban pencapaian target sasaran strategis dan anggaran tahunan.', 'dokumen'],
            ['rencana-strategis', 'Rencana Strategis', 'Dokumen perencanaan jangka menengah: visi, misi, tujuan, dan arah kebijakan.', 'ceklis'],
            ['iku', 'IKU (Indikator Kinerja Utama)', 'Tolok ukur pencapaian sasaran strategis sebagai dasar evaluasi kinerja.', 'grafik'],
            ['perjanjian-kinerja', 'Perjanjian Kinerja', 'Komitmen pencapaian target kinerja terukur pimpinan satuan kerja.', 'dokumen'],
            ['hasil-survei-spak-spkp', 'Hasil Survei SPAK/SPKP', 'Survei persepsi anti korupsi dan kepuasan pelayanan masyarakat.', 'grafik'],
        ],
    ];

    /**
     * Halaman yang ditandai "tampil di beranda" (highlight, maks. 4 per kategori).
     */
    public const BERANDA = [
        'layanan' => ['jadwal-besuk', 'titipan-barang', 'program-integrasi'],
        'informasi-publik' => ['lakip', 'rencana-strategis', 'iku', 'hasil-survei-spak-spkp'],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::HALAMAN as $kategori => $items) {
            foreach ($items as $index => $item) {
                Halaman::updateOrCreate(
                    ['kategori' => $kategori, 'slug' => $item[0]],
                    self::atribut($kategori, $index, $item) + [
                        'konten' => self::konten($kategori, $item[0]),
                        'status' => 'publikasi',
                    ]
                );
            }
        }
    }

    /**
     * Atribut metadata (tanpa konten & status) untuk satu halaman bawaan.
     */
    public static function atribut(string $kategori, int $index, array $item): array
    {
        return [
            'judul' => $item[1],
            'ringkasan' => $item[2],
            'ikon' => $item[3],
            'grup' => $item[4] ?? null,
            'urutan' => $index + 1,
            'tampil_di_beranda' => in_array($item[0], self::BERANDA[$kategori] ?? [], true),
        ];
    }

    /**
     * Konten HTML bawaan sebuah halaman.
     */
    public static function konten(string $kategori, string $slug): string
    {
        return File::get(database_path("seeders/halaman/{$kategori}/{$slug}.html"));
    }
}
