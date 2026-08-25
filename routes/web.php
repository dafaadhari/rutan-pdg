<?php

use Illuminate\Support\Facades\Route;

use App\Models\Berita;

Route::get('/', function () {
    $beritas = Berita::where('status', 'publikasi')->latest()->get();
    $beritaUtama = $beritas->first();
    $beritaLainnya = $beritas->slice(1);

    return view('welcome', compact('beritaUtama', 'beritaLainnya'));
});

Route::get('/berita/{slug}', function ($slug) {
    $berita = Berita::where('slug', $slug)->where('status', 'publikasi')->firstOrFail();
    $beritaTerbaru = Berita::where('status', 'publikasi')->where('id', '!=', $berita->id)->latest()->take(5)->get();

    return view('berita.show', compact('berita', 'beritaTerbaru'));
})->name('berita.show');
