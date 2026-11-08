<?php

beforeEach(function () {
    $this->withoutVite();
});

test('screenshots render as links', function (string $url) {
    $this->get($url)
        ->assertSee('data-screenshot>', false)
        ->assertDontSee('<x-screenshot', false);
})->with([
    'home' => '/',
    'track page' => '/tracks/lunar',
    'restoration' => '/restoration',
]);

test('the play page points at the game build and lists the controls', function () {
    $this->get(route('play'))
        ->assertOk()
        ->assertSee('/game-build/index.html')
        ->assertSee('Drop a Magno bomb')
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
