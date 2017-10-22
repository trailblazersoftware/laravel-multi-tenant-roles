<?php

namespace Trailblazer\MultiTenant;

use Illuminate\Support\ServiceProvider;

class MultiTenantServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config files
        $this->publishes([
            __DIR__.'/Config/Config.php' => app()->basePath() . '/config/MultiTenant.php',
        ]);
        // Register commands
        if ($this->app->runningInConsole())
        {
            /* $this->commands([
                FooCommand::class,
                BarCommand::class,
            ]); */
        }
        $this->loadMigrationsFrom(__DIR__.'/Migrations');
        // Register blade directives
        // $this->bladeDirectives();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/config.php', 'multitenant'
        );
        $this->app->bind('multitenant', function($app){
            
        });
    }
}
