@extends('layouts.admin')

@section('title', 'Maklumat Pelayanan')

@section('content')
@php
    $kelasLabel = 'block text-sm font-semibold text-navy-950';
    $kelasInput = 'mt-2 block w-full rounded-lg border bg-white px-3.5 py-2.5 text-sm text-navy-950 placeholder-gray-400 shadow-sm focus:border-emas-500 focus:outline-none focus:ring-2 focus:ring-emas-500/30';
    $batas = fn ($field) => $errors->has($field) ? 'border-red-500' : 'border-gray-300';
    $gambarLama = $maklumat['gambar'] ? asset('storage/' . $maklumat['gambar']) : null;
@endphp

<form action="{{ route('admin.maklumat.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold tracking-tight text-navy-950">Maklumat Pelayanan</h1>
            <p class="mt-1 text-sm text-gray-600">Foto maklumat resmi yang tampil di beranda. Pengunjung dapat memperbesar dan menggesernya.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('home') }}#maklumat" target="_blank" rel="noopener" class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">Lihat di beranda <x-panah arah="serong" /></a>
            <button type="submit" class="rounded-lg bg-emas-500 px-5 py-2.5 text-sm font-bold text-navy-950 shadow-sm hover:bg-emas-400 transition">Simpan maklumat</button>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <!-- Pratinjau -->
        <div class="xl:col-span-2 rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
            <p class="{{ $kelasLabel }}">Pratinjau</p>
            <div class="mt-3 flex min-h-72 items-center justify-center overflow-hidden rounded-xl border border-gray-200 bg-gray-50">
                <img id="pratinjau-maklumat" src="{{ $gambarLama ?? '' }}" alt="Pratinjau maklumat" class="max-h-[36rem] w-full object-contain {{ $gambarLama ? '' : 'hidden' }}">
                <div id="kosong-maklumat" class="flex flex-col items-center gap-2 p-8 text-center text-gray-400 {{ $gambarLama ? 'hidden' : '' }}">
                    <x-ikon nama="dokumen" class="h-12 w-12" />
                    <span class="text-sm">Belum ada foto maklumat.</span>
                    <span class="max-w-sm text-xs">Selama kosong, beranda menampilkan teks maklumat bawaan:
                        &ldquo;{{ \Illuminate\Support\Str::limit($maklumatTeks['isi'], 90) }}&rdquo;</span>
                </div>
            </div>
        </div>

        <!-- Unggah -->
        <div class="space-y-5 rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
            <div>
                <label for="gambar" class="{{ $kelasLabel }}">Foto / scan maklumat</label>
                <input type="file" name="gambar" id="gambar" accept="image/jpeg,image/png,image/webp"
                       class="mt-3 block w-full text-xs text-gray-600 file:mr-3 file:rounded-lg file:border-0 file:bg-navy-900 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-white hover:file:bg-navy-800 file:cursor-pointer">
                @error('gambar') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                <p class="mt-2 text-xs leading-relaxed text-gray-500">JPG/PNG/WEBP, maks. 8 MB, minimal 600 × 600 px. Gambar <strong>tidak dipotong</strong>, hanya diperkecil (sisi terpanjang 2.400 px) dan dikompres ke WebP agar teks tetap tajam saat diperbesar.</p>

                @if($gambarLama)
                    <label class="mt-3 flex items-center gap-2 text-xs text-gray-600">
                        <input type="checkbox" name="hapus_gambar" value="1" class="h-4 w-4 rounded border-gray-300 accent-red-600">
                        Hapus foto saat ini (kembali ke teks bawaan)
                    </label>
                @endif
            </div>

            <div>
                <label for="keterangan" class="{{ $kelasLabel }}">Keterangan (opsional)</label>
                <input type="text" name="keterangan" id="keterangan" maxlength="160" value="{{ old('keterangan', $maklumat['keterangan']) }}"
                       placeholder="Contoh: Ditetapkan oleh Kepala Rutan, Januari 2026"
                       class="{{ $kelasInput }} {{ $batas('keterangan') }}">
                @error('keterangan') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
    document.getElementById('gambar').addEventListener('change', function () {
        if (!this.files || !this.files[0]) return;
        const pembaca = new FileReader();
        pembaca.onload = function (e) {
            const gambar = document.getElementById('pratinjau-maklumat');
            gambar.src = e.target.result;
            gambar.classList.remove('hidden');
            document.getElementById('kosong-maklumat').classList.add('hidden');
        };
        pembaca.readAsDataURL(this.files[0]);
    });
</script>
@endpush
@endsection
