<?php

use Illuminate\Process\Exceptions\ProcessFailedException;
use Illuminate\Process\PendingProcess;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Process;

beforeEach(function () {
    $this->path = storage_path('framework/testing/game-build-'.uniqid());

    Http::fake(['api.github.com/*' => Http::response(['tag_name' => 'v2026.11.08a'])]);

    Process::fake(function (PendingProcess $process) {
        if (in_array('build', (array) $process->command)) {
            File::ensureDirectoryExists("{$process->path}/dist");
            File::put("{$process->path}/dist/index.html", 'new build');
        }

        return Process::result();
    });
});

afterEach(function () {
    File::deleteDirectory($this->path);
    File::deleteDirectory("{$this->path}.building");
    File::deleteDirectory("{$this->path}.previous");
});

function existingBuild(string $path, string $release): void
{
    File::ensureDirectoryExists($path);
    File::put("{$path}/index.html", 'old build');
    File::put("{$path}/.release", $release);
}

test('it builds the latest release and publishes it', function () {
    $this->artisan('game:build', ['path' => $this->path])->assertSuccessful();

    expect(File::get("{$this->path}/index.html"))->toBe('new build')
        ->and(File::get("{$this->path}/.release"))->toBe('v2026.11.08a')
        ->and(File::isDirectory("{$this->path}.building"))->toBeFalse();

    Process::assertRan(fn (PendingProcess $process) => in_array('clone', (array) $process->command)
        && in_array('v2026.11.08a', (array) $process->command));
    Process::assertRan(fn (PendingProcess $process) => in_array('--base=/game-build/', (array) $process->command));
});

test('it replaces an older build', function () {
    existingBuild($this->path, 'v2026.01.01a');
    File::put("{$this->path}/old-file.js", 'stale');

    $this->artisan('game:build', ['path' => $this->path])->assertSuccessful();

    expect(File::get("{$this->path}/index.html"))->toBe('new build')
        ->and(File::exists("{$this->path}/old-file.js"))->toBeFalse()
        ->and(File::isDirectory("{$this->path}.previous"))->toBeFalse();
});

test('it skips the build when the latest release is already built', function () {
    existingBuild($this->path, 'v2026.11.08a');

    $this->artisan('game:build', ['path' => $this->path])->assertSuccessful();

    Process::assertNothingRan();
    expect(File::get("{$this->path}/index.html"))->toBe('old build');
});

test('the force option builds an already built release', function () {
    existingBuild($this->path, 'v2026.11.08a');

    $this->artisan('game:build', ['path' => $this->path, '--force' => true])->assertSuccessful();

    expect(File::get("{$this->path}/index.html"))->toBe('new build');
});

test('a failed build keeps the current game and cleans up', function () {
    existingBuild($this->path, 'v2026.01.01a');

    Process::fake(['*' => Process::result(exitCode: 1)]);

    expect(fn () => $this->artisan('game:build', ['path' => $this->path])->run())
        ->toThrow(ProcessFailedException::class);

    expect(File::get("{$this->path}/index.html"))->toBe('old build')
        ->and(File::isDirectory("{$this->path}.building"))->toBeFalse();
});
