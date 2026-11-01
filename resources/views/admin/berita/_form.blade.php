{{-- Form berita (dipakai create & edit). $berita null saat membuat berita baru. --}}
@php
    $berita = $berita ?? null;
    $kelasLabel = 'block text-sm font-semibold text-navy-950';
    $kelasInput = 'mt-2 block w-full rounded-lg border bg-white px-3.5 py-2.5 text-sm text-navy-950 placeholder-gray-400 shadow-sm focus:border-emas-500 focus:outline-none focus:ring-2 focus:ring-emas-500/30';
    $batas = fn ($field) => $errors->has($field) ? 'border-red-500' : 'border-gray-300';
    $sampulLama = $berita?->gambar_sampul ? asset('storage/' . $berita->gambar_sampul) : null;
@endphp

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
    <!-- Kolom utama -->
    <div class="xl:col-span-2 space-y-6 rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
        <div>
            <label for="judul" class="{{ $kelasLabel }}">Judul berita <span class="text-red-600">*</span></label>
            <input type="text" name="judul" id="judul" required maxlength="255"
                   value="{{ old('judul', $berita?->judul) }}"
                   placeholder="Contoh: Rutan Pandeglang Gelar Pelatihan Kemandirian Bidang Pertanian"
                   class="{{ $kelasInput }} {{ $batas('judul') }}">
            @error('judul') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            <p class="mt-1.5 flex flex-wrap items-center gap-1 font-mono text-xs text-gray-500">
                URL: <span id="slug-preview" class="break-all font-medium text-emas-700">/berita/{{ $berita?->slug ?? '...' }}</span>
            </p>
        </div>

        <div>
            <label for="konten" class="{{ $kelasLabel }}">Isi berita <span class="text-red-600">*</span></label>
            <div class="mt-2">
                <textarea name="konten" id="konten" rows="14"
                          class="{{ $kelasInput }} {{ $batas('konten') }}">{{ old('konten', $berita?->konten) }}</textarea>
            </div>
            @error('konten') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            <p class="mt-1.5 text-xs text-gray-500">Gunakan menu "Paragraf/Judul" pada editor agar struktur berita mudah dibaca.</p>
        </div>
    </div>

    <!-- Kolom samping -->
    <div class="space-y-6">
        <div class="space-y-5 rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
            <div>
                <label for="kategori" class="{{ $kelasLabel }}">Kategori <span class="text-red-600">*</span></label>
                <select name="kategori" id="kategori" required class="{{ $kelasInput }} {{ $batas('kategori') }}">
                    @foreach (\App\Models\Berita::KATEGORI as $nilai => $label)
                        <option value="{{ $nilai }}" @selected(old('kategori', $berita?->kategori ?? 'kegiatan') === $nilai)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('kategori') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="status" class="{{ $kelasLabel }}">Status <span class="text-red-600">*</span></label>
                <select name="status" id="status" required class="{{ $kelasInput }} {{ $batas('status') }}">
                    <option value="publikasi" @selected(old('status', $berita?->status ?? 'publikasi') === 'publikasi')>Publikasi (langsung tampil)</option>
                    <option value="draft" @selected(old('status', $berita?->status) === 'draft')>Draft (disimpan dulu)</option>
                </select>
                @error('status') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Sampul -->
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
            <label for="gambar_sampul" class="{{ $kelasLabel }}">
                Gambar sampul @unless($sampulLama)<span class="text-red-600">*</span>@endunless
            </label>

            <div class="mt-3 aspect-video overflow-hidden rounded-xl border border-gray-200 bg-gray-50">
                <img id="pratinjau-sampul" src="{{ $sampulLama ?? '' }}" alt="Pratinjau sampul"
                     class="h-full w-full object-cover {{ $sampulLama ? '' : 'hidden' }}">
                <div id="kosong-sampul" class="flex h-full flex-col items-center justify-center gap-1 text-center text-xs text-gray-500 {{ $sampulLama ? 'hidden' : '' }}">
                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Pratinjau sampul 16:9
                </div>
            </div>

            <input type="file" name="gambar_sampul" id="gambar_sampul" accept="image/jpeg,image/png,image/webp"
                   @unless($sampulLama) required @endunless
                   class="mt-3 block w-full text-xs text-gray-600 file:mr-3 file:rounded-lg file:border-0 file:bg-navy-900 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-white hover:file:bg-navy-800 file:cursor-pointer">
            @error('gambar_sampul') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            <p class="mt-2 text-xs leading-relaxed text-gray-500">
                JPG/PNG/WEBP, maks. 5 MB, minimal 800×450 px. Gambar otomatis <strong class="text-gray-700">dipotong 16:9</strong> dan <strong class="text-gray-700">dikompres ke WebP</strong>.
                @if($sampulLama) Kosongkan bila tidak ingin mengganti. @endif
            </p>
        </div>
    </div>
</div>

@include('admin.partials.tinymce', ['selector' => '#konten'])

@push('scripts')
<script>
    (function () {
        // Pratinjau slug
        const judul = document.getElementById('judul');
        const slug = document.getElementById('slug-preview');
        judul.addEventListener('input', function () {
            const nilai = this.value.toLowerCase().trim()
                .replace(/[^\w\s-]/g, '').replace(/[\s_-]+/g, '-').replace(/^-+|-+$/g, '');
            slug.textContent = '/berita/' + (nilai || '...');
        });

        // Pratinjau sampul (dipotong 16:9 seperti hasil akhir)
        const input = document.getElementById('gambar_sampul');
        const gambar = document.getElementById('pratinjau-sampul');
        const kosong = document.getElementById('kosong-sampul');
        input.addEventListener('change', function () {
            if (!this.files || !this.files[0]) return;
            const pembaca = new FileReader();
            pembaca.onload = function (e) {
                gambar.src = e.target.result;
                gambar.classList.remove('hidden');
                kosong.classList.add('hidden');
            };
            pembaca.readAsDataURL(this.files[0]);
        });
    })();
</script>
@endpush
