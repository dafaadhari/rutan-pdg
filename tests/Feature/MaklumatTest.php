<?php

use App\Models\Pengaturan;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');
});

it('menampilkan teks maklumat bawaan bila foto belum diunggah', function () {
    $maklumat = (string) str($this->get('/')->assertOk()->getContent())->after('id="maklumat"')->before('</section>');

    expect($maklumat)
        ->toContain(e(config('rutan.maklumat.isi')))
        ->not->toContain('data-zoom=');
});

it('menyimpan foto maklumat utuh (tanpa dipotong) sebagai WebP', function () {
    $this->actingAs(User::factory()->create())
        ->put('/admin/maklumat', [
            'gambar' => UploadedFile::fake()->image('maklumat.jpg', 3000, 4000),
            'keterangan' => 'Ditetapkan Januari 2026',
        ])
        ->assertRedirect(route('admin.maklumat.edit'))
        ->assertSessionHasNoErrors();

    $data = Pengaturan::ambil('maklumat', Pengaturan::BAWAAN_MAKLUMAT);
    expect($data['gambar'])->toEndWith('.webp')
        ->and($data['keterangan'])->toBe('Ditetapkan Januari 2026');

    // Rasio 3:4 dipertahankan; sisi terpanjang diperkecil ke 2400 px
    [$lebar, $tinggi] = getimagesize(Storage::disk('public')->path($data['gambar']));
    expect([$lebar, $tinggi])->toBe([1800, 2400]);
});

it('menampilkan foto maklumat yang bisa diperbesar di beranda', function () {
    Pengaturan::simpan('maklumat', ['gambar' => 'maklumat/contoh.webp', 'keterangan' => 'Ditetapkan Januari 2026']);

    $maklumat = (string) str($this->get('/')->assertOk()->getContent())->after('id="maklumat"')->before('</section>');

    expect($maklumat)
        ->toContain('data-zoom="' . asset('storage/maklumat/contoh.webp') . '"')
        ->toContain('Klik untuk memperbesar')
        ->toContain('Ditetapkan Januari 2026')
        ->not->toContain(e(config('rutan.maklumat.isi')));
});

it('memvalidasi dan bisa menghapus foto maklumat', function () {
    $admin = User::factory()->create();

    $this->actingAs($admin)
        ->put('/admin/maklumat', ['gambar' => UploadedFile::fake()->image('kecil.jpg', 300, 300)])
        ->assertSessionHasErrors('gambar');

    $this->actingAs($admin)->put('/admin/maklumat', ['gambar' => UploadedFile::fake()->image('a.png', 1200, 1600)]);
    $lama = Pengaturan::ambil('maklumat')['gambar'];
    Storage::disk('public')->assertExists($lama);

    $this->actingAs($admin)->put('/admin/maklumat', ['hapus_gambar' => '1'])->assertSessionHasNoErrors();
    Storage::disk('public')->assertMissing($lama);
    expect(Pengaturan::ambil('maklumat')['gambar'])->toBeNull();
});
