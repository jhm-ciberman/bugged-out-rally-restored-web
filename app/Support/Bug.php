<?php

namespace App\Support;

use Illuminate\Support\Collection;

final readonly class Bug
{
    /**
     * Create a new bug.
     *
     * @param  string  $slug  The bug's URL segment and image file name.
     * @param  int  $number  The bug's place in the unlock order, starting at 1.
     * @param  string  $name  The name shown in the game.
     * @param  int  $price  The winnings needed to unlock the bug.
     * @param  int  $armor  The damage the bug takes before it wrecks.
     * @param  int  $engine  The bug's engine torque.
     * @param  int  $topSpeed  The top speed of the wheels, in meters per second.
     * @param  int  $boost  The push of the bug's boost.
     * @param  string  $description  A short text about the bug.
     */
    public function __construct(
        public string $slug,
        public int $number,
        public string $name,
        public int $price,
        public int $armor,
        public int $engine,
        public int $topSpeed,
        public int $boost,
        public string $description,
    ) {}

    /**
     * Get every bug in the game, in unlock order.
     *
     * @return Collection<int, self>
     */
    public static function all(): Collection
    {
        return collect([
            new self('beetle', 1, 'Beetle', 0, 80, 5200, 55, 3400, 'The bug you start with. It has the thinnest armor in the game, and the same engine, top speed and boost as the next two bugs.'),
            new self('ladybug', 2, 'Ladybug', 10000, 90, 5200, 55, 3400, 'The same engine, top speed and boost as the Beetle, with a bit more armor and a lower center of mass.'),
            new self('cockroach', 3, 'Cockroach', 25000, 120, 5200, 55, 3400, 'Still the starter engine, top speed and boost, but with much more armor than the Beetle or the Ladybug.'),
            new self('grasshopper', 4, 'Grasshopper', 50000, 120, 5400, 55, 3500, 'The first bug with a stronger engine and a stronger boost than the starters. Its top speed is the same.'),
            new self('hornet', 5, 'Hornet', 100000, 120, 5500, 57, 3700, 'The first bug with a higher top speed. It also beats the Grasshopper on engine and boost.'),
            new self('praying-mantis', 6, 'Praying Mantis', 150000, 120, 5400, 57, 3600, 'It costs more winnings than the Hornet and has the same top speed, but its engine and boost are weaker.'),
            new self('scorpion', 7, 'Scorpion', 200000, 140, 5600, 60, 3700, 'The top speed of the game, with more armor than any bug before it. Only the BlackWidow is stronger.'),
            new self('blackwidow', 8, 'BlackWidow', 300000, 150, 5700, 60, 3800, 'The last bug to unlock. It has the most armor and the strongest engine and boost, and it shares the highest top speed with the Scorpion.'),
        ]);
    }

    /**
     * Find the bug with the given slug.
     */
    public static function find(string $slug): ?self
    {
        return self::all()->firstWhere('slug', $slug);
    }

    /**
     * Get the bug before this one, wrapping around to the last bug.
     */
    public function previous(): self
    {
        $bugs = self::all();

        return $bugs[($this->number - 2 + $bugs->count()) % $bugs->count()];
    }

    /**
     * Get the bug after this one, wrapping around to the first bug.
     */
    public function next(): self
    {
        $bugs = self::all();

        return $bugs[$this->number % $bugs->count()];
    }

    /**
     * Get the text that says how the player gets this bug.
     */
    public function priceLabel(): string
    {
        return $this->price === 0
            ? 'Yours from the start'
            : 'Unlocks at '.number_format($this->price).' in winnings';
    }
}
