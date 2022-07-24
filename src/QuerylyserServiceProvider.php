<?php

namespace AMeheina\Querylyser;

use AMeheina\Querylyser\Console\QuerylyserStart;
use AMeheina\Querylyser\Console\QuerylyserStop;
use AMeheina\Querylyser\Providers\EventServiceProvider;
use Illuminate\Support\ServiceProvider;

class QuerylyserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'querylyser');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'querylyser');
         $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('querylyser.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/querylyser'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/querylyser'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/querylyser'),
            ], 'lang');*/

            // Registering package commands.
            $this->commands([
                QuerylyserStart::class,
                QuerylyserStop::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'querylyser');

        // Register the main class to use with the facade
        $this->app->singleton('querylyser', function () {
            return new Querylyser;
        });

        $this->app->register(EventServiceProvider::class);
    }
}
