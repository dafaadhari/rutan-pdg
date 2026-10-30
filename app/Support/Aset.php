<?php

namespace App\Support;

/**
 * Slot aset gambar opsional di public/images/.
 * Jika file belum ada, method mengembalikan null dan tampilan memakai fallback.
 */
class Aset
{
    public const LOGO = 'images/logo.png';
    public const GEDUNG = 'images/gedung.jpg';
    public const OG_DEFAULT = 'images/og-default.jpg';

    /**
     * URL logo resmi (PNG transparan), atau null.
     */
    public static function logo(): ?string
    {
        return self::url(self::LOGO);
    }

    /**
     * URL foto gedung untuk latar hero beranda, atau null.
     */
    public static function gedung(): ?string
    {
        return self::url(self::GEDUNG);
    }

    /**
     * URL gambar bawaan untuk pratinjau tautan (OpenGraph), atau null.
     */
    public static function ogDefault(): ?string
    {
        return self::url(self::OG_DEFAULT) ?? self::logo();
    }

    protected static function url(string $path): ?string
    {
        return is_file(public_path($path)) ? asset($path) : null;
    }
}
