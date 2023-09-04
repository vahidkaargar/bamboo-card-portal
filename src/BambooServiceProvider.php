<?php

namespace vahidkaargar\BambooCardPortal;

use Illuminate\Support\ServiceProvider;

class BambooServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/bamboo.php', 'bamboo');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/bamboo.php' => config_path('bamboo.php'),
            ], 'bamboo-config');
        }

        require_once __DIR__ . '/helpers.php';
    }

}