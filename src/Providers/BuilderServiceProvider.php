<?php


namespace Noldors\Builder\Providers;

use Illuminate\Support\ServiceProvider;

class BuilderServiceProvider extends ServiceProvider
{
    public function register()
    {

        $this->mergeConfigFrom(__DIR__.'/../../config/builder.php', 'builder');
        //$this->mergeConfigFrom(__DIR__.'/../../config/form.php', 'form');
        //$this->loadViewsFrom(__DIR__.'/../../resources/views', 'form');

        $this->registerProviders();
    }

    public function boot()
    {
        //$this->app->bind('builder.model', null);
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'builder');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'builder');

        $this->publishes([
            __DIR__.'/../../resources/lang' => resource_path('lang/vendor/builder'),
            __DIR__.'/../../resources/views' => resource_path('views/vendor/builder'),
        ]);

        $this->publishes([
            __DIR__.'/../../public' => public_path('/builder/'),
        ], 'assets');

        $this->publishes([
            __DIR__.'/../../config/builder.php' => config_path('builder.php'),
        ], 'config');
    }

    public function registerProviders()
    {
        //$this->app->register(AliasesServiceProvider::class);
    }
}