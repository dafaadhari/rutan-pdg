<?php

use App\Models\Pengaturan;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

function sambutan(array $atribut = []): void
{
    Pengaturan::simpan('sambutan', array_merge([
        'tampil' => true,
        'judul' => 'Melayani dengan integritas',
        'isi' => "Paragraf pertama sambutan.\n\nParagraf kedua sambutan.",
        'nama' => 'Nama Pimpinan Uji, S.H.',
        'jabatan' => 'Kepala Rumah Tahanan Negara Kelas IIB Pandeglang',
        'foto' => null,
    ], $atribut));
}

it('menampilkan sambutan pimpinan di beranda per paragraf', function () {
    sambutan();

    $this->get('/')
        ->assertOk()
        ->assertSee('id="sambutan"', false)
        ->assertSee('Nama Pimpinan Uji, S.H.')
        ->assertSee('<p>Paragraf pertama sambutan.</p>', false)
        ->assertSee('<p>Paragraf kedua sambutan.</p>', false);
});

it('menyembunyikan sambutan bila tidak ditampilkan', function () {
    sambutan(['tampil' => false]);

    $this->get('/')->assertOk()->assertDontSee('id="sambutan"', false);
});

it('mengolah foto pimpinan menjadi WebP potret 4:5', function () {
    Storage::fake('public');

    $this->actingAs(User::factory()->create())
        ->put('/admin/sambutan', [
            'tampil' => '1',
            'judul' => 'Judul baru',
            'isi' => 'Isi sambutan baru.',
            'nama' => 'Pimpinan Baru',
            'jabatan' => 'Kepala Rutan',
            'foto' => UploadedFile::fake()->image('foto.jpg', 1200, 1200),
        ])
        ->assertRedirect(route('admin.sambutan.edit'))
        ->assertSessionHasNoErrors();

    $data = Pengaturan::ambil('sambutan');
    expect($data['foto'])->toStartWith('pimpinan/')->toEndWith('.webp');

    $info = getimagesizefromstring(Storage::disk('public')->get($data['foto']));
    expect([$info[0], $info[1], $info['mime']])->toBe([800, 1000, 'image/webp']);

    $this->get('/')->assertSee('Pimpinan Baru')->assertSee(asset('storage/' . $data['foto']));
});

it('mewajibkan isi sambutan', function () {
    $this->actingAs(User::factory()->create())
        ->put('/admin/sambutan', ['judul' => '', 'isi' => '', 'nama' => '', 'jabatan' => ''])
        ->assertSessionHasErrors(['judul', 'isi', 'nama', 'jabatan']);
});
