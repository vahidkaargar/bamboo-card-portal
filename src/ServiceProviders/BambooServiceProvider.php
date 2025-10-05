<?php

namespace vahidkaargar\BambooCardPortal\ServiceProviders;

use Illuminate\Support\ServiceProvider;
use vahidkaargar\BambooCardPortal\Bamboo;
use vahidkaargar\BambooCardPortal\Services\CacheService;

/**
 * Bamboo Service Provider
 */
class BambooServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../Configs/bamboo.php', 'bamboo');

        // Register Bamboo service
        $this->app->singleton('bamboo', function ($app) {
            return new Bamboo();
        });

        // Register Cache service
        $this->app->singleton(CacheService::class, function ($app) {
            return new CacheService();
        });
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../Configs/bamboo.php' => config_path('bamboo.php'),
            ], 'bamboo-config');
        }

        require_once __DIR__ . '/../Helpers/helpers.php';
    }
}