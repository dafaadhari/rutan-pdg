<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;

/**
 * Pengolah gambar unggahan: potong tengah sesuai rasio, perkecil, dan simpan sebagai WebP.
 * Memakai ekstensi GD bawaan PHP (tanpa paket tambahan, aman untuk shared hosting).
 */
class Gambar
{
    public const KUALITAS_WEBP = 80;

    /**
     * Potong (center-crop) ke rasio lebar:tinggi, perkecil maksimal ke ukuran tersebut,
     * lalu simpan sebagai WebP di disk "public". Mengembalikan path relatif, mis. "berita/uuid.webp".
     */
    public static function potongDanSimpan(UploadedFile|string $sumber, string $folder, int $lebar, int $tinggi): string
    {
        $path = $sumber instanceof UploadedFile ? $sumber->getRealPath() : $sumber;
        $asli = self::baca($path);

        $lebarAsli = imagesx($asli);
        $tinggiAsli = imagesy($asli);

        // Area potong tengah dengan rasio target
        $rasio = $lebar / $tinggi;
        if ($lebarAsli / $tinggiAsli > $rasio) {
            $potongTinggi = $tinggiAsli;
            $potongLebar = (int) round($tinggiAsli * $rasio);
        } else {
            $potongLebar = $lebarAsli;
            $potongTinggi = (int) round($lebarAsli / $rasio);
        }
        $x = (int) floor(($lebarAsli - $potongLebar) / 2);
        $y = (int) floor(($tinggiAsli - $potongTinggi) / 2);

        // Jangan memperbesar gambar yang lebih kecil dari ukuran target
        $skala = min(1, $lebar / $potongLebar);
        $lebarAkhir = max(1, (int) round($potongLebar * $skala));
        $tinggiAkhir = max(1, (int) round($potongTinggi * $skala));

        $hasil = imagecreatetruecolor($lebarAkhir, $tinggiAkhir);
        imagefill($hasil, 0, 0, imagecolorallocate($hasil, 255, 255, 255));
        imagecopyresampled($hasil, $asli, 0, 0, $x, $y, $lebarAkhir, $tinggiAkhir, $potongLebar, $potongTinggi);

        ob_start();
        imagewebp($hasil, null, self::KUALITAS_WEBP);
        $data = ob_get_clean();

        imagedestroy($asli);
        imagedestroy($hasil);

        $tujuan = trim($folder, '/') . '/' . Str::uuid() . '.webp';
        Storage::disk('public')->put($tujuan, $data);

        return $tujuan;
    }

    /**
     * Baca berkas gambar (JPEG/PNG/WebP) menjadi resource GD, termasuk koreksi orientasi EXIF.
     */
    protected static function baca(string $path): \GdImage
    {
        $info = @getimagesize($path);
        if ($info === false) {
            throw new RuntimeException('Berkas bukan gambar yang valid.');
        }

        $gambar = match ($info[2]) {
            IMAGETYPE_JPEG => imagecreatefromjpeg($path),
            IMAGETYPE_PNG => imagecreatefrompng($path),
            IMAGETYPE_WEBP => imagecreatefromwebp($path),
            default => throw new RuntimeException('Format gambar tidak didukung.'),
        };

        // Foto dari ponsel sering menyimpan rotasi di EXIF
        if ($info[2] === IMAGETYPE_JPEG && function_exists('exif_read_data')) {
            $orientasi = @exif_read_data($path)['Orientation'] ?? 1;
            $gambar = match ($orientasi) {
                3 => imagerotate($gambar, 180, 0),
                6 => imagerotate($gambar, -90, 0),
                8 => imagerotate($gambar, 90, 0),
                default => $gambar,
            };
        }

        return $gambar;
    }

    /**
     * Hapus berkas di disk "public" bila ada.
     */
    public static function hapus(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
