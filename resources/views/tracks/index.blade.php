<x-layout title="The Tracks" description="All 8 tracks from Bugged Out Rally, from grass and ponds to snow, sea, sand and the Moon.">
    <section class="panel flex flex-col gap-6 p-7">
        <div class="flex max-w-190 flex-col gap-2.5">
            <h1 class="display-title text-5xl">The Tracks</h1>
            <p class="text-[15px]/relaxed">Eight tracks, from grass and ponds to snow, sea, sand and the Moon. Win a race to open the next one. Pick a track to see its video, its map and more pictures.</p>
        </div>

        <div class="grid grid-cols-[repeat(auto-fill,minmax(240px,1fr))] gap-4.5">
            @foreach ($tracks as $track)
                <x-track-card :track="$track" />
            @endforeach
        </div>
    </section>
</x-layout>
