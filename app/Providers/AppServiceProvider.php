<?php

namespace App\Providers;

use App\Http\Controllers\HomeController;
use App\Models\Halaman;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Tanggal selalu berbahasa Indonesia (mis. "Selasa, 25 Agustus 2026"), apa pun isi .env
        Carbon::setLocale('id');

        // Kontak resmi untuk topbar, footer, dan kotak pengaduan
        View::composer(['partials.navbar', 'partials.footer', 'layouts.page'], function ($view) {
            $view->with('kontak', config('rutan.kontak'));
        });

        // Menu dropdown navbar dibangun dari halaman berstatus publikasi
        View::composer('partials.navbar', function ($view) {
            $view->with('menuHalaman', Halaman::publikasi()
                ->urut()
                ->get(['id', 'kategori', 'slug', 'judul', 'ikon'])
                ->groupBy('kategori'));
        });

        // Jadwal kunjungan untuk kolom footer
        View::composer('partials.footer', function ($view) {
            $view->with([
                'jadwalKunjungan' => config('rutan.jadwal_kunjungan'),
                'namaHari' => config('rutan.nama_hari'),
            ]);
        });

        // Tautan layanan di footer = highlight layanan beranda
        View::composer('partials.footer', function ($view) {
            $view->with('layananFooter', Halaman::publikasi()
                ->where('kategori', 'layanan')
                ->where('tampil_di_beranda', true)
                ->urut()
                ->take(HomeController::MAKS_HIGHLIGHT)
                ->get(['id', 'kategori', 'slug', 'judul']));
        });
    }
}
