@extends('layouts.admin')

@section('title', 'Sambutan Pimpinan')

@section('content')
@php
    $kelasLabel = 'block text-sm font-semibold text-navy-950';
    $kelasInput = 'mt-2 block w-full rounded-lg border bg-white px-3.5 py-2.5 text-sm text-navy-950 placeholder-gray-400 shadow-sm focus:border-emas-500 focus:outline-none focus:ring-2 focus:ring-emas-500/30';
    $batas = fn ($field) => $errors->has($field) ? 'border-red-500' : 'border-gray-300';
    $nilai = fn ($kunci) => old($kunci, $sambutan[$kunci] ?? null);
    $fotoLama = $sambutan['foto'] ? asset('storage/' . $sambutan['foto']) : null;
@endphp

<form action="{{ route('admin.sambutan.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold tracking-tight text-navy-950">Sambutan Kepala Rutan</h1>
            <p class="mt-1 text-sm text-gray-600">Tampil di beranda, setelah seksi berita terkini.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('home') }}#sambutan" target="_blank" rel="noopener" class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">Lihat di beranda <x-panah arah="serong" /></a>
            <button type="submit" class="rounded-lg bg-emas-500 px-5 py-2.5 text-sm font-bold text-navy-950 shadow-sm hover:bg-emas-400 transition">Simpan sambutan</button>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <!-- Teks -->
        <div class="xl:col-span-2 space-y-5 rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
            <label for="tampil" class="flex cursor-pointer items-start gap-3 rounded-xl border border-gray-200 bg-gray-50 p-4 hover:border-emas-500 transition">
                <input type="checkbox" name="tampil" id="tampil" value="1" @checked($nilai('tampil')) class="mt-0.5 h-4 w-4 rounded border-gray-300 accent-navy-900">
                <span>
                    <span class="block text-sm font-semibold text-navy-950">Tampilkan sambutan di beranda</span>
                    <span class="block text-xs text-gray-500 mt-0.5">Matikan sementara bila sedang pergantian pimpinan.</span>
                </span>
            </label>

            <div>
                <label for="judul" class="{{ $kelasLabel }}">Judul / kutipan utama <span class="text-red-600">*</span></label>
                <input type="text" name="judul" id="judul" maxlength="120" value="{{ $nilai('judul') }}" placeholder="Contoh: Melayani dengan integritas, membina dengan hati"
                       class="{{ $kelasInput }} {{ $batas('judul') }}">
                @error('judul') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="isi" class="{{ $kelasLabel }}">Isi sambutan <span class="text-red-600">*</span></label>
                <textarea name="isi" id="isi" rows="9" maxlength="2000" class="{{ $kelasInput }} {{ $batas('isi') }} leading-relaxed">{{ $nilai('isi') }}</textarea>
                @error('isi') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                <p class="mt-1.5 text-xs text-gray-500">Pisahkan paragraf dengan baris kosong. Ideal 2–3 paragraf singkat (maks. 2.000 karakter).</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="nama" class="{{ $kelasLabel }}">Nama & gelar <span class="text-red-600">*</span></label>
                    <input type="text" name="nama" id="nama" maxlength="120" value="{{ $nilai('nama') }}" class="{{ $kelasInput }} {{ $batas('nama') }}">
                    @error('nama') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="jabatan" class="{{ $kelasLabel }}">Jabatan <span class="text-red-600">*</span></label>
                    <input type="text" name="jabatan" id="jabatan" maxlength="120" value="{{ $nilai('jabatan') }}" class="{{ $kelasInput }} {{ $batas('jabatan') }}">
                    @error('jabatan') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- Foto -->
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
            <p class="{{ $kelasLabel }}">Foto resmi</p>
            <div class="mx-auto mt-3 aspect-[4/5] w-full max-w-60 overflow-hidden rounded-xl border border-gray-200 bg-navy-950">
                <img id="pratinjau-foto" src="{{ $fotoLama ?? '' }}" alt="Pratinjau foto" class="h-full w-full object-cover {{ $fotoLama ? '' : 'hidden' }}">
                <div id="kosong-foto" class="flex h-full flex-col items-center justify-center gap-2 text-navy-300 {{ $fotoLama ? 'hidden' : '' }}">
                    <x-ikon nama="pengguna" class="w-12 h-12" />
                    <span class="text-xs">Belum ada foto</span>
                </div>
            </div>

            <label for="foto" class="sr-only">Unggah foto</label>
            <input type="file" name="foto" id="foto" accept="image/jpeg,image/png,image/webp"
                   class="mt-4 block w-full text-xs text-gray-600 file:mr-3 file:rounded-lg file:border-0 file:bg-navy-900 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-white hover:file:bg-navy-800 file:cursor-pointer">
            @error('foto') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            <p class="mt-2 text-xs leading-relaxed text-gray-500">Foto formal, latar polos. Otomatis dipotong potret 4:5 dan dikompres ke WebP (maks. 5 MB).</p>

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
@endsection
