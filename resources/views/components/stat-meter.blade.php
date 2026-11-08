@props([
    'label',
    'value',
    'min',
    'max',
    'display' => null,
])

@php
    $filledSegments = 2 + (int) round(8 * ($value - $min) / ($max - $min));
@endphp

<div @class([
    'grid items-center',
    'grid-cols-[86px_minmax(0,1fr)_58px] gap-2.5 text-[13px]' => $display !== null,
    'grid-cols-[70px_minmax(0,1fr)] gap-2 text-[11px]' => $display === null,
])>
    <span>{{ $label }}</span>

    <span class="flex gap-0.5" aria-hidden="true">
        @for ($segment = 0; $segment < 10; $segment++)
            <span @class([
                'stat-segment',
                'stat-segment-on' => $segment < $filledSegments,
                'h-3.25' => $display !== null,
                'h-2.25' => $display === null,
            ])></span>
        @endfor
    </span>

    @if ($display !== null)
        <span class="text-right text-parchment">{{ $display }}</span>
    @else
        <span class="sr-only">{{ $value }}</span>
    @endif
</div>
