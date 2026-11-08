<?php

beforeEach(function () {
    $this->withoutVite();
});

test('the home page links to every bug', function (string $name, string $slug) {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee($name)
        ->assertSee(route("bugs.{$slug}"));
})->with([
    ['Beetle', 'beetle'],
    ['Ladybug', 'ladybug'],
    ['Cockroach', 'cockroach'],
    ['Grasshopper', 'grasshopper'],
    ['Hornet', 'hornet'],
    ['Praying Mantis', 'praying-mantis'],
    ['Scorpion', 'scorpion'],
    ['BlackWidow', 'blackwidow'],
]);

test('the home page says the site is not affiliated with the original studio', function () {
    $this->get(route('home'))->assertSee('Not affiliated with Inoculous Games.');
});

test('the rights holder link goes to the game repository issues', function () {
    $this->get(route('home'))->assertSee(config('site.game_repository').'/issues');
});
