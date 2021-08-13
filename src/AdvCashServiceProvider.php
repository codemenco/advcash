<?php

namespace Codemenco\AdvCash;
use Illuminate\Support\ServiceProvider;

class AdvCashServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        include __DIR__ . '/routes.php';
        $this->app->make('Codemenco\AdvCash\AdvCash');

        $this->publishes([
            __DIR__.'/config/advcash.php' => config_path('advcash.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}