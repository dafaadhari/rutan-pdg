<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Halaman extends Model
{
    /**
     * Kategori halaman: slug route => label tampilan.
     */
    public const KATEGORI = [
        'tentang-kami' => 'Profil',
        'layanan' => 'Layanan Publik',
        'informasi-publik' => 'Informasi Publik',
    ];

    /**
     * Deskripsi singkat di kepala halaman tiap kategori.
     */
    public const DESKRIPSI_KATEGORI = [
        'tentang-kami' => 'Kedudukan, sejarah, visi misi, dan susunan organisasi Rumah Tahanan Negara Kelas IIB Pandeglang.',
        'layanan' => 'Informasi layanan kunjungan, penitipan barang, dan program integrasi bagi keluarga Warga Binaan.',
        'informasi-publik' => 'Dokumen perencanaan dan akuntabilitas kinerja Rumah Tahanan Negara Kelas IIB Pandeglang.',
    ];

    /**
     * Seksi yang menampilkan bagan dari data Struktur Organisasi (dikelola di admin).
     */
    public const SLUG_STRUKTUR = 'struktur-organisasi';

    protected $table = 'halamans';

    protected $fillable = [
        'kategori',
        'slug',
        'judul',
        'ringkasan',
        'ikon',
        'grup',
        'konten',
        'urutan',
        'tampil_di_beranda',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'urutan' => 'integer',
            'tampil_di_beranda' => 'boolean',
        ];
    }

    /**
     * Scope untuk mengambil halaman yang berstatus publikasi.
     */
    public function scopePublikasi($query)
    {
        return $query->where('status', 'publikasi');
    }

    /**
     * Scope untuk mengurutkan halaman sesuai nomor urut menu.
     */
    public function scopeUrut($query)
    {
        return $query->orderBy('urutan')->orderBy('id');
    }

    /**
     * URL publik halaman: seksi di halaman kategorinya (nama route = slug kategori).
     */
    public function getUrlAttribute(): string
    {
        return route($this->kategori) . '#' . $this->slug;
    }

    /**
     * Label kategori untuk tampilan.
     */
    public function getKategoriLabelAttribute(): string
    {
        return self::KATEGORI[$this->kategori] ?? $this->kategori;
    }
}
