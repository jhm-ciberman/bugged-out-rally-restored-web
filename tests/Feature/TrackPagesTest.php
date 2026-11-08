<?php

test('the tracks index links to every track', function () {
    $response = $this->get(route('tracks.index'))->assertOk();

    foreach (['croaky-pond', 'turtle-creek', 'twin-peaks', 'boomerang-ii', 'snowbound', 'ocean-side', 'dunes-ii', 'lunar'] as $slug) {
        $response->assertSee(route('tracks.show', $slug));
    }
});

test('an unknown track is not found', function () {
    $this->get(route('tracks.show', 'atlantis'))->assertNotFound();
});

test('a track page shows its name, pickups and neighbours', function (string $slug, string $name, int $pickups, string $previous, string $next) {
    $this->get(route('tracks.show', $slug))
        ->assertOk()
        ->assertSee($name)
        ->assertSee("{$pickups} pickups")
        ->assertSee('Previous: '.$previous)
        ->assertSee('Next: '.$next)
        ->assertSee('Not affiliated with Inoculous Games.');
})->with([
    ['croaky-pond', 'Croaky Pond', 31, 'Lunar', 'Turtle Creek'],
    ['turtle-creek', 'Turtle Creek', 37, 'Croaky Pond', 'Twin Peaks'],
    ['twin-peaks', 'Twin Peaks', 36, 'Turtle Creek', 'Boomerang II'],
    ['boomerang-ii', 'Boomerang II', 24, 'Twin Peaks', 'Snowbound'],
    ['snowbound', 'Snowbound', 22, 'Boomerang II', 'Ocean Side'],
    ['ocean-side', 'Ocean Side', 27, 'Snowbound', 'Dunes II'],
    ['dunes-ii', 'Dunes II', 31, 'Ocean Side', 'Lunar'],
    ['lunar', 'Lunar', 37, 'Dunes II', 'Croaky Pond'],
]);
