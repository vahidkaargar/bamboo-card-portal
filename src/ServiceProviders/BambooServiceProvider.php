<?php

namespace vahidkaargar\BambooCardPortal\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class BambooServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../Configs/bamboo.php', 'bamboo');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../Configs/bamboo.php' => config_path('bamboo.php'),
            ], 'bamboo-config');
        }

        require_once __DIR__ . '/../Helpers/helpers.php';
    }

}