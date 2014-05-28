<?php namespace Obarlas\LaravelMigrateCustomCommand;

use Illuminate\Support\ServiceProvider;

class LaravelMigrateCustomCommandServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	public function boot() {
		$this->package('obarlas/laravel-migrate-custom-command');
		$this->commands(array(
			'Obarlas\LaravelMigrateCustomCommand\MigrateCustomCommand'
		));
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register() {
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides() {
		//
	}

}
