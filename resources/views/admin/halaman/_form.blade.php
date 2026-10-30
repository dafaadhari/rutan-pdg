@php
    $inputClass = 'w-full px-4 py-2.5 bg-gray-850 border rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 text-sm transition';
    $labelClass = 'block text-xs font-semibold uppercase tracking-wider text-gray-300';
@endphp

<!-- Judul & Slug -->
<div>
    <label for="judul" class="{{ $labelClass }}">
        Judul Halaman <span class="text-red-400">*</span>
    </label>
    <div class="mt-2">
        <input type="text" name="judul" id="judul" required maxlength="255"
               value="{{ old('judul', $halaman->judul) }}"
               placeholder="Contoh: Jadwal Besuk"
               class="{{ $inputClass }} {{ $errors->has('judul') ? 'border-red-500' : 'border-gray-700' }}">
    </div>
    @error('judul')
        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
    @enderror
    <p class="mt-1.5 text-xs text-gray-500">Judul tampil di menu navbar, sidebar, dan kartu beranda.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Kategori -->
    <div>
        <label for="kategori" class="{{ $labelClass }}">
            Kategori <span class="text-red-400">*</span>
        </label>
        <div class="mt-2">
            <select name="kategori" id="kategori" required
                    class="{{ $inputClass }} {{ $errors->has('kategori') ? 'border-red-500' : 'border-gray-700' }}">
                @foreach (\App\Models\Halaman::KATEGORI as $nilai => $label)
                    <option value="{{ $nilai }}" {{ old('kategori', $halaman->kategori) === $nilai ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        @error('kategori')
            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <!-- Slug -->
    <div>
        <label for="slug" class="{{ $labelClass }}">Slug URL</label>
        <div class="mt-2">
            <input type="text" name="slug" id="slug" maxlength="255"
                   value="{{ old('slug', $halaman->slug) }}"
                   placeholder="otomatis dari judul"
                   class="{{ $inputClass }} font-mono {{ $errors->has('slug') ? 'border-red-500' : 'border-gray-700' }}">
        </div>
        @error('slug')
            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
        @enderror
        <div class="mt-1.5 text-xs text-gray-500 flex flex-wrap items-center gap-1 font-mono">
            <span>URL:</span>
            <span id="slug-preview" class="text-amber-400/90 font-medium break-all"></span>
        </div>
    </div>
</div>

<!-- Ringkasan -->
<div>
    <label for="ringkasan" class="{{ $labelClass }}">Ringkasan</label>
    <div class="mt-2">
        <textarea name="ringkasan" id="ringkasan" rows="2" maxlength="120" aria-describedby="ringkasan-bantuan ringkasan-hitung"
                  placeholder="Satu kalimat singkat yang menjelaskan isi halaman..."
                  class="{{ $inputClass }} {{ $errors->has('ringkasan') ? 'border-red-500' : 'border-gray-700' }}">{{ old('ringkasan', $halaman->ringkasan) }}</textarea>
    </div>
    @error('ringkasan')
        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
    @enderror
    <div class="mt-1.5 flex flex-wrap items-start justify-between gap-x-4 gap-y-1 text-xs">
        <p id="ringkasan-bantuan" class="text-gray-500">Tampil sebagai subjudul halaman dan deskripsi kartu di beranda. Ideal ≤ 75 karakter agar tidak terpotong.</p>
        <p id="ringkasan-hitung" class="shrink-0 font-mono text-gray-500" aria-live="polite"></p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Ikon -->
    <div>
        <label for="ikon" class="{{ $labelClass }}">Ikon</label>
        <div class="mt-2 flex items-center gap-3">
            <div class="w-11 h-11 shrink-0 rounded-xl bg-gray-800 border border-gray-700 text-amber-400 flex items-center justify-center">
                @foreach (\App\Support\Ikon::DAFTAR as $kunci => $ikon)
                    <x-ikon :nama="$kunci" data-ikon-preview="{{ $kunci }}" class="w-6 h-6 {{ old('ikon', $halaman->ikon) === $kunci ? '' : 'hidden' }}" />
                @endforeach
            </div>
            <select name="ikon" id="ikon"
                    class="{{ $inputClass }} min-w-0 {{ $errors->has('ikon') ? 'border-red-500' : 'border-gray-700' }}">
                @foreach (\App\Support\Ikon::DAFTAR as $kunci => $ikon)
                    <option value="{{ $kunci }}" {{ old('ikon', $halaman->ikon) === $kunci ? 'selected' : '' }}>{{ $ikon['label'] }}</option>
                @endforeach
            </select>
        </div>
        @error('ikon')
            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <!-- Grup -->
    <div>
        <label for="grup" class="{{ $labelClass }}">Grup Layanan</label>
        <div class="mt-2">
            <input type="text" name="grup" id="grup" maxlength="50" list="daftar-grup"
                   value="{{ old('grup', $halaman->grup) }}"
                   placeholder="Contoh: Perizinan"
                   class="{{ $inputClass }} {{ $errors->has('grup') ? 'border-red-500' : 'border-gray-700' }}">
            <datalist id="daftar-grup">
                @foreach ($daftarGrup as $grup)
                    <option value="{{ $grup }}">
                @endforeach
            </datalist>
        </div>
        @error('grup')
            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
        @enderror
        <p class="mt-1.5 text-xs text-gray-500">Menjadi tab filter di beranda.</p>
    </div>

    <!-- Urutan -->
    <div>
        <label for="urutan" class="{{ $labelClass }}">
            Nomor Urut <span class="text-red-400">*</span>
        </label>
        <div class="mt-2">
            <input type="number" name="urutan" id="urutan" required min="0" max="999"
                   value="{{ old('urutan', $halaman->urutan ?? 0) }}"
                   class="{{ $inputClass }} {{ $errors->has('urutan') ? 'border-red-500' : 'border-gray-700' }}">
        </div>
        @error('urutan')
            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
        @enderror
        <p class="mt-1.5 text-xs text-gray-500">Angka kecil tampil lebih dulu di menu.</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Status -->
    <div>
        <label for="status" class="{{ $labelClass }}">
            Status Halaman <span class="text-red-400">*</span>
        </label>
        <div class="mt-2">
            <select name="status" id="status" required
                    class="{{ $inputClass }} {{ $errors->has('status') ? 'border-red-500' : 'border-gray-700' }}">
                <option value="publikasi" {{ old('status', $halaman->status) === 'publikasi' ? 'selected' : '' }}>Publikasi (tampil di portal)</option>
                <option value="draft" {{ old('status', $halaman->status) === 'draft' ? 'selected' : '' }}>Draft (disembunyikan)</option>
            </select>
        </div>
        @error('status')
            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <!-- Tampil di Beranda (hanya Layanan & Informasi Publik) -->
    <div id="opsi-beranda" class="flex items-end {{ old('kategori', $halaman->kategori) === 'tentang-kami' ? 'hidden' : '' }}">
        <label for="tampil_di_beranda" class="flex items-start gap-3 w-full p-3.5 rounded-xl border border-gray-700 bg-gray-850 cursor-pointer hover:border-amber-500/60 transition">
            <input type="checkbox" name="tampil_di_beranda" id="tampil_di_beranda" value="1"
                   {{ old('tampil_di_beranda', $halaman->tampil_di_beranda) ? 'checked' : '' }}
                   class="mt-0.5 h-4 w-4 rounded border-gray-600 bg-gray-800 accent-amber-500">
            <span>
                <span class="block text-sm font-semibold text-white">Tampilkan di beranda</span>
                <span class="block text-xs text-gray-400 mt-0.5">Jadi highlight di beranda: kartu layanan atau dokumen Informasi Publik. Maks. {{ \App\Http\Controllers\HomeController::MAKS_HIGHLIGHT }} per kategori, sesuai nomor urut.</span>
            </span>
        </label>
    </div>
</div>

<!-- Konten -->
<div>
    <label for="konten" class="{{ $labelClass }}">
        Isi Konten Halaman <span class="text-red-400">*</span>
    </label>
    <div class="mt-2">
        <textarea name="konten" id="konten" rows="16"
                  class="{{ $inputClass }} font-mono {{ $errors->has('konten') ? 'border-red-500' : 'border-gray-700' }}">{{ old('konten', $halaman->konten) }}</textarea>
    </div>
    @error('konten')
        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
    @enderror
    <p class="mt-1.5 text-xs text-gray-500">Gunakan tombol <span class="font-mono text-gray-300">&lt;/&gt;</span> pada editor untuk menyunting kode HTML (tata letak kartu, tabel, dsb).</p>
</div>

@include('admin.partials.tinymce', ['selector' => '#konten'])

<script>
    (function () {
        const judul = document.getElementById('judul');
        const slug = document.getElementById('slug');
        const kategori = document.getElementById('kategori');
        const preview = document.getElementById('slug-preview');
        const ikon = document.getElementById('ikon');
        let slugManual = slug.value !== '';

        function stringToSlug(str) {
            return str
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
        }

        function perbaruiPreview() {
            const nilai = slug.value || stringToSlug(judul.value);
            preview.textContent = '/' + kategori.value + '/' + (nilai || '...');
        }

        judul.addEventListener('input', function () {
            if (!slugManual) slug.value = stringToSlug(this.value);
            perbaruiPreview();
        });
        slug.addEventListener('input', function () {
            slugManual = this.value !== '';
            perbaruiPreview();
        });
        kategori.addEventListener('change', function () {
            perbaruiPreview();
            // Highlight beranda hanya berlaku untuk Layanan & Informasi Publik
            document.getElementById('opsi-beranda').classList.toggle('hidden', kategori.value === 'tentang-kami');
        });

        ikon.addEventListener('change', function () {
            document.querySelectorAll('[data-ikon-preview]').forEach(function (el) {
                el.classList.toggle('hidden', el.dataset.ikonPreview !== ikon.value);
            });
        });

        // Penghitung karakter ringkasan: ideal ≤ 75 (muat 2 baris di kartu beranda), maks. 120
        const ringkasan = document.getElementById('ringkasan');
        const hitung = document.getElementById('ringkasan-hitung');
        function perbaruiHitung() {
            const panjang = ringkasan.value.length;
            const terlaluPanjang = panjang > 75;
            hitung.textContent = panjang + ' / 75' + (terlaluPanjang ? ' · mungkin terpotong di kartu' : '');
            hitung.classList.toggle('text-amber-400', terlaluPanjang);
            hitung.classList.toggle('text-gray-500', !terlaluPanjang);
        }
        ringkasan.addEventListener('input', perbaruiHitung);

        perbaruiPreview();
        perbaruiHitung();
    })();
</script>
