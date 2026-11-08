@props(['bug'])

<a class="link-card flex flex-col gap-2 p-3.5" href="{{ route('bugs.show', $bug->slug) }}">
    <img
        src="{{ Vite::image("cars/{$bug->slug}.webp") }}"
        alt=""
        width="240"
        height="240"
        loading="lazy"
        class="aspect-square max-h-50 w-full object-contain"
    >

    <span class="font-heading text-xl text-gold [text-shadow:1px_1px_0_var(--color-outline)]">{{ $bug->name }}</span>
    <span class="text-xs text-parchment">{{ $bug->priceLabel() }}</span>

    <x-bug-stats :bug="$bug" />
</a>
