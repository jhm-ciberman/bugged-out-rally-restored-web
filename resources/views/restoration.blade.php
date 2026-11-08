@php
    $steps = [
        ['Read the scripts', 'The rules, menus and bot logic are written in TorqueScript, but the game only includes the compiled version. I ran a decompiler over every file and got readable scripts back. The comments were gone and a few lines came out garbled, but the logic was there.'],
        ['Convert the art', 'The bugs, props and buildings use file formats from 2004 that no browser understands. With readers made by the Torque community, I converted all 81 models to glTF. The terrain, textures, sounds and music load straight from the original files.'],
        ['Write the game again', 'Then I rebuilt it piece by piece in TypeScript and three.js: Torque\'s car physics, the sky, fog and water, the race rules, bots, weapons, hazards and every menu.'],
        ['Read the original program', 'Torque\'s source code is public and explains most of the engine. But this game changed a few parts: how the bots drive and aim, how race positions work, when the Wrong Way warning shows. Those only exist in the original .exe, so I decoded them from there.'],
        ['Compare it with the real game', 'A script starts the original game, puts the camera or the car in an exact spot, logs positions and speeds, and takes screenshots. I compared physics, bot lap times, shadows, the HUD and the menus, and fixed what didn\'t match. For example, my tires were 12 cm too big, so the cars sat too high.'],
    ];

    $comparisons = [
        'start' => 'The start countdown on Croaky Pond',
        'scenery' => 'A free camera view of Snowbound',
        'scenery-ocean-side' => 'A free camera view of Ocean Side',
        'boomerang' => 'A race on Boomerang II',
        'main-menu' => 'The main menu',
        'player-selection' => 'The player and bug selection menu',
        'venue-selection' => 'The track selection menu',
    ];
@endphp

<x-layout title="About the restoration" description="How Bugged Out Rally, a racing game from 2004, was ported to the browser. Side by side pictures, credits and thanks.">
    <section class="panel flex flex-col gap-3.5 p-7">
        <h1 class="display-title text-5xl">About the restoration</h1>
        <p class="max-w-195 leading-relaxed">This is a port, not a remake. The idea is simple: it should play the way it did in 2004. Same tracks, same bugs, same physics numbers, same bots, same menus.</p>
        <p class="max-w-195 leading-relaxed">I built it with a lot of help from AI coding tools. The original game files are the reference for everything, and the port was checked against the real game running side by side.</p>
    </section>

    <section>
        <h2 class="section-label">What it took to bring it back</h2>

        <div class="panel grid gap-4 p-6 sm:grid-cols-2">
            @foreach ($steps as [$title, $text])
                <article class="info-card flex flex-col gap-2 p-4.5 sm:last:col-span-2">
                    <span class="font-display text-[34px]/none text-trim">{{ $loop->iteration }}</span>
                    <h3 class="font-heading text-lg text-gold">{{ $title }}</h3>
                    <p class="text-sm/[1.55]">{{ $text }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section>
        <h2 class="section-label">2004 and today, side by side</h2>

        <div class="panel flex flex-col gap-7 p-6">
            @foreach ($comparisons as $comparison => $description)
                <div class="grid gap-5 md:grid-cols-2">
                    <figure class="flex flex-col gap-2">
                        <span class="version-tag bg-[#c8102e]">2004 original</span>
                        <x-screenshot :src="Vite::image('compare/'.$comparison.'-original.webp')" alt="{{ $description }} in the 2004 original" loading="lazy" />
                    </figure>

                    <figure class="flex flex-col gap-2">
                        <span class="version-tag bg-[#1e5418]">Restored</span>
                        <x-screenshot :src="Vite::image('compare/'.$comparison.'-restored.webp')" alt="{{ $description }} in the restored game" loading="lazy" />
                    </figure>
                </div>
            @endforeach

            <p class="text-sm/relaxed text-parchment">A few original bugs (errors) that broke things by accident are fixed. The ones that are part of how the game feels are kept.</p>
        </div>
    </section>

    <section>
        <h2 class="section-label">From the restored game</h2>

        <div class="panel grid gap-4 p-6 md:grid-cols-3">
            <x-screenshot :src="Vite::image('tracks/aerials/track6-aerial1.webp')" alt="Aerial view of Ocean Side, a wooden track over the sea" width="1280" height="720" loading="lazy" />
            <x-screenshot :src="Vite::image('tracks/aerials/track3-aerial1.webp')" alt="Aerial view of Twin Peaks, with green hills and lakes" width="1280" height="720" loading="lazy" />
            <x-screenshot :src="Vite::image('tracks/backgrounds/track6.webp')" alt="The start line of Ocean Side, on a beach" width="1280" height="720" loading="lazy" />
        </div>
    </section>

    <div class="grid gap-10 md:grid-cols-2">
        <section>
            <h2 class="section-label">Credits</h2>

            <div class="panel flex flex-col gap-3.5 p-6 text-sm/relaxed">
                <p>Bugged Out Rally was made in <strong class="text-gold">2004</strong> by <strong class="text-gold">Inoculous Games</strong>.</p>

                <ul class="list-disc pl-5">
                    <li>Akio Cullum: producer, programmer and art</li>
                    <li>Thomas Cullum: soundtrack</li>
                </ul>

                <p>It runs on the Torque Game Engine by GarageGames.</p>
                <p>The restoration is by Javier "Ciberman" Mora. The code is on <a href="{{ config('site.game_repository') }}">GitHub</a>.</p>
            </div>
        </section>

        <section>
            <h2 class="section-label">Thanks to</h2>

            <div class="panel p-6 text-sm/relaxed">
                <ul class="flex list-disc flex-col gap-1.5 pl-5">
                    <li><a href="https://github.com/Elletra/dso-sharp">dso-sharp</a> by Elletra, for decompiling TorqueScript</li>
                    <li><a href="https://github.com/qoh/io_scene_dts">io_scene_dts</a> by qoh, for reading the DTS models</li>
                    <li><a href="https://github.com/RandomityGuy/io_dif">io_dif</a> by RandomityGuy, for reading the DIF buildings</li>
                    <li><a href="https://threejs.org/">three.js</a> and <a href="https://github.com/gkjohnson/three-mesh-bvh">three-mesh-bvh</a>, for drawing and collisions</li>
                    <li>Everyone who kept the Torque source online</li>
                </ul>
            </div>
        </section>
    </div>

    <section>
        <h2 class="section-label">About the rights</h2>

        <div class="panel flex flex-col gap-3 p-6 text-[15px]/relaxed">
            <p><strong class="text-gold">I'm not affiliated with Inoculous Games.</strong> Bugged Out Rally is their game, and all its models, textures, sounds and music belong to them.</p>
            <p>I made this because I love the game and didn't want it to be lost. I don't want to step on anyone's toes. If you hold the rights and want anything changed, credited differently or taken down, <x-issue-link>open an issue</x-issue-link> and I'll do it right away.</p>
        </div>
    </section>
</x-layout>
