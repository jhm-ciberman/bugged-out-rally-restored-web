@php
    $angles = [
        'front' => 'Front',
        'side' => 'Side',
        'back' => 'Back',
        'rear-three-quarter' => 'Rear',
        'top' => 'Top',
    ];

    $previous = $bug->previous();
    $next = $bug->next();
@endphp

<x-layout :title="$bug->name" description="The {{ $bug->name }} from Bugged Out Rally: a 3D model you can spin, its stats and what it takes to unlock it.">
    <x-slot:head>
        @vite('resources/js/model-viewer.js')
    </x-slot:head>

    <section class="panel flex flex-col gap-4.5 px-7 pt-6 pb-7">
        <div class="flex flex-wrap items-center justify-between gap-x-5 gap-y-1">
            <a class="step-link" href="{{ route('bugs.index') }}">All bugs</a>

            <div class="flex flex-wrap gap-x-6 gap-y-1">
                <a class="step-link" href="{{ route('bugs.show', $previous->slug) }}">Previous: {{ $previous->name }}</a>
                <a class="step-link" href="{{ route('bugs.show', $next->slug) }}">Next: {{ $next->name }}</a>
            </div>
        </div>

        <div class="flex flex-wrap items-stretch gap-7">
            <div class="model-stage relative aspect-square max-h-140 min-w-0 flex-[3_1_440px]">
                <model-viewer
                    src="{{ Vite::asset("resources/models/bugs/{$bug->slug}.glb") }}"
                    poster="{{ Vite::image("cars/{$bug->slug}.webp") }}"
                    alt="The {{ $bug->name }}, a 3D model you can spin"
                    camera-controls
                    camera-orbit="-35deg 72deg auto"
                    auto-rotate
                    disable-zoom
                    interaction-prompt="none"
                    environment-image="neutral"
                    shadow-intensity="1"
                    class="size-full"
                ></model-viewer>

                <span class="absolute bottom-2.5 left-2.5 border border-bark bg-gold px-2 py-0.75 text-xs font-bold text-outline">3D: drag to spin</span>
            </div>

            <div class="flex min-w-0 flex-[2_1_320px] flex-col gap-4">
                <p class="text-[13px] font-bold text-parchment">BUG {{ $bug->number }} OF 8</p>
                <h1 class="display-title text-[56px]/none">{{ $bug->name }}</h1>
                <p class="text-[15px]/relaxed">{{ $bug->description }}</p>
                <p class="text-sm font-bold text-gold">{{ $bug->priceLabel() }}</p>

                <div class="info-card flex flex-col gap-2.5 p-4">
                    <x-bug-stats :bug="$bug" show-values />
                    <p class="mt-1 text-xs text-parchment">Weight: 200, the same for every bug. The bars compare the bugs with each other.</p>
                </div>

                <div class="flex items-center gap-3">
                    <img
                        src="{{ Vite::image("cars/original/{$bug->slug}.webp") }}"
                        alt="The {{ $bug->name }} portrait from the 2004 loading screen"
                        width="72"
                        height="72"
                        class="size-18 border border-trim/55 bg-black/30 object-contain"
                    >
                    <span class="text-xs text-parchment">The 2004 portrait, from the loading screen</span>
                </div>
            </div>
        </div>
    </section>

    <section>
        <h2 class="section-label">From every side</h2>

        <div class="panel grid grid-cols-[repeat(auto-fill,minmax(190px,1fr))] gap-3.5 p-5.5">
            @foreach ($angles as $angle => $label)
                <figure class="model-stage flex flex-col items-center gap-1.5 p-2.5">
                    <img
                        src="{{ Vite::image("cars/gallery/{$bug->slug}-{$angle}.webp") }}"
                        alt="The {{ $bug->name }}, {{ strtolower($label) }} view"
                        width="190"
                        height="190"
                        loading="lazy"
                        class="aspect-square w-full object-contain"
                    >
                    <figcaption class="text-xs font-bold text-gold">{{ $label }}</figcaption>
                </figure>
            @endforeach
        </div>
    </section>

    <nav aria-label="Other bugs" class="panel flex flex-wrap justify-between gap-x-6 gap-y-1 px-6 py-2.5">
        <a class="step-link" href="{{ route('bugs.show', $previous->slug) }}">Previous: {{ $previous->name }}</a>
        <a class="step-link" href="{{ route('bugs.index') }}">All bugs</a>
        <a class="step-link" href="{{ route('bugs.show', $next->slug) }}">Next: {{ $next->name }}</a>
    </nav>
</x-layout>
