@php
    $controls = [
        ['<kbd>Arrows</kbd> or <kbd>W</kbd> <kbd>S</kbd> + mouse', 'Drive and steer'],
        ['<kbd>Space</kbd>', 'Brake'],
        ['<kbd>A</kbd> or left mouse button', 'Fire a Zinger'],
        ['<kbd>D</kbd> or right mouse button', 'Drop a Magno bomb'],
        ['<kbd>E</kbd> / <kbd>R</kbd>', 'Zoom / change the zoom level'],
        ['<kbd>Tab</kbd>', 'First or third person'],
        ['<kbd>Enter</kbd>', 'Put the car back on the track'],
        ['<kbd>PgUp</kbd> <kbd>PgDn</kbd>', 'Scroll the message log'],
        ['<kbd>Esc</kbd>', 'In-race menu'],
    ];
@endphp

<x-layout title="Play" description="Play Bugged Out Rally for free in your browser. Nothing to install, you only need a keyboard.">
    <x-slot:head>
        @vite('resources/js/play.js')
    </x-slot:head>

    <section class="flex flex-col">
        <h1 class="sr-only">Play Bugged Out Rally</h1>

        <div class="panel p-1.5">
            <div class="relative aspect-video w-full" data-game-stage data-game-url="/game-build/index.html">
                <button type="button" class="game-poster absolute inset-0 flex size-full cursor-pointer flex-col items-center justify-center gap-3.5 p-4 text-center" data-game-start>
                    <span class="display-title text-[52px]">Click to start</span>
                    <span class="text-sm text-sand">The game runs right here in the page.</span>
                </button>

                <div class="game-poster absolute inset-0 flex items-center justify-center p-4 text-center" data-game-phone-note hidden>
                    <p class="display-title text-3xl">This game needs a keyboard. Open this page on a computer to play.</p>
                </div>
            </div>
        </div>

        <div class="game-toolbar mt-3.5 flex flex-wrap items-center justify-between gap-x-6 gap-y-2 px-3.5 py-1">
            <span class="text-[13px] text-sand">Your players and settings stay in this browser.</span>

            <div class="flex flex-wrap gap-x-3 gap-y-1">
                <button type="button" class="toolbar-action cursor-pointer" data-game-fullscreen>Fullscreen</button>
                <x-issue-link class="toolbar-action">Found a bug?</x-issue-link>
            </div>
        </div>
    </section>

    <div class="flex flex-wrap items-start gap-10">
        <section class="min-w-0 flex-[2_1_560px]">
            <h2 class="section-label">Controls</h2>

            <div class="panel px-6 py-2">
                <table class="w-full text-sm/[1.4]">
                    <tbody>
                        @foreach ($controls as [$keys, $action])
                            <tr class="border-b border-dashed border-trim/50 last:border-b-0">
                                <td class="w-[45%] py-2.5 pr-4">{!! $keys !!}</td>
                                <td class="py-2.5">{{ $action }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <div class="flex min-w-0 flex-[1_1_300px] flex-col gap-10">
            <section>
                <h2 class="section-label">Good to know</h2>

                <div class="panel p-6">
                    <ul class="flex list-disc flex-col gap-3 pl-5 text-sm/[1.55]">
                        <li>Want every bug and track right away? Turn on <strong class="text-gold">Unlock Everything</strong> in Options.</li>
                        <li>Your progress is saved in this browser. If you clear the site data, it's gone.</li>
                    </ul>
                </div>
            </section>

            <section>
                <h2 class="section-label">Debug Menu</h2>

                <div class="panel flex flex-col gap-3 p-6 text-sm/[1.55]">
                    <p>Press <kbd>F2</kbd> in the game to open it.</p>

                    <ul class="flex list-disc flex-col gap-2 pl-5">
                        <li>See the FPS.</li>
                        <li>Turn off the fog, sky, water, sun flares, car shadows, particles or the HUD.</li>
                        <li>Fly a free camera around the track (<kbd>W</kbd><kbd>A</kbd><kbd>S</kbd><kbd>D</kbd>, <kbd>Q</kbd><kbd>E</kbd>, <kbd>Shift</kbd>).</li>
                        <li>See up to 12 times farther than the original.</li>
                    </ul>
                </div>
            </section>
        </div>
    </div>

    <section>
        <h2 class="section-label">Credits and rights</h2>

        <div class="panel flex flex-col gap-3 p-6 text-[15px]/relaxed">
            <p><strong class="text-gold">"Bugged Out Rally Restored"</strong> is an unofficial fan restoration project of the original "Bugged Out Rally" game, made in 2004 by Inoculous Games: Akio Cullum (producer, programmer and art) and Thomas Cullum (soundtrack). All the game's models, textures, sounds and music belong to them.</p>
            <p>Ported to the browser by Javier "Ciberman" Mora. If you hold the rights and want anything changed or taken down, <x-issue-link>open an issue</x-issue-link> and I'll do it right away.</p>
        </div>
    </section>
</x-layout>
