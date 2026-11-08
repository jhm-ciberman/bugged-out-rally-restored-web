@props([
    'title' => null,
    'description' => 'Bugged Out Rally is a racing game from 2004 where you drive bugs on wheels. This unofficial fan restoration lets you play it for free in your browser.',
])

@php
    $siteName = 'Bugged Out Rally Restored';
    $pageTitle = $title ? "{$siteName}: {$title}" : $siteName;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $description }}">

    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ asset('og-image.jpg') }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ asset('og-image.jpg') }}">

    <link rel="icon" href="/favicon.ico" sizes="48x48">
    <link rel="icon" type="image/png" href="/favicon-32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16.png" sizes="16x16">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="manifest" href="/site.webmanifest">

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{ $head ?? '' }}
</head>

<body>
    <div class="site-background flex min-h-screen flex-col">
        <x-navbar />

        <main class="mx-auto flex w-full max-w-290 flex-1 flex-col gap-14 px-4 pt-6 pb-18 sm:px-6">
            {{ $slot }}
        </main>

        <x-footer />
    </div>

    @unless (request()->routeIs('play'))
        <a
            href="{{ config('site.game_repository') }}"
            aria-label="Source code on GitHub"
            title="Source on GitHub"
            class="fixed right-3 bottom-3 z-40 block size-14 drop-shadow-[0_3px_0_rgb(58_22_0/0.55)] transition-transform hover:scale-110 md:right-5 md:bottom-5 md:size-18"
        >
            <img src="{{ Vite::image('ui/github-icon.webp') }}" alt="" width="72" height="72">
        </a>
    @endunless

    <dialog class="screenshot-viewer" data-screenshot-viewer>
        <img alt="">
    </dialog>

    @env(['production'])
        <script defer src="https://static.cloudflareinsights.com/beacon.min.js" data-cf-beacon='{"token": "1856252808604ace9fa445ab9271ca59"}'></script>
    @endenv
</body>

</html>
