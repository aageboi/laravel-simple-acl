<?php

namespace Aageboi\Acl;

use Illuminate\Support\ServiceProvider;

class AclServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom( __DIR__ . '/config.php', 'acl' );

        $this->loadMigrationsFrom(__DIR__.'/migrations');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = $this->app['path.config'] . DIRECTORY_SEPARATOR . 'acl.php';

        $this->loadViewsFrom(__DIR__.'/views', 'acl');

        $this->publishes([
            __DIR__ . '/config.php' => $configPath,
            __DIR__ . '/views' => resource_path('views/acl'),
        ]);

        $this->loadRoutesFrom(__DIR__.'/routes.php');

        $this->loadTranslationsFrom(__DIR__.'/translations', 'acl');

        // if ($this->app->runningInConsole()) {
        //     $this->commands([
        //         // ServicesCheck::class,
        //     ]);
        // }
    }
}
