<x-layout title="The Bugs" description="All 8 bugs from Bugged Out Rally, with their stats and what it takes to unlock them.">
    <section class="panel flex flex-col gap-6 p-7">
        <div class="flex flex-wrap items-center justify-between gap-6">
            <div class="flex max-w-190 min-w-0 flex-[1_1_320px] flex-col gap-2.5">
                <h1 class="display-title text-5xl">The Bugs</h1>
                <p class="text-[15px]/relaxed">Eight bugs. You start with the Beetle and unlock the rest with what you win in races. Pick a bug to spin it in 3D and see it from every side.</p>
            </div>

            <video
                class="framed-image md:w-80"
                src="{{ Vite::asset('resources/videos/gameplay-small.mp4') }}"
                autoplay
                muted
                loop
                playsinline
                aria-label="Bugs racing on Croaky Pond"
            ></video>
        </div>

        <div class="grid grid-cols-[repeat(auto-fill,minmax(240px,1fr))] gap-4.5">
            @foreach ($bugs as $bug)
                <x-bug-card :bug="$bug" />
            @endforeach
        </div>
    </section>
</x-layout>
