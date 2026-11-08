@php
    $facts = [
        'Checkpoints' => $track->checkpoints,
        'Boost pads' => $track->boostPads,
        'Spots on the grid' => $track->gridSpots,
        'Racing lines' => $track->racingLines,
    ];

    $previous = $track->previous();
    $next = $track->next();
@endphp

<x-layout :title="$track->name" description="{{ $track->name }}, track {{ $track->number }} of 8 in Bugged Out Rally: a video flight, the map, facts and pictures.">
    <section class="panel flex flex-col gap-4.5 px-7 pt-6 pb-7">
        <div class="flex flex-wrap items-center justify-between gap-x-5 gap-y-1">
            <a class="step-link" href="{{ route('tracks.index') }}">All tracks</a>

            <div class="flex flex-wrap gap-x-6 gap-y-1">
                <a class="step-link" href="{{ route('tracks.show', $previous->slug) }}">Previous: {{ $previous->name }}</a>
                <a class="step-link" href="{{ route('tracks.show', $next->slug) }}">Next: {{ $next->name }}</a>
            </div>
        </div>

        <div class="flex flex-col gap-1.5">
            <p class="text-[13px] font-bold text-parchment">TRACK {{ $track->number }} OF 8</p>
            <h1 class="display-title text-[56px]/none">{{ $track->name }}</h1>
            <p class="mt-1 max-w-190 text-[15px]/relaxed">{{ $track->description }}</p>
        </div>

        <video
            class="framed-image aspect-video bg-black"
            src="{{ Vite::asset("resources/videos/track{$track->number}-orbit.mp4") }}"
            poster="{{ Vite::image("tracks/backgrounds/track{$track->number}.webp") }}"
            autoplay
            muted
            loop
            playsinline
            aria-label="A slow flight around {{ $track->name }}"
        ></video>
    </section>

    <div class="flex flex-wrap items-start gap-10">
        <section class="min-w-0 flex-[1_1_420px]">
            <h2 class="section-label">The map</h2>

            <div class="panel flex flex-col gap-3 p-4.5">
                <img
                    class="framed-image"
                    src="{{ Vite::image("tracks/maps/track{$track->number}-annotated.webp") }}"
                    alt="Top-down map of {{ $track->name }} with the racing line, checkpoints, boost pads and pickups"
                    loading="lazy"
                >
                <p class="text-[13px]/normal text-parchment">The white line is the bots' racing line. The numbers are the checkpoints, in order.</p>
            </div>
        </section>

        <div class="flex min-w-0 flex-[1_1_320px] flex-col gap-10">
            <section>
                <h2 class="section-label">Facts</h2>

                <div class="panel flex flex-col gap-3.5 p-5.5">
                    <dl class="grid grid-cols-2 gap-2.5">
                        @foreach ($facts as $label => $value)
                            <div class="info-card p-2.5">
                                <dt class="text-xs text-parchment">{{ $label }}</dt>
                                <dd class="mt-1 font-display text-3xl text-white">{{ $value }}</dd>
                            </div>
                        @endforeach
                    </dl>

                    <div>
                        <p class="mb-2 font-bold text-gold">{{ $track->pickups() }} pickups</p>
                        <ul class="list-disc pl-5 text-sm/[1.7]">
                            <li>{{ $track->rockets }} Zinger rockets</li>
                            <li>{{ $track->bombs }} Magno bombs</li>
                            <li>{{ $track->cherries }} cherries</li>
                        </ul>
                    </div>
                </div>
            </section>

            <section>
                <h2 class="section-label">In 2004</h2>

                <div class="panel flex items-end gap-3.5 p-4.5">
                    <img
                        class="framed-image w-44!"
                        src="{{ Vite::image("tracks/original/track{$track->number}.webp") }}"
                        alt="The {{ $track->name }} picture from the 2004 menu"
                        width="352"
                        height="296"
                        loading="lazy"
                    >
                    <p class="text-[13px]/normal text-parchment">The picture the original game showed in its track menu.</p>
                </div>
            </section>
        </div>
    </div>

    <section>
        <h2 class="section-label">On the ground</h2>

        <div class="panel grid gap-4 p-5.5 md:grid-cols-3">
            <img class="framed-image" src="{{ Vite::image("tracks/backgrounds/track{$track->number}.webp") }}" alt="The start line of {{ $track->name }}" width="1280" height="720" loading="lazy">
            <img class="framed-image" src="{{ Vite::image("tracks/backgrounds/track{$track->number}-vista1.webp") }}" alt="A low view along the {{ $track->name }} track" width="1280" height="720" loading="lazy">
            <img class="framed-image" src="{{ Vite::image("tracks/backgrounds/track{$track->number}-vista2.webp") }}" alt="Another low view along the {{ $track->name }} track" width="1280" height="720" loading="lazy">
        </div>
    </section>

    <section>
        <h2 class="section-label">From above</h2>

        <div class="panel grid gap-4 p-5.5 md:grid-cols-3">
            @foreach ([1 => 'first', 2 => 'second', 3 => 'third'] as $aerial => $side)
                <img class="framed-image" src="{{ Vite::image("tracks/aerials/track{$track->number}-aerial{$aerial}.webp") }}" alt="{{ $track->name }} from above, {{ $side }} side" width="1280" height="720" loading="lazy">
            @endforeach
        </div>
    </section>

    <section>
        <h2 class="section-label">Racing here</h2>

        <div class="panel grid gap-4 p-5.5 md:grid-cols-3">
            @foreach ([1, 2, 3] as $shot)
                <img class="framed-image" src="{{ Vite::image("tracks/racing/track{$track->number}-{$shot}.webp") }}" alt="A race on {{ $track->name }}" width="1280" height="720" loading="lazy">
            @endforeach
        </div>
    </section>

    <nav aria-label="Other tracks" class="panel flex flex-wrap justify-between gap-x-6 gap-y-1 px-6 py-2.5">
        <a class="step-link" href="{{ route('tracks.show', $previous->slug) }}">Previous: {{ $previous->name }}</a>
        <a class="step-link" href="{{ route('tracks.index') }}">All tracks</a>
        <a class="step-link" href="{{ route('tracks.show', $next->slug) }}">Next: {{ $next->name }}</a>
    </nav>
</x-layout>
