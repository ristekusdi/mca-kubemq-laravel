<?php

namespace Ristekusdi\McaKubemqLaravel;

use Illuminate\Support\ServiceProvider;
use Ristekusdi\McaKubemqLaravel\Services\Messagemcakube;

class McaKubemqLaravelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('kubemq-message', function () {
            return new Messagemcakube();
        });

        // $this->app->singleton('mcakubemqphp', function($app){
        //     return new McaKubemqPhp();
        // });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/mcakubemqphp.php' => config_path('mcakubemqphp.php'),], 'config-mca-kubemq');

    }
}
