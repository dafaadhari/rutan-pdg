@extends('layouts.admin')

@section('title', 'Ubah Berita: ' . $berita->judul)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header Navigation -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.berita.index') }}" class="inline-flex items-center gap-1.5 text-xs text-gray-400 hover:text-amber-400 mb-2 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Daftar Berita
            </a>
            <h1 class="text-2xl font-bold text-white tracking-tight">Perbarui Berita</h1>
            <p class="text-sm text-gray-400 mt-1">Ubah rincian, status, atau berkas sampul artikel berita.</p>
        </div>
    </div>

    <!-- Edit Form Card -->
    <div class="bg-gray-900/80 border border-gray-800 rounded-2xl p-6 sm:p-8 shadow-xl">
        <form action="{{ route('admin.berita.update', $berita) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Judul Berita -->
            <div>
                <label for="judul" class="block text-xs font-semibold uppercase tracking-wider text-gray-300">
                    Judul Berita <span class="text-red-400">*</span>
                </label>
                <div class="mt-2">
                    <input type="text" name="judul" id="judul" required
                           value="{{ old('judul', $berita->judul) }}"
                           placeholder="Judul rilis berita..."
                           class="w-full px-4 py-2.5 bg-gray-850 border {{ $errors->has('judul') ? 'border-red-500' : 'border-gray-700' }} rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 text-sm transition">
                </div>
                @error('judul')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror

                <!-- Current Slug -->
                <div class="mt-2 text-xs text-gray-500 flex items-center gap-1 font-mono">
                    <span>URL Slug saat ini:</span>
                    <span id="slug-preview" class="text-amber-400/90 font-medium">/berita/{{ $berita->slug }}</span>
                </div>
            </div>

            <!-- Status & Sampul Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Status Publikasi -->
                <div>
                    <label for="status" class="block text-xs font-semibold uppercase tracking-wider text-gray-300">
                        Status Berita <span class="text-red-400">*</span>
                    </label>
                    <div class="mt-2">
                        <select name="status" id="status" required
                                class="w-full px-4 py-2.5 bg-gray-850 border {{ $errors->has('status') ? 'border-red-500' : 'border-gray-700' }} rounded-xl text-white focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 text-sm">
                            <option value="publikasi" {{ old('status', $berita->status) === 'publikasi' ? 'selected' : '' }}>
                                Publikasikan Sekarang
                            </option>
                            <option value="draft" {{ old('status', $berita->status) === 'draft' ? 'selected' : '' }}>
                                Simpan Sebagai Konsep (Draft)
                            </option>
                        </select>
                    </div>
                    @error('status')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Ganti Gambar Sampul -->
                <div>
                    <label for="gambar_sampul" class="block text-xs font-semibold uppercase tracking-wider text-gray-300">
                        Ganti Gambar Sampul
                    </label>
                    <div class="mt-2">
                        <input type="file" name="gambar_sampul" id="gambar_sampul" accept="image/jpeg,image/png,image/webp,image/jpg"
                               onchange="previewImage(this)"
                               class="w-full text-xs text-gray-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-gray-800 file:text-amber-400 hover:file:bg-gray-700 file:cursor-pointer border border-gray-700 rounded-xl bg-gray-850 focus:outline-none">
                    </div>
                    @error('gambar_sampul')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                    <p class="mt-1.5 text-xs text-gray-500">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                </div>
            </div>

            <!-- Existing Image & New Preview Box -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @if($berita->gambar_sampul)
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Sampul Saat Ini</label>
                        <div class="w-full h-44 rounded-xl overflow-hidden border border-gray-700 bg-gray-850">
                            <img src="{{ asset('storage/' . $berita->gambar_sampul) }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover">
                        </div>
                    </div>
                @endif

                <div id="image-preview-container" class="hidden">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-amber-400 mb-2">Pratinjau Sampul Baru</label>
                    <div class="w-full h-44 rounded-xl overflow-hidden border border-amber-500/50 bg-gray-850">
                        <img id="image-preview" src="#" alt="Sampul Baru" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            <!-- Konten Berita -->
            <div>
                <label for="konten" class="block text-xs font-semibold uppercase tracking-wider text-gray-300">
                    Isi Konten Berita <span class="text-red-400">*</span>
                </label>
                <div class="mt-2">
                    <textarea name="konten" id="konten" rows="12" required
                              class="w-full px-4 py-3 bg-gray-850 border {{ $errors->has('konten') ? 'border-red-500' : 'border-gray-700' }} rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 text-sm leading-relaxed transition">{{ old('konten', $berita->konten) }}</textarea>
                </div>
                @error('konten')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-800">
                <a href="{{ route('admin.berita.index') }}" 
                   class="px-4 py-2.5 text-sm font-medium text-gray-300 hover:text-white bg-gray-800 hover:bg-gray-700 rounded-xl transition">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 bg-amber-500 hover:bg-amber-400 text-gray-950 font-semibold text-sm rounded-xl shadow-lg shadow-amber-500/20 transition duration-150 active:scale-95">
                    Perbarui Berita
                </button>
            </div>
        </form>
    </div>

</div>

<script>
    const judulInput = document.getElementById('judul');
    const slugPreview = document.getElementById('slug-preview');

    function stringToSlug(str) {
        return str
            .toLowerCase()
            .trim()
            .replace(/[^\w\s-]/g, '')
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }

    judulInput.addEventListener('input', function() {
        const slug = stringToSlug(this.value);
        slugPreview.textContent = slug ? '/berita/' + slug : '/berita/...';
    });

    function previewImage(input) {
        const container = document.getElementById('image-preview-container');
        const preview = document.getElementById('image-preview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                container.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            container.classList.add('hidden');
        }
    }
</script>
@endsection
