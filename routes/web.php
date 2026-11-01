<?php

use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\DasborController;
use App\Http\Controllers\Admin\HalamanController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaPublikController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rute Portal Publik (Tamu & Masyarakat)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/berita', [BeritaPublikController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaPublikController::class, 'show'])->name('berita.show');

// Halaman Statis & Informasi Publik Satker
Route::get('/tentang-kami/{slug?}', [PageController::class, 'tentangKami'])->name('tentang-kami');
Route::get('/layanan/{slug?}', [PageController::class, 'layanan'])->name('layanan');
Route::get('/informasi-publik/{slug?}', [PageController::class, 'informasiPublik'])->name('informasi-publik');


/*
|--------------------------------------------------------------------------
| Rute Autentikasi Admin (Guest Only)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/admin/login', [AuthController::class, 'login'])->name('login.post');
});


/*
|--------------------------------------------------------------------------
| Rute Panel Dasbor Admin (Protected by Auth Middleware)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DasborController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->withoutMiddleware('auth'); // Handled explicitly

    // Manajemen Berita (CRUD)
    Route::resource('berita', BeritaController::class)
        ->parameters(['berita' => 'berita'])
        ->except(['show']);

    // Pengaturan beranda: banner pengumuman & sambutan pimpinan
    Route::get('/pengumuman', [PengaturanController::class, 'editPengumuman'])->name('pengumuman.edit');
    Route::put('/pengumuman', [PengaturanController::class, 'updatePengumuman'])->name('pengumuman.update');
    Route::get('/sambutan', [PengaturanController::class, 'editSambutan'])->name('sambutan.edit');
    Route::put('/sambutan', [PengaturanController::class, 'updateSambutan'])->name('sambutan.update');

    // Manajemen Halaman (CRUD)
    Route::resource('halaman', HalamanController::class)
        ->parameters(['halaman' => 'halaman'])
        ->except(['show']);
});

// Logout endpoint global jika diakses via route('logout')
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
