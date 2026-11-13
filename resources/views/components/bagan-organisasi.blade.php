{{--
    Bagan struktur organisasi berjenjang (data: App\Models\StrukturOrganisasi::pohon()).
    Desktop: bagan dengan garis penghubung; HP: daftar bertingkat. Gaya di resources/css/app.css (.bagan).
--}}
@props(['pohon'])

@if($pohon->isEmpty())
    <p class="rounded-xl border border-dashed border-gray-300 bg-gray-50 p-6 text-center text-sm text-gray-500">
        Struktur organisasi belum diisi.
    </p>
@else
    <div {{ $attributes->class('bagan overflow-x-auto pb-2') }}>
        <ul>
            @foreach ($pohon as $jabatan)
                @include('partials.bagan-node', ['jabatan' => $jabatan, 'akar' => true])
            @endforeach
        </ul>
    </div>
@endif
