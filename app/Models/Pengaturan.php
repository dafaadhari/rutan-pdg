<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Pengaturan portal berbentuk key-value (nilai disimpan sebagai JSON).
 * Kunci yang dipakai: 'sambutan', 'pengumuman'.
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
     * Nilai bawaan banner pengumuman (semua halaman publik).
     */
    public const BAWAAN_PENGUMUMAN = [
        'aktif' => false,
        'tingkat' => 'penting',
        'teks' => '',
        'tautan' => null,
        'label_tautan' => 'Selengkapnya',
        'mulai' => null,
        'selesai' => null,
    ];

    /**
     * Tingkat pengumuman: kunci => label.
     */
    public const TINGKAT_PENGUMUMAN = [
        'info' => 'Informasi',
        'penting' => 'Penting',
        'darurat' => 'Darurat',
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
