@php
    $links = [
        ['label' => 'Home', 'route' => 'home', 'active' => 'home'],
        ['label' => 'Play', 'route' => 'play', 'active' => 'play'],
        ['label' => 'Bugs', 'route' => 'bugs.index', 'active' => 'bugs.*'],
        ['label' => 'Tracks', 'route' => 'tracks.index', 'active' => 'tracks.*'],
        ['label' => 'Restoration', 'route' => 'restoration', 'active' => 'restoration'],
    ];
@endphp

<div class="border-b border-bark bg-wine-dark px-4 py-1.5 text-center text-xs/normal text-sand">
    Unofficial fan restoration. Not affiliated with Inoculous Games.
    <x-issue-link>Rights holder? Open an issue.</x-issue-link>
</div>

<header class="mx-auto flex w-full max-w-290 flex-wrap items-end justify-between gap-x-8 gap-y-4 px-4 pt-5 pb-2 sm:px-6">
    <a href="{{ route('home') }}" aria-label="Bugged Out Rally Restored: home" class="block">
        <img
            src="{{ Vite::image('logo-restored.webp') }}"
            srcset="{{ Vite::image('logo-restored.webp') }} 1x, {{ Vite::image('logo-restored@2x.webp') }} 2x"
            alt="Bugged Out Rally Restored"
            width="230"
            height="183"
        >
    </a>

    <nav aria-label="Main" class="flex flex-wrap gap-x-7 gap-y-1 pb-3.5">
        @foreach ($links as $link)
            <a
                href="{{ route($link['route']) }}"
                class="nav-link"
                @if (request()->routeIs($link['active'])) aria-current="page" @endif
            >{{ $link['label'] }}</a>
        @endforeach
    </nav>
</header>
