<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Pengaturan portal berbentuk key-value (nilai disimpan sebagai JSON).
 * Kunci yang dipakai: 'sambutan', 'pengumuman', 'maklumat'.
 */
class Pengaturan extends Model
{
    /**
     * Nilai bawaan sambutan pimpinan (beranda).
     */
    public const BAWAAN_SAMBUTAN = [
        'tampil' => false,
        'judul' => '',
        'isi' => '',
        'nama' => '',
        'jabatan' => 'Kepala Rumah Tahanan Negara Kelas IIB Pandeglang',
        'foto' => null,
    ];

    /**
     * Nilai bawaan pop-up pengumuman (tampil sekali bagi pengunjung yang baru masuk).
     */
    public const BAWAAN_PENGUMUMAN = [
        'aktif' => false,
        'tingkat' => 'penting',
        'judul' => '',
        'teks' => '',
        'tautan' => null,
        'label_tautan' => 'Selengkapnya',
        'mulai' => null,
        'selesai' => null,
    ];

    /**
     * Nilai bawaan foto Maklumat Pelayanan (beranda, bisa diperbesar).
     */
    public const BAWAAN_MAKLUMAT = [
        'gambar' => null,
        'keterangan' => '',
    ];

    /**
     * Tingkat pengumuman: kunci => label.
     */
    public const TINGKAT_PENGUMUMAN = [
        'info' => 'Informasi',
        'penting' => 'Penting',
        'darurat' => 'Darurat',
    ];

    /**
     * Kelas warna pop-up per tingkat: [garis aksen, lencana]. Dipakai pop-up publik & pratinjau admin.
     */
    public const GAYA_PENGUMUMAN = [
        'info' => ['bg-navy-800', 'bg-navy-100 text-navy-800'],
        'penting' => ['bg-emas-500', 'bg-emas-100 text-emas-800'],
        'darurat' => ['bg-red-600', 'bg-red-100 text-red-700'],
    ];

    protected $table = 'pengaturans';

    protected $fillable = ['kunci', 'nilai'];

    protected function casts(): array
    {
        return [
            'nilai' => 'array',
        ];
    }

    /**
     * Ambil nilai pengaturan digabung nilai bawaan, plus waktu terakhir diperbarui.
     */
    public static function ambil(string $kunci, array $bawaan = []): array
    {
        $baris = static::query()->where('kunci', $kunci)->first();

        return array_merge($bawaan, $baris?->nilai ?? [], [
            'diperbarui' => $baris?->updated_at,
        ]);
    }

    /**
     * Simpan (buat atau timpa) nilai pengaturan.
     */
    public static function simpan(string $kunci, array $nilai): self
    {
        return static::query()->updateOrCreate(['kunci' => $kunci], ['nilai' => $nilai]);
    }
}
