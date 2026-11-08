<?php

test('the bugs index links to every bug', function () {
    $response = $this->get(route('bugs.index'))->assertOk();

    foreach (['beetle', 'ladybug', 'cockroach', 'grasshopper', 'hornet', 'praying-mantis', 'scorpion', 'blackwidow'] as $slug) {
        $response->assertSee(route('bugs.show', $slug));
    }
});

test('an unknown bug is not found', function () {
    $this->get(route('bugs.show', 'dragonfly'))->assertNotFound();
});

test('a bug page shows its name, price and neighbours', function (string $slug, string $name, string $price, string $previous, string $next) {
    $this->get(route('bugs.show', $slug))
        ->assertOk()
        ->assertSee($name)
        ->assertSee($price)
        ->assertSee('Previous: '.$previous)
        ->assertSee('Next: '.$next)
        ->assertSee('Not affiliated with Inoculous Games.');
})->with([
    ['beetle', 'Beetle', 'Yours from the start', 'BlackWidow', 'Ladybug'],
    ['ladybug', 'Ladybug', 'Unlocks at 10,000 in winnings', 'Beetle', 'Cockroach'],
    ['cockroach', 'Cockroach', 'Unlocks at 25,000 in winnings', 'Ladybug', 'Grasshopper'],
    ['grasshopper', 'Grasshopper', 'Unlocks at 50,000 in winnings', 'Cockroach', 'Hornet'],
    ['hornet', 'Hornet', 'Unlocks at 100,000 in winnings', 'Grasshopper', 'Praying Mantis'],
    ['praying-mantis', 'Praying Mantis', 'Unlocks at 150,000 in winnings', 'Hornet', 'Scorpion'],
    ['scorpion', 'Scorpion', 'Unlocks at 200,000 in winnings', 'Praying Mantis', 'BlackWidow'],
    ['blackwidow', 'BlackWidow', 'Unlocks at 300,000 in winnings', 'Scorpion', 'Beetle'],
]);
