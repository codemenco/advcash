<?php


namespace Codemenco\Advcash;

use Illuminate\Support\ServiceProvider;

class AdvcashServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		if( config('advcash.default',false) ) include __DIR__.'/routes.php';

		$this->loadViews();

		$this->publishConfiguration();

	}

	/**
	 * Load and publish package views.
	 *
	 * @return void
	 */
	private function loadViews()
	{
		$this->loadViewsFrom(__DIR__ . '/../views','advcash');

		$this->publishes([
			__DIR__ . '/../views' => resource_path('views/vendor/advcash')
		]);
	}

	/**
	 * Publish package configuration.
	 *
	 * @return void
	 */
	private function publishConfiguration()
	{
		$this->publishes([
			__DIR__ . '/../config/advcash.php' => config_path('advcash.php'),
		], 'config');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton('advcash', function ($app) {
			return new Advcash();
		});

		$this->mergeConfigFrom(__DIR__ . '/../config/advcash.php', 'advcash');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['advcash'];
	}
}
