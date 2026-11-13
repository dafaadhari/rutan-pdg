{{-- Form jabatan struktur organisasi. Data: $jabatan, $opsiAtasan, $aksi, $metode, $labelSimpan --}}
@php
    $kelasLabel = 'block text-sm font-semibold text-navy-950';
    $kelasInput = 'mt-2 block w-full rounded-lg border bg-white px-3.5 py-2.5 text-sm text-navy-950 placeholder-gray-400 shadow-sm focus:border-emas-500 focus:outline-none focus:ring-2 focus:ring-emas-500/30';
    $batas = fn ($field) => $errors->has($field) ? 'border-red-500' : 'border-gray-300';
    $fotoLama = $jabatan->foto ? asset('storage/' . $jabatan->foto) : null;
    $atasanTerpilih = (string) old('parent_id', $jabatan->parent_id);
@endphp

<form action="{{ $aksi }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @if($metode !== 'POST') @method($metode) @endif

    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        <div>
            <a href="{{ route('admin.struktur.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-navy-950"><x-panah arah="kiri" /> Struktur organisasi</a>
            <h1 class="mt-2 text-2xl font-extrabold tracking-tight text-navy-950">{{ $judulForm }}</h1>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.struktur.index') }}" class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">Batal</a>
            <button type="submit" class="rounded-lg bg-emas-500 px-5 py-2.5 text-sm font-bold text-navy-950 shadow-sm hover:bg-emas-400 transition">{{ $labelSimpan }}</button>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <div class="xl:col-span-2 space-y-5 rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
            <div>
                <label for="jabatan" class="{{ $kelasLabel }}">Nama jabatan <span class="text-red-600">*</span></label>
                <input type="text" name="jabatan" id="jabatan" maxlength="150" required value="{{ old('jabatan', $jabatan->jabatan) }}"
                       placeholder="Contoh: Kepala Subseksi Pelayanan Tahanan" class="{{ $kelasInput }} {{ $batas('jabatan') }}">
                @error('jabatan') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="nama" class="{{ $kelasLabel }}">Nama pejabat & gelar</label>
                    <input type="text" name="nama" id="nama" maxlength="150" value="{{ old('nama', $jabatan->nama) }}"
                           class="{{ $kelasInput }} {{ $batas('nama') }}">
                    @error('nama') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    <p class="mt-1.5 text-xs text-gray-500">Kosongkan bila jabatan sedang lowong.</p>
                </div>
                <div>
                    <label for="nip" class="{{ $kelasLabel }}">NIP</label>
                    <input type="text" name="nip" id="nip" maxlength="30" inputmode="numeric" value="{{ old('nip', $jabatan->nip) }}"
                           class="{{ $kelasInput }} {{ $batas('nip') }} font-mono">
                    @error('nip') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div class="sm:col-span-2">
                    <label for="parent_id" class="{{ $kelasLabel }}">Atasan langsung</label>
                    <select name="parent_id" id="parent_id" class="{{ $kelasInput }} {{ $batas('parent_id') }}">
                        <option value="">— Tidak ada (pimpinan tertinggi) —</option>
                        @foreach ($opsiAtasan as ['jabatan' => $opsi, 'kedalaman' => $kedalaman])
                            <option value="{{ $opsi->id }}" @selected($atasanTerpilih === (string) $opsi->id)>
                                {{ str_repeat('— ', $kedalaman) }}{{ $opsi->jabatan }}{{ $opsi->nama ? ' (' . $opsi->nama . ')' : '' }}
                            </option>
                        @endforeach
                    </select>
                    @error('parent_id') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="urutan" class="{{ $kelasLabel }}">Nomor urut <span class="text-red-600">*</span></label>
                    <input type="number" name="urutan" id="urutan" min="1" max="999" required value="{{ old('urutan', $jabatan->urutan ?? 1) }}"
                           class="{{ $kelasInput }} {{ $batas('urutan') }}">
                    @error('urutan') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    <p class="mt-1.5 text-xs text-gray-500">Urutan di antara jabatan setingkat (kiri ke kanan).</p>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
            <p class="{{ $kelasLabel }}">Foto pejabat</p>
            <div class="mx-auto mt-3 aspect-[4/5] w-full max-w-48 overflow-hidden rounded-xl border border-gray-200 bg-navy-950">
                <img id="pratinjau-foto" src="{{ $fotoLama ?? '' }}" alt="Pratinjau foto" class="h-full w-full object-cover {{ $fotoLama ? '' : 'hidden' }}">
                <div id="kosong-foto" class="flex h-full flex-col items-center justify-center gap-2 text-navy-300 {{ $fotoLama ? 'hidden' : '' }}">
                    <x-ikon nama="pengguna" class="h-12 w-12" />
                    <span class="text-xs">Belum ada foto</span>
                </div>
            </div>

            <label for="foto" class="sr-only">Unggah foto</label>
            <input type="file" name="foto" id="foto" accept="image/jpeg,image/png,image/webp"
                   class="mt-4 block w-full text-xs text-gray-600 file:mr-3 file:rounded-lg file:border-0 file:bg-navy-900 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-white hover:file:bg-navy-800 file:cursor-pointer">
            @error('foto') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            <p class="mt-2 text-xs leading-relaxed text-gray-500">Opsional. Foto formal, otomatis dipotong potret 4:5 dan dikompres ke WebP (maks. 5 MB).</p>

            @if($fotoLama)
                <label class="mt-3 flex items-center gap-2 text-xs text-gray-600">
                    <input type="checkbox" name="hapus_foto" value="1" class="h-4 w-4 rounded border-gray-300 accent-red-600">
                    Hapus foto saat ini
                </label>
            @endif
        </div>
    </div>
</form>

@push('scripts')
<script>
    document.getElementById('foto').addEventListener('change', function () {
        if (!this.files || !this.files[0]) return;
        const pembaca = new FileReader();
        pembaca.onload = function (e) {
            const gambar = document.getElementById('pratinjau-foto');
            gambar.src = e.target.result;
            gambar.classList.remove('hidden');
            document.getElementById('kosong-foto').classList.add('hidden');
        };
        pembaca.readAsDataURL(this.files[0]);
    });
</script>
@endpush
