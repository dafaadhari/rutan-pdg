<?php

namespace Database\Seeders;

use App\Models\Halaman;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class HalamanSeeder extends Seeder
{
    /**
     * Metadata halaman bawaan. Konten diambil dari
     * database/seeders/halaman/{kategori}/{slug}.html
     */
    protected array $halamans = [
        'tentang-kami' => [
            ['motto-dan-logo', 'Motto dan Logo', 'Identitas dan nilai-nilai fundamental Rumah Tahanan Negara Kelas IIB Pandeglang.', 'perisai'],
            ['sejarah', 'Sejarah', 'Perjalanan sejarah berdirinya Rumah Tahanan Negara Kelas IIB Pandeglang.', 'buku'],
            ['unit-pelaksana-teknis', 'Unit Pelaksana Teknis', 'Kedudukan Rutan Pandeglang sebagai Unit Pelaksana Teknis Pemasyarakatan.', 'gedung'],
            ['profil-organisasi', 'Profil Organisasi', 'Visi, misi, tugas pokok, dan fungsi institusi.', 'info'],
            ['profil-pejabat', 'Profil Pejabat', 'Pimpinan dan jajaran pejabat struktural Rumah Tahanan Negara Kelas IIB Pandeglang.', 'pengguna'],
            ['struktur-organisasi', 'Struktur Organisasi', 'Bagan susunan hirarki organisasi Rumah Tahanan Negara Kelas IIB Pandeglang.', 'grafik'],
            ['strategi-organisasi', 'Strategi Organisasi', 'Arah kebijakan dan strategi pencapaian sasaran organisasi.', 'ceklis'],
            ['kontak-kami', 'Kontak Kami', 'Saluran komunikasi, alamat, dan jam operasional pelayanan masyarakat.', 'telepon'],
        ],
        'layanan' => [
            ['jadwal-besuk', 'Jadwal Besuk', 'Informasi jam kunjungan tatap muka Warga Binaan beserta syarat pengunjung.', 'kalender', 'Kunjungan & WBP'],
            ['titipan-barang', 'Titipan Barang', 'SOP dan syarat penitipan barang & makanan untuk Warga Binaan.', 'paket', 'Kunjungan & WBP'],
            ['program-integrasi', 'Program Integrasi', 'Layanan pengurusan PB, CB, dan CMB resmi tanpa biaya.', 'pintu-keluar', 'Kunjungan & WBP'],
            ['permohonan-data-dan-informasi', 'Permohonan Data dan Informasi', 'Layanan PPID untuk permohonan data dan informasi publik.', 'dokumen', 'Informasi & Pengaduan'],
            ['media-massa', 'Media Massa', 'Rilis pers, konfirmasi pemberitaan, dan wawancara jurnalis resmi.', 'megafon', 'Informasi & Pengaduan'],
            ['simonev-bama', 'SIMONEV Bama Kemenimipas', 'Monitoring dan evaluasi penyelenggaraan makanan bagi Warga Binaan.', 'ceklis', 'Informasi & Pengaduan'],
            ['perizinan-penelitian', 'Perizinan Penelitian', 'Syarat dan mekanisme izin penelitian skripsi, tesis, dan riset akademis.', 'toga', 'Perizinan'],
            ['perizinan-magang', 'Perizinan Magang', 'Ketentuan dan prosedur pengajuan magang bagi siswa SMK dan mahasiswa.', 'koper', 'Perizinan'],
            ['perizinan-peliputan', 'Perizinan Peliputan', 'SOP dokumentasi visual, video, dan liputan berita di area rutan.', 'kamera', 'Perizinan'],
            ['pengaduan', 'Pengaduan', 'Saluran aspirasi, laporan pungli, gratifikasi, dan ketidakpuasan layanan.', 'chat', 'Informasi & Pengaduan'],
        ],
        'informasi-publik' => [
            ['lakip', 'LAKIP', 'Laporan pertanggungjawaban pencapaian target sasaran strategis dan anggaran tahunan.', 'dokumen'],
            ['dipa', 'DIPA', 'Transparansi alokasi pagu anggaran belanja dan program kerja tahun berjalan.', 'dokumen'],
            ['laporan-tahunan', 'Laporan Tahunan', 'Rekapitulasi capaian kinerja, pelayanan, dan kegiatan operasional setiap tahun.', 'buku'],
            ['laporan-keuangan', 'Laporan Keuangan', 'Realisasi anggaran dan pertanggungjawaban keuangan negara.', 'grafik'],
            ['rencana-strategis', 'Rencana Strategis', 'Dokumen perencanaan jangka menengah: visi, misi, tujuan, dan arah kebijakan.', 'ceklis'],
            ['iku', 'IKU (Indikator Kinerja Utama)', 'Tolok ukur pencapaian sasaran strategis sebagai dasar evaluasi kinerja.', 'grafik'],
            ['perjanjian-kinerja', 'Perjanjian Kinerja', 'Komitmen pencapaian target kinerja terukur pimpinan satuan kerja.', 'dokumen'],
            ['hasil-survei-spak-spkp', 'Hasil Survei SPAK/SPKP', 'Survei persepsi anti korupsi dan kepuasan pelayanan masyarakat.', 'grafik'],
        ],
    ];

    /**
     * Halaman yang ditandai "tampil di beranda" (highlight, maks. 4 per kategori).
     */
    protected array $beranda = [
        'layanan' => ['jadwal-besuk', 'titipan-barang', 'program-integrasi', 'pengaduan'],
        'informasi-publik' => ['lakip', 'dipa', 'laporan-keuangan', 'hasil-survei-spak-spkp'],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->halamans as $kategori => $items) {
            foreach ($items as $index => $item) {
                [$slug, $judul, $ringkasan, $ikon] = $item;

                Halaman::updateOrCreate(
                    ['kategori' => $kategori, 'slug' => $slug],
                    [
                        'judul' => $judul,
                        'ringkasan' => $ringkasan,
                        'ikon' => $ikon,
                        'grup' => $item[4] ?? null,
                        'konten' => File::get(database_path("seeders/halaman/{$kategori}/{$slug}.html")),
                        'urutan' => $index + 1,
                        'tampil_di_beranda' => in_array($slug, $this->beranda[$kategori] ?? [], true),
                        'status' => 'publikasi',
                    ]
                );
            }
        }
    }
}
