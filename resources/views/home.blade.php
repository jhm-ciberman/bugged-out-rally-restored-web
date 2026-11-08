<x-layout>
    <section class="panel grid items-center gap-8 p-7 md:grid-cols-2">
        <img
            class="framed-image"
            src="{{ Vite::image('screenshot-race.webp') }}"
            alt="A race about to start on Croaky Pond, with the countdown at 2"
            width="1280"
            height="630"
        >

        <div class="flex flex-col gap-4">
            <h1 class="display-title text-5xl/[1.05]">Remember Bugged Out Rally?</h1>
            <p class="leading-relaxed">It's a racing game from 2004. You drive bugs on wheels, fire rockets at each other and drop bombs on the track. A small studio called Inoculous Games made it.</p>
            <p class="leading-relaxed">The studio is gone, you can't buy the game anymore, and the original only runs on some Windows 11 machines. So I ported it to the browser. Same tracks, same bugs, same music.</p>

            <div class="mt-2 flex flex-wrap gap-4">
                <a class="cta" href="{{ route('play') }}">Play it now</a>
                <a class="cta cta-ghost" href="{{ route('restoration') }}">About the restoration</a>
            </div>

            <p class="text-[13px] text-parchment">Free, nothing to install. You need a keyboard.</p>
        </div>
    </section>

    <section>
        <h2 class="section-label">Why I made this</h2>

        <div class="panel grid items-center gap-6 p-6 text-[15px]/relaxed md:grid-cols-2">
            <div class="flex flex-col gap-3">
                <p>I played this as a kid and loved it. Today it's <strong class="text-gold">abandonware</strong>: nobody sells it, and nobody is updating it.</p>
                <p>I didn't want it to disappear. Now it runs in a browser, so anyone can still play it.</p>
            </div>

            <div class="border border-dashed border-trim bg-black/25 px-3.5 py-3 text-[13px]">
                <strong class="text-gold">Bugged Out Rally is not my game.</strong> I'm not affiliated with Inoculous Games. If you hold the rights and want anything changed or taken down, <x-issue-link>open an issue</x-issue-link> and I'll do it right away.
            </div>
        </div>
    </section>

    <section>
        <h2 class="section-label">What's in it</h2>

        <div class="panel grid items-center gap-8 p-7 md:grid-cols-2">
            <ul class="flex list-disc flex-col gap-2.5 pl-5.5 leading-normal">
                <li><strong class="text-gold">8 tracks</strong>, from Croaky Pond all the way to the Moon</li>
                <li><strong class="text-gold">8 bugs</strong>: you start with the Beetle and unlock the rest with your winnings</li>
                <li><strong class="text-gold">3 ways to play</strong>: Explore, Single Event and Race Circuit</li>
                <li>Zinger rockets, Magno bombs and boost pads</li>
                <li>Frogs, boulders and water to watch out for</li>
                <li>The original menus, music and sounds</li>
            </ul>

            <img
                class="framed-image"
                src="{{ Vite::image('tracks/backgrounds/track1.webp') }}"
                alt="The start line of Croaky Pond, with the orange and white checkered grid"
                width="1280"
                height="720"
                loading="lazy"
            >
        </div>
    </section>

    <section>
        <h2 class="section-label">The bugs</h2>

        <div class="panel flex flex-col gap-4 px-6 pt-6 pb-5">
            <div class="grid grid-cols-[repeat(auto-fill,minmax(120px,1fr))] gap-3">
                @foreach ([
                    'beetle' => 'Beetle',
                    'ladybug' => 'Ladybug',
                    'cockroach' => 'Cockroach',
                    'grasshopper' => 'Grasshopper',
                    'hornet' => 'Hornet',
                    'praying-mantis' => 'Praying Mantis',
                    'scorpion' => 'Scorpion',
                    'blackwidow' => 'BlackWidow',
                ] as $slug => $name)
                    <a href="{{ route("bugs.{$slug}") }}" class="flex flex-col items-center gap-1 no-underline">
                        <img
                            src="{{ Vite::image("cars/{$slug}.webp") }}"
                            alt=""
                            width="130"
                            height="130"
                            loading="lazy"
                            class="aspect-square w-full max-w-32.5 object-contain"
                        >
                        <span class="text-center font-heading text-sm [text-shadow:1px_1px_0_var(--color-outline)]">{{ $name }}</span>
                    </a>
                @endforeach
            </div>

            <div class="flex flex-wrap justify-end gap-x-6 gap-y-2 text-[15px] font-bold">
                <a href="{{ route('bugs.index') }}">See all the bugs</a>
                <a href="{{ route('tracks.index') }}">See all the tracks</a>
            </div>
        </div>
    </section>
</x-layout>
