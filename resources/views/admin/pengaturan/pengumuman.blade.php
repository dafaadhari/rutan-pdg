@extends('layouts.admin')

@section('title', 'Pengumuman')

@section('content')
@php
    $kelasLabel = 'block text-sm font-semibold text-navy-950';
    $kelasInput = 'mt-2 block w-full rounded-lg border bg-white px-3.5 py-2.5 text-sm text-navy-950 placeholder-gray-400 shadow-sm focus:border-emas-500 focus:outline-none focus:ring-2 focus:ring-emas-500/30';
    $batas = fn ($field) => $errors->has($field) ? 'border-red-500' : 'border-gray-300';
    $labelStatus = [
        'aktif' => ['Sedang tayang', 'bg-emerald-50 text-emerald-700 ring-emerald-200'],
        'terjadwal' => ['Terjadwal', 'bg-navy-50 text-navy-800 ring-navy-200'],
        'kedaluwarsa' => ['Kedaluwarsa', 'bg-amber-50 text-amber-800 ring-amber-200'],
        'nonaktif' => ['Nonaktif', 'bg-gray-100 text-gray-600 ring-gray-200'],
    ][$status];
    $nilai = fn ($kunci) => old($kunci, $pengumuman[$kunci] ?? null);
@endphp

<form action="{{ route('admin.pengumuman.update') }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        <div>
            <div class="flex items-center gap-3">
                <h1 class="text-2xl font-extrabold tracking-tight text-navy-950">Banner pengumuman</h1>
                <span class="rounded-full px-2.5 py-0.5 text-xs font-semibold ring-1 {{ $labelStatus[1] }}">{{ $labelStatus[0] }}</span>
            </div>
            <p class="mt-1 text-sm text-gray-600">Pengumuman penting yang tampil di bagian paling atas semua halaman portal.</p>
        </div>
        <button type="submit" class="self-start rounded-lg bg-emas-500 px-5 py-2.5 text-sm font-bold text-navy-950 shadow-sm hover:bg-emas-400 transition sm:self-auto">Simpan pengumuman</button>
    </div>

    <!-- Pratinjau -->
    <section aria-label="Pratinjau banner" class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <p class="border-b border-gray-200 px-4 py-2 text-xs font-semibold uppercase tracking-wider text-gray-500">Pratinjau (tersimpan)</p>
        @if($pengumuman['teks'])
            @include('partials.pengumuman', ['pengumuman' => $pengumuman, 'pratinjau' => true])
        @else
            <p class="px-4 py-4 text-sm text-gray-500">Belum ada teks pengumuman.</p>
        @endif
    </section>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <div class="xl:col-span-2 space-y-5 rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
            <label for="aktif" class="flex cursor-pointer items-start gap-3 rounded-xl border border-gray-200 bg-gray-50 p-4 hover:border-emas-500 transition">
                <input type="checkbox" name="aktif" id="aktif" value="1" @checked($nilai('aktif')) class="mt-0.5 h-4 w-4 rounded border-gray-300 accent-navy-900">
                <span>
                    <span class="block text-sm font-semibold text-navy-950">Tampilkan banner di portal</span>
                    <span class="block text-xs text-gray-500 mt-0.5">Banner hanya tayang selama tanggal berlaku di bawah. Pengunjung dapat menutupnya.</span>
                </span>
            </label>

            <div>
                <label for="teks" class="{{ $kelasLabel }}">Teks pengumuman</label>
                <textarea name="teks" id="teks" rows="3" maxlength="200" class="{{ $kelasInput }} {{ $batas('teks') }}"
                          placeholder="Contoh: Layanan kunjungan ditiadakan pada 17 Agustus 2026. Penitipan barang tetap dilayani.">{{ $nilai('teks') }}</textarea>
                @error('teks') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                <p class="mt-1.5 text-xs text-gray-500">Singkat & jelas, maksimal 200 karakter.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="tautan" class="{{ $kelasLabel }}">Tautan (opsional)</label>
                    <input type="text" name="tautan" id="tautan" value="{{ $nilai('tautan') }}" placeholder="/layanan/jadwal-besuk"
                           class="{{ $kelasInput }} {{ $batas('tautan') }} font-mono">
                    @error('tautan') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    <p class="mt-1.5 text-xs text-gray-500">Halaman portal diawali "/", situs lain diawali "https://".</p>
                </div>
                <div>
                    <label for="label_tautan" class="{{ $kelasLabel }}">Label tautan</label>
                    <input type="text" name="label_tautan" id="label_tautan" maxlength="30" value="{{ $nilai('label_tautan') }}" placeholder="Selengkapnya"
                           class="{{ $kelasInput }} {{ $batas('label_tautan') }}">
                    @error('label_tautan') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="space-y-5 rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
            <fieldset>
                <legend class="{{ $kelasLabel }}">Tingkat</legend>
                <div class="mt-2 space-y-2">
                    @foreach ([
                        'info' => ['Informasi', 'Navy — kabar umum', 'bg-navy-800'],
                        'penting' => ['Penting', 'Emas — perubahan layanan', 'bg-emas-400'],
                        'darurat' => ['Darurat', 'Merah — gangguan / keadaan mendesak', 'bg-red-600'],
                    ] as $kunci => [$judul, $ket, $warna])
                        <label class="flex cursor-pointer items-center gap-3 rounded-lg border border-gray-200 p-3 hover:bg-gray-50 has-[:checked]:border-navy-900 has-[:checked]:bg-navy-50">
                            <input type="radio" name="tingkat" value="{{ $kunci }}" @checked(($nilai('tingkat') ?? 'penting') === $kunci) class="h-4 w-4 accent-navy-900">
                            <span class="h-4 w-4 shrink-0 rounded {{ $warna }}" aria-hidden="true"></span>
                            <span class="text-sm"><span class="font-semibold text-navy-950">{{ $judul }}</span> <span class="text-gray-500">· {{ $ket }}</span></span>
                        </label>
                    @endforeach
                </div>
                @error('tingkat') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </fieldset>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label for="mulai" class="{{ $kelasLabel }}">Mulai</label>
                    <input type="date" name="mulai" id="mulai" value="{{ $nilai('mulai') }}" class="{{ $kelasInput }} {{ $batas('mulai') }}">
                    @error('mulai') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="selesai" class="{{ $kelasLabel }}">Berakhir</label>
                    <input type="date" name="selesai" id="selesai" value="{{ $nilai('selesai') }}" class="{{ $kelasInput }} {{ $batas('selesai') }}">
                    @error('selesai') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
            <p class="text-xs text-gray-500">Kosongkan tanggal bila tidak ada batas waktu.</p>
        </div>
    </div>
</form>
@endsection
