@props(['track'])

<a class="link-card flex flex-col" href="{{ route('tracks.show', $track->slug) }}">
    <img
        src="{{ Vite::image("tracks/original/track{$track->number}.webp") }}"
        alt=""
        width="352"
        height="296"
        loading="lazy"
        class="aspect-352/296 w-full object-cover"
    >

    <span class="flex flex-col gap-2 px-3.5 pt-3 pb-3.5">
        <span class="text-xs font-bold text-parchment">TRACK {{ $track->number }}</span>
        <span class="font-heading text-xl text-gold [text-shadow:1px_1px_0_var(--color-outline)]">{{ $track->name }}</span>
        <span class="flex flex-wrap gap-1.5">
            <span class="chip">{{ $track->checkpoints }} checkpoints</span>
            <span class="chip">{{ $track->boostPads }} boost pads</span>
            <span class="chip">{{ $track->pickups() }} pickups</span>
        </span>
    </span>
</a>
