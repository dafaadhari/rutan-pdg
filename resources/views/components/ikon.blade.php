@props(['nama' => null])
<svg {{ $attributes->merge(['class' => 'w-6 h-6']) }} fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="{{ \App\Support\Ikon::path($nama) }}"/>
</svg>
