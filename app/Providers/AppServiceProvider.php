<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        Date::use(CarbonImmutable::class);
        Model::preventLazyLoading(! $this->app->environment('production'));

        $this->registerViteMacros();
        $this->configureCommands();
    }

    /**
     * Register custom Vite macros.
     */
    protected function registerViteMacros(): void
    {
        Vite::macro('image', function (string $asset) { /** @var Vite $this */
            return $this->asset("resources/images/{$asset}");
        });
    }

    /**
     * Configure the Artisan commands.
     */
    protected function configureCommands(): void
    {
        DB::prohibitDestructiveCommands($this->app->environment(['production', 'staging']));
    }
}
