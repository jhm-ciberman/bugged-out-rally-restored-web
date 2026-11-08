<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Str;

#[Signature('game:build
    {path? : Where to put the built game, public/game-build by default}
    {--force : Build even if the latest release is already built}')]
#[Description('Build the latest release of the game')]
class BuildGame extends Command
{
    /**
     * The longest a single build step may run, in seconds.
     */
    private const STEP_TIMEOUT = 600;

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $path = $this->argument('path') ?? public_path('game-build');
        $release = $this->latestRelease();

        if (! $this->option('force') && $this->builtRelease($path) === $release) {
            $this->components->info("The game is already at {$release}.");

            return self::SUCCESS;
        }

        $workspace = "{$path}.building";
        File::deleteDirectory($workspace);

        try {
            $this->components->task("Building the game at {$release}", fn () => $this->build($release, $workspace));

            $this->publish("{$workspace}/dist", $path, $release);
        } finally {
            File::deleteDirectory($workspace);
        }

        $this->components->info("The game is now at {$release}.");

        return self::SUCCESS;
    }

    /**
     * Get the tag of the game's latest published release.
     */
    private function latestRelease(): string
    {
        $repository = Str::after(config('site.game_repository'), 'github.com/');

        return Http::acceptJson()
            ->get("https://api.github.com/repos/{$repository}/releases/latest")
            ->throw()
            ->json('tag_name');
    }

    /**
     * Get the release currently built at the given path, if any.
     */
    private function builtRelease(string $path): ?string
    {
        return File::exists("{$path}/.release") ? trim(File::get("{$path}/.release")) : null;
    }

    /**
     * Clone the given release into the workspace and build it.
     */
    private function build(string $release, string $workspace): void
    {
        Process::timeout(self::STEP_TIMEOUT)
            ->run(['git', 'clone', '--depth', '1', '--branch', $release, config('site.game_repository'), $workspace])
            ->throw();

        $steps = [
            ['npm', 'ci', '--include=dev'],
            ['npm', 'run', 'build', '--', '--base=/game-build/'],
        ];

        foreach ($steps as $step) {
            Process::path($workspace)->timeout(self::STEP_TIMEOUT)->run($step)->throw();
        }
    }

    /**
     * Replace the game at the given path with a finished build.
     */
    private function publish(string $build, string $path, string $release): void
    {
        File::put("{$build}/.release", $release);

        $previous = "{$path}.previous";
        File::deleteDirectory($previous);

        if (File::isDirectory($path)) {
            File::moveDirectory($path, $previous);
        }

        File::moveDirectory($build, $path);
        File::deleteDirectory($previous);
    }
}
