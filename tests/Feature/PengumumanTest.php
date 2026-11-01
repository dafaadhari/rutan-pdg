<?php

use App\Models\Pengaturan;
use App\Models\User;

function pengumuman(array $atribut = []): void
{
    Pengaturan::simpan('pengumuman', array_merge([
        'aktif' => true,
        'tingkat' => 'penting',
        'teks' => 'Kunjungan ditiadakan sementara karena kegiatan internal.',
        'tautan' => '/layanan/jadwal-besuk',
        'label_tautan' => 'Lihat jadwal',
        'mulai' => now()->subDay()->toDateString(),
        'selesai' => now()->addDay()->toDateString(),
    ], $atribut));
}

it('menampilkan banner pengumuman yang aktif dan masih berlaku', function () {
    pengumuman();

    $this->get('/berita')
        ->assertOk()
        ->assertSee('id="banner-pengumuman"', false)
        ->assertSee('Kunjungan ditiadakan sementara karena kegiatan internal.')
        ->assertSee(url('/layanan/jadwal-besuk'));
});

it('menyembunyikan banner yang nonaktif, kedaluwarsa, atau belum mulai', function (array $atribut) {
    pengumuman($atribut);

    $this->get('/berita')->assertOk()->assertDontSee('id="banner-pengumuman"', false);
})->with([
    'nonaktif' => [['aktif' => false]],
    'kedaluwarsa' => [['mulai' => now()->subDays(10)->toDateString(), 'selesai' => now()->subDay()->toDateString()]],
    'terjadwal' => [['mulai' => now()->addDays(2)->toDateString(), 'selesai' => now()->addDays(5)->toDateString()]],
]);

it('memungkinkan admin memperbarui banner pengumuman', function () {
    $this->actingAs(User::factory()->create())
        ->put('/admin/pengumuman', [
            'aktif' => '1',
            'tingkat' => 'darurat',
            'teks' => 'Layanan kunjungan dihentikan sementara.',
            'tautan' => '',
            'label_tautan' => '',
            'mulai' => now()->toDateString(),
            'selesai' => now()->addWeek()->toDateString(),
        ])
        ->assertRedirect(route('admin.pengumuman.edit'))
        ->assertSessionHasNoErrors();

    $data = Pengaturan::ambil('pengumuman');
    expect($data['tingkat'])->toBe('darurat')
        ->and($data['aktif'])->toBeTrue()
        ->and($data['label_tautan'])->toBe('Selengkapnya');

    $this->get('/berita')->assertSee('Layanan kunjungan dihentikan sementara.');
});

it('memvalidasi tanggal dan teks pengumuman', function () {
    $this->actingAs(User::factory()->create())
        ->put('/admin/pengumuman', [
            'aktif' => '1',
            'tingkat' => 'penting',
            'teks' => '',
            'tautan' => 'javascript:alert(1)',
            'mulai' => now()->toDateString(),
            'selesai' => now()->subDay()->toDateString(),
        ])
        ->assertSessionHasErrors(['teks', 'tautan', 'selesai']);
});

it('tidak menampilkan banner di halaman login admin', function () {
    pengumuman();

    $this->get('/admin/login')->assertOk()->assertDontSee('id="banner-pengumuman"', false);
});
