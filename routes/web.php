<?php

use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Models\Berita;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rute Portal Publik (Tamu & Masyarakat)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $beritas = Berita::publikasi()->latest()->get();
    $beritaUtama = $beritas->first();
    $beritaLainnya = $beritas->slice(1, 3); // Ambil 3 berita sampingan

    return view('welcome', compact('beritaUtama', 'beritaLainnya'));
})->name('home');

Route::get('/berita/{slug}', function ($slug) {
    $berita = Berita::where('slug', $slug)->publikasi()->firstOrFail();
    $beritaTerbaru = Berita::publikasi()
        ->where('id', '!=', $berita->id)
        ->latest()
        ->take(4)
        ->get();

    return view('berita.show', compact('berita', 'beritaTerbaru'));
})->name('berita.show');

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
    Route::redirect('/', '/admin/berita');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->withoutMiddleware('auth'); // Handled explicitly

    // Manajemen Berita (CRUD)
    Route::resource('berita', BeritaController::class)
        ->parameters(['berita' => 'berita'])
        ->except(['show']);
});

// Logout endpoint global jika diakses via route('logout')
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
