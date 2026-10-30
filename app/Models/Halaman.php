<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Halaman extends Model
{
    /**
     * Kategori halaman: slug route => label tampilan.
     */
    public const KATEGORI = [
        'tentang-kami' => 'Tentang Kami',
        'layanan' => 'Layanan Publik',
        'informasi-publik' => 'Informasi Publik',
    ];

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
     * URL publik halaman (nama route = slug kategori).
     */
    public function getUrlAttribute(): string
    {
        return route($this->kategori, $this->slug);
    }

    /**
     * Label kategori untuk tampilan.
     */
    public function getKategoriLabelAttribute(): string
    {
        return self::KATEGORI[$this->kategori] ?? $this->kategori;
    }
}
