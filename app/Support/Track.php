<?php

namespace App\Support;

use Illuminate\Support\Collection;

final readonly class Track
{
    /**
     * Create a new track.
     *
     * @param  string  $slug  The track's URL segment.
     * @param  int  $number  The track's number in the game, which also names its image files.
     * @param  string  $name  The name shown in the game.
     * @param  int  $checkpoints  The checkpoints in a lap.
     * @param  int  $boostPads  The boost pads on the track.
     * @param  int  $gridSpots  The spots on the starting grid.
     * @param  int  $racingLines  The racing lines the bots use.
     * @param  int  $rockets  The Zinger rocket pickups.
     * @param  int  $bombs  The Magno bomb pickups.
     * @param  int  $cherries  The cherry pickups.
     * @param  string  $description  A short text about the track.
     */
    public function __construct(
        public string $slug,
        public int $number,
        public string $name,
        public int $checkpoints,
        public int $boostPads,
        public int $gridSpots,
        public int $racingLines,
        public int $rockets,
        public int $bombs,
        public int $cherries,
        public string $description,
    ) {}

    /**
     * Get every track in the game, in track order.
     *
     * @return Collection<int, self>
     */
    public static function all(): Collection
    {
        return collect([
            new self('croaky-pond', 1, 'Croaky Pond', 6, 6, 14, 2, 19, 7, 5, 'Dirt roads around a green pond. Frogs sit by the track and spit at you when you get close. It is the only track where the bots use two racing lines.'),
            new self('turtle-creek', 2, 'Turtle Creek', 7, 5, 15, 1, 24, 8, 5, 'Trails through green cliffs, with five dust devils on the way. It ties with Lunar for the most pickups.'),
            new self('twin-peaks', 3, 'Twin Peaks', 7, 8, 15, 1, 14, 13, 9, 'Green hills, lakes and a tall bridge. Two launchers roll boulders at you in one area. It has more cherries than any other track.'),
            new self('boomerang-ii', 4, 'Boomerang II', 6, 6, 14, 1, 14, 8, 2, 'Steep brown hills with water below. Only Snowbound has fewer pickups.'),
            new self('snowbound', 5, 'Snowbound', 6, 5, 14, 1, 10, 10, 2, 'Snow and ice everywhere, and four launchers that send snowballs at you. It has the fewest pickups of any track.'),
            new self('ocean-side', 6, 'Ocean Side', 6, 3, 14, 1, 13, 12, 2, 'Ground paths and wooden bridges take you between small islands. There are five water spouts, and only three boost pads.'),
            new self('dunes-ii', 7, 'Dunes II', 8, 9, 16, 1, 15, 14, 2, 'Sand trails across the desert, with cactus along the way. It has the most checkpoints and the most boost pads of any track.'),
            new self('lunar', 8, 'Lunar', 6, 3, 14, 1, 24, 11, 2, 'The last track, on the Moon: grey craters under a black sky. It ties with Turtle Creek for the most pickups.'),
        ]);
    }

    /**
     * Find the track with the given slug.
     */
    public static function find(string $slug): ?self
    {
        return self::all()->firstWhere('slug', $slug);
    }

    /**
     * Get the track before this one, wrapping around to the last track.
     */
    public function previous(): self
    {
        $tracks = self::all();

        return $tracks[($this->number - 2 + $tracks->count()) % $tracks->count()];
    }

    /**
     * Get the track after this one, wrapping around to the first track.
     */
    public function next(): self
    {
        $tracks = self::all();

        return $tracks[$this->number % $tracks->count()];
    }

    /**
     * Get the total number of pickups on the track.
     */
    public function pickups(): int
    {
        return $this->rockets + $this->bombs + $this->cherries;
    }
}
