{{-- Satu jabatan pada bagan organisasi beserta bawahannya (rekursif). --}}
@php $akar = $akar ?? false; @endphp
<li>
    <div class="bagan-kartu {{ $akar ? 'bagan-kartu-akar' : '' }}">
        @if($jabatan->foto)
            <img src="{{ asset('storage/' . $jabatan->foto) }}" alt="Foto {{ $jabatan->nama ?: $jabatan->jabatan }}"
                 class="h-14 w-14 shrink-0 rounded-full object-cover ring-2 {{ $akar ? 'ring-emas-400' : 'ring-gray-100' }}" loading="lazy">
        @else
            <span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full text-sm font-bold {{ $akar ? 'bg-emas-400 text-navy-950' : 'bg-navy-50 text-navy-700' }}" aria-hidden="true">
                {{ $jabatan->inisial }}
            </span>
        @endif
        <span class="min-w-0">
            @if($jabatan->nama)
                <span class="block text-sm font-bold leading-snug {{ $akar ? 'text-white' : 'text-navy-950' }}">{{ $jabatan->nama }}</span>
            @else
                <span class="block text-sm italic leading-snug {{ $akar ? 'text-navy-300' : 'text-gray-400' }}">Belum diisi</span>
            @endif
            <span class="mt-0.5 block text-xs leading-snug {{ $akar ? 'text-emas-300' : 'text-gray-600' }}">{{ $jabatan->jabatan }}</span>
            @if($jabatan->nip)
                <span class="mt-0.5 block text-[11px] tabular-nums {{ $akar ? 'text-navy-300' : 'text-gray-400' }}">NIP {{ $jabatan->nip }}</span>
            @endif
        </span>
    </div>

    @if($jabatan->bawahan->isNotEmpty())
        <ul>
            @foreach ($jabatan->bawahan as $bawahan)
                @include('partials.bagan-node', ['jabatan' => $bawahan, 'akar' => false])
            @endforeach
        </ul>
    @endif
</li>
