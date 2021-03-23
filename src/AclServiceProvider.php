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
        // $this->app->make('Aageboi\Acl\Controllers\PermissionsController');
        // $this->app->make('Aageboi\Acl\Controllers\RolesController');
        // $this->app->make('Aageboi\Acl\Controllers\UsersController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'acl');

        $this->loadRoutesFrom(__DIR__.'/routes.php');

        // $this->loadMigrationsFrom(__DIR__.'/migrations');

        $this->loadTranslationsFrom(__DIR__.'/translations', 'acl');

        if ($this->app->runningInConsole()) {
            $this->commands([
                // ServicesCheck::class,
            ]);
        }

        $this->publishes([
            __DIR__.'/migrations' => database_path('migrations/'),
        ], 'migrations');
    }
}
