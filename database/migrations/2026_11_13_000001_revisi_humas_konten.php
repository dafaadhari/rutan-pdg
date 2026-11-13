<?php

use Database\Seeders\HalamanSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Revisi Humas (November 2026):
 * - menghapus halaman layanan & informasi publik yang tidak lagi dipakai serta Profil Pejabat;
 * - Unit Pelaksana Teknis -> Profil (+ Tupoksi), Profil Organisasi -> Visi Misi;
 * - memperbarui konten Motto & Logo, Struktur Organisasi, Kontak Kami;
 * - menyelaraskan judul, ikon, urutan, dan highlight beranda dengan HalamanSeeder;
 * - kategori berita "Rilis Pers" dihapus (dipindah ke Kegiatan);
 * - akun pengelola tunggal bernama "Humas".
 */
return new class extends Migration
{
    public const DIHAPUS = [
        'tentang-kami' => ['profil-pejabat'],
        'layanan' => ['permohonan-data-dan-informasi', 'media-massa', 'simonev-bama', 'perizinan-penelitian', 'perizinan-magang', 'perizinan-peliputan', 'pengaduan'],
        'informasi-publik' => ['dipa', 'laporan-tahunan', 'laporan-keuangan'],
    ];

    public const GANTI_SLUG = [
        'unit-pelaksana-teknis' => 'profil',
        'profil-organisasi' => 'visi-misi',
    ];

    /** Halaman yang kontennya ditimpa dengan konten bawaan baru. */
    public const TIMPA_KONTEN = ['profil', 'visi-misi', 'motto-dan-logo', 'struktur-organisasi', 'kontak-kami'];

    public function up(): void
    {
        foreach (self::DIHAPUS as $kategori => $slugs) {
            DB::table('halamans')->where('kategori', $kategori)->whereIn('slug', $slugs)->delete();
        }

        foreach (self::GANTI_SLUG as $lama => $baru) {
            $sudahAda = DB::table('halamans')->where('kategori', 'tentang-kami')->where('slug', $baru)->exists();
            if (! $sudahAda) {
                DB::table('halamans')->where('kategori', 'tentang-kami')->where('slug', $lama)->update(['slug' => $baru]);
            }
        }

        foreach (self::TIMPA_KONTEN as $slug) {
            DB::table('halamans')->where('kategori', 'tentang-kami')->where('slug', $slug)
                ->update(['konten' => HalamanSeeder::konten('tentang-kami', $slug), 'updated_at' => now()]);
        }

        // Tautan "menu Pengaduan" di konten Titipan Barang tidak lagi berlaku
        DB::table('halamans')->where('kategori', 'layanan')->where('slug', 'titipan-barang')
            ->update(['konten' => DB::raw("REPLACE(konten, 'melalui menu Pengaduan.', 'melalui SP4N-LAPOR! atau WhatsApp Humas.')")]);

        foreach (HalamanSeeder::HALAMAN as $kategori => $items) {
            foreach ($items as $index => $item) {
                DB::table('halamans')->where('kategori', $kategori)->where('slug', $item[0])
                    ->update(HalamanSeeder::atribut($kategori, $index, $item));
            }
        }

        DB::table('beritas')->where('kategori', 'rilis-pers')->update(['kategori' => 'kegiatan']);

        if (DB::table('users')->count() === 1) {
            DB::table('users')->update(['name' => 'Humas']);
        }
    }

    public function down(): void
    {
        // Tidak dapat dikembalikan: halaman yang dihapus bisa dibuat ulang lewat admin bila diperlukan.
    }
};
