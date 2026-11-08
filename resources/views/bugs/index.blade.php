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
            <x-bug-card slug="beetle" name="Beetle" :price="0" :armor="80" :engine="5200" :speed="55" :boost="3400" />
            <x-bug-card slug="ladybug" name="Ladybug" :price="10000" :armor="90" :engine="5200" :speed="55" :boost="3400" />
            <x-bug-card slug="cockroach" name="Cockroach" :price="25000" :armor="120" :engine="5200" :speed="55" :boost="3400" />
            <x-bug-card slug="grasshopper" name="Grasshopper" :price="50000" :armor="120" :engine="5400" :speed="55" :boost="3500" />
            <x-bug-card slug="hornet" name="Hornet" :price="100000" :armor="120" :engine="5500" :speed="57" :boost="3700" />
            <x-bug-card slug="praying-mantis" name="Praying Mantis" :price="150000" :armor="120" :engine="5400" :speed="57" :boost="3600" />
            <x-bug-card slug="scorpion" name="Scorpion" :price="200000" :armor="140" :engine="5600" :speed="60" :boost="3700" />
            <x-bug-card slug="blackwidow" name="BlackWidow" :price="300000" :armor="150" :engine="5700" :speed="60" :boost="3800" />
        </div>
    </section>
</x-layout>
