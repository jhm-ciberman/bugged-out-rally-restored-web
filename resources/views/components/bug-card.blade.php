@props([
    'slug',
    'name',
    'price',
    'armor',
    'engine',
    'speed',
    'boost',
])

<a class="link-card flex flex-col gap-2 p-3.5" href="{{ route("bugs.{$slug}") }}">
    <img
        src="{{ Vite::image("cars/{$slug}.webp") }}"
        alt=""
        width="240"
        height="240"
        loading="lazy"
        class="aspect-square max-h-50 w-full object-contain"
    >

    <span class="font-heading text-xl text-gold [text-shadow:1px_1px_0_var(--color-outline)]">{{ $name }}</span>
    <span class="text-xs text-parchment">{{ $price === 0 ? 'Yours from the start' : 'Unlocks at '.number_format($price).' in winnings' }}</span>

    <x-bug-stats :armor="$armor" :engine="$engine" :speed="$speed" :boost="$boost" />
</a>
