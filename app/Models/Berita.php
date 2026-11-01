<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Berita extends Model
{
    use HasFactory;

    /**
     * Kategori berita: kunci => label tampilan.
     */
    public const KATEGORI = [
        'pengumuman' => 'Pengumuman',
        'kegiatan' => 'Kegiatan',
        'rilis-pers' => 'Rilis Pers',
    ];

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'konten',
        'gambar_sampul',
        'status',
    ];

    /**
     * Scope untuk mengambil berita yang berstatus publikasi.
     */
    public function scopePublikasi($query)
    {
        return $query->where('status', 'publikasi');
    }

    /**
     * Mengambil URL publik gambar sampul atau null jika tidak ada.
     */
    public function getGambarUrlAttribute(): ?string
    {
        if (!$this->gambar_sampul) {
            return null;
        }

        return Storage::disk('public')->url($this->gambar_sampul);
    }

    /**
     * Label kategori untuk tampilan.
     */
    public function getKategoriLabelAttribute(): string
    {
        return self::KATEGORI[$this->kategori] ?? 'Kegiatan';
    }
}
