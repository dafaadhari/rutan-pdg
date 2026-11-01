@props(['arah' => 'kanan'])
@php
    $path = [
        'kanan' => 'M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3',
        'kiri' => 'M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18',
        'serong' => 'm4.5 19.5 15-15m0 0H8.25m11.25 0v11.25',
        'chevron-kanan' => 'm8.25 4.5 7.5 7.5-7.5 7.5',
        'chevron-kiri' => 'M15.75 19.5 8.25 12l7.5-7.5',
    ][$arah] ?? 'M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3';
    $ukuran = str_contains((string) $attributes->get('class'), 'w-') ? '' : 'h-[1em] w-[1em]';
@endphp
<svg {{ $attributes->class(['inline-block shrink-0 align-[-0.125em]', $ukuran]) }} fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" focusable="false"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $path }}"/></svg>
