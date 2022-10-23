<?php

namespace Mabdulmonem\Uploader;

use Illuminate\Support\ServiceProvider;

class AdminLteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->make('Mabdulmonem\Uploader\Http\Controllers\MediaControllers');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        include __DIR__."/Http/Helpers.php";

        $this->loadRoutesFrom(__DIR__."/routes/web.php");

        $this->loadMigrationsFrom(__DIR__."/database/migration");

        $this->loadTranslationsFrom(__DIR__."/lang","uploader");

        $this->loadViewsFrom(__DIR__."/resources/views","uploader");

        $this->publishes([
            __DIR__.'/public' => public_path('uploader/assets'),
        ], 'public');

    }
}
