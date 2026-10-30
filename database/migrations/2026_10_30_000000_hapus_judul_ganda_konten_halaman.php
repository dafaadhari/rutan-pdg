<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Menghapus blok judul + subjudul di awal konten halaman bawaan, karena
 * judul dan ringkasan sudah tampil di header halaman (judul ganda).
 * Hanya konten yang diawali blok tersebut yang diubah; konten lain aman.
 */
return new class extends Migration
{
    public const POLA = '/^(\s*<div[^>]*>\s*)<div class="border-b border-gray-150 pb-4">.*?<\/div>\s*/s';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('halamans')->orderBy('id')->each(function ($halaman) {
            $konten = preg_replace(self::POLA, '$1', $halaman->konten, 1, $jumlah);

            if ($jumlah === 1) {
                DB::table('halamans')->where('id', $halaman->id)->update(['konten' => $konten]);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tidak dapat dikembalikan: judul lama bisa ditulis ulang lewat editor admin bila diperlukan.
    }
};
