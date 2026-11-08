<?php

test('screenshots render as links', function (string $url) {
    $this->get($url)
        ->assertSee('data-screenshot>', false)
        ->assertDontSee('<x-screenshot', false);
})->with([
    'home' => '/',
    'track page' => '/tracks/lunar',
    'restoration' => '/restoration',
]);

test('the analytics beacon only loads in production', function () {
    $this->get(route('home'))->assertDontSee('cloudflareinsights', false);

    app()->detectEnvironment(fn () => 'production');

    $this->get(route('home'))->assertSee('cloudflareinsights', false);
});

test('the floating GitHub icon shows everywhere except the play page', function () {
    $this->get(route('home'))->assertSee('aria-label="Source code on GitHub"', false);
    $this->get(route('bugs.index'))->assertSee('aria-label="Source code on GitHub"', false);
    $this->get(route('play'))->assertDontSee('aria-label="Source code on GitHub"', false);
});

test('the play page points at the game build and lists the controls', function () {
    $this->get(route('play'))
        ->assertOk()
        ->assertSee('/game-build/index.html')
        ->assertSee('Drop a Magno bomb')
        ->assertSee('Play with keyboard')
        ->assertSee('Play with touch')
        ->assertSee('unofficial fan restoration project')
        ->assertSee('Not affiliated with Inoculous Games.');
});

test('the restoration page credits the authors and says AI tools were used', function () {
    $this->get(route('restoration'))
        ->assertOk()
        ->assertSee('Akio Cullum')
        ->assertSee('Thomas Cullum')
        ->assertSee('AI coding tools')
        ->assertSee('Not affiliated with Inoculous Games.');
});
