<?php

use App\Models\Halaman;
use App\Models\StrukturOrganisasi;
use App\Models\User;
use Database\Seeders\StrukturOrganisasiSeeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');
    $this->admin = User::factory()->create();
});

function jabatan(array $atribut = []): StrukturOrganisasi
{
    return StrukturOrganisasi::create(array_merge(['jabatan' => 'Kepala Rutan', 'urutan' => 1], $atribut));
}

it('mewajibkan login untuk mengelola struktur organisasi', function () {
    $this->get('/admin/struktur')->assertRedirect(route('login'));
    $this->post('/admin/struktur', ['jabatan' => 'X', 'urutan' => 1])->assertRedirect(route('login'));
});

it('menampilkan daftar jabatan bertingkat di admin', function () {
    $this->seed(StrukturOrganisasiSeeder::class);

    $this->actingAs($this->admin)->get('/admin/struktur')
        ->assertOk()
        ->assertSeeInOrder(['Kepala Rumah Tahanan Negara Kelas IIB Pandeglang', 'Kepala Kesatuan Pengamanan Rutan', 'Kepala Subseksi Pengelolaan'])
        ->assertSee('Nama belum diisi');

    $this->actingAs($this->admin)->get('/admin/struktur/create')->assertOk()->assertSee('Atasan langsung');
});

it('menambah jabatan dengan foto WebP potret 600x750', function () {
    $karutan = jabatan();

    $this->actingAs($this->admin)
        ->post('/admin/struktur', [
            'jabatan' => 'Kepala Subseksi Pengelolaan',
            'nama' => 'Budi Santoso, S.H.',
            'nip' => '19800101 200501 1 001',
            'parent_id' => $karutan->id,
            'urutan' => 1,
            'foto' => UploadedFile::fake()->image('foto.jpg', 1200, 1200),
        ])
        ->assertRedirect(route('admin.struktur.index'))
        ->assertSessionHasNoErrors();

    $baru = StrukturOrganisasi::firstWhere('nama', 'Budi Santoso, S.H.');
    expect($baru->parent_id)->toBe($karutan->id)
        ->and($baru->foto)->toEndWith('.webp');

    [$lebar, $tinggi] = getimagesize(Storage::disk('public')->path($baru->foto));
    expect([$lebar, $tinggi])->toBe([600, 750]);
});

it('mencegah atasan melingkar (diri sendiri atau bawahannya)', function () {
    $karutan = jabatan();
    $kasubsi = jabatan(['jabatan' => 'Kasubsi', 'parent_id' => $karutan->id]);
    $staf = jabatan(['jabatan' => 'Staf', 'parent_id' => $kasubsi->id]);

    foreach ([$karutan->id, $kasubsi->id, $staf->id] as $atasan) {
        $this->actingAs($this->admin)
            ->put("/admin/struktur/{$karutan->id}", ['jabatan' => 'Kepala Rutan', 'parent_id' => $atasan, 'urutan' => 1])
            ->assertSessionHasErrors('parent_id');
    }

    // Form ubah tidak menawarkan diri sendiri & bawahan sebagai atasan
    $this->actingAs($this->admin)->get("/admin/struktur/{$kasubsi->id}/edit")
        ->assertOk()
        ->assertDontSee('value="' . $staf->id . '"', false)
        ->assertSee('value="' . $karutan->id . '"', false);
});

it('menaikkan bawahan ke atasan saat jabatan dihapus', function () {
    $karutan = jabatan();
    $kasubsi = jabatan(['jabatan' => 'Kasubsi', 'parent_id' => $karutan->id]);
    $staf = jabatan(['jabatan' => 'Staf', 'parent_id' => $kasubsi->id]);

    $this->actingAs($this->admin)->delete("/admin/struktur/{$kasubsi->id}")->assertRedirect();

    expect(StrukturOrganisasi::find($kasubsi->id))->toBeNull()
        ->and($staf->refresh()->parent_id)->toBe($karutan->id);
});

it('menampilkan bagan di seksi Struktur Organisasi halaman Tentang Kami', function () {
    Halaman::create([
        'kategori' => 'tentang-kami', 'slug' => Halaman::SLUG_STRUKTUR, 'judul' => 'Struktur Organisasi',
        'konten' => '<p>Pengantar bagan.</p>', 'urutan' => 1, 'status' => 'publikasi',
    ]);
    $karutan = jabatan(['nama' => 'Ewang Catur Saputra']);
    jabatan(['jabatan' => 'Kepala Subseksi Pelayanan Tahanan', 'parent_id' => $karutan->id]);

    $this->get('/tentang-kami')
        ->assertOk()
        ->assertSee('class="bagan', false)
        ->assertSeeInOrder(['Pengantar bagan.', 'Ewang Catur Saputra', 'Kepala Subseksi Pelayanan Tahanan'])
        ->assertSee('Belum diisi');
});
