<?php

namespace BeeDelivery\Acqio;

use Illuminate\Support\ServiceProvider;

class AcqioServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/acqio.php', 'acqio');

        $this->app->singleton('acqio', function ($app) {
            return new Acqio;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/acqio.php' => config_path('acqio.php'),
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['acqio'];
    }
}
