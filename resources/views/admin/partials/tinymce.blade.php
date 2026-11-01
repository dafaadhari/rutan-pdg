{{--
    Editor konten TinyMCE (self-hosted via jsDelivr, lisensi GPL, tanpa API key).
    Pemakaian: @include('admin.partials.tinymce', ['selector' => '#konten'])
--}}
<script src="https://cdn.jsdelivr.net/npm/tinymce@7.6.1/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: @json($selector ?? '#konten'),
        license_key: 'gpl',
        skin: 'oxide',
        language: 'id',
        language_url: 'https://cdn.jsdelivr.net/npm/tinymce-i18n@24.12.30/langs7/id.js',
        menubar: false,
        branding: false,
        promotion: false,
        plugins: 'lists link table code autoresize',
        toolbar: 'undo redo | blocks | bold italic underline | bullist numlist | link table | alignleft aligncenter alignright | removeformat | code',
        block_formats: 'Paragraf=p; Judul 2=h2; Judul 3=h3; Judul 4=h4',
        min_height: 420,
        max_height: 900,
        autoresize_bottom_margin: 24,
        // Pertahankan kelas Tailwind & struktur div pada konten bawaan
        extended_valid_elements: '*[*]',
        valid_children: '+body[style]',
        verify_html: false,
        // Tanpa unggah gambar via XHR (sesuai batasan PRD)
        images_upload_handler: null,
        automatic_uploads: false,
        paste_data_images: false,
        // Pratinjau isi editor = tampilan publik
        content_css: @json(\Illuminate\Support\Facades\Vite::asset('resources/css/app.css')),
        body_class: 'konten-halaman',
        content_style: "body { background: #fff; color: #374151; font-family: 'Inter', sans-serif; padding: 1rem 1.25rem; margin: 0; }",
        link_default_target: '_blank',
        link_assume_external_targets: 'https',
        setup: function (editor) {
            // Simpan isi editor ke textarea sebelum form dikirim
            editor.on('change input', function () { editor.save(); });
        },
    });
</script>
