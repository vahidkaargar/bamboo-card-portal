<?php

namespace vahidkaargar\BambooCardPortal\Traits;

use Illuminate\Support\Facades\Config;

/**
 * Load configs
 */
trait ConfigTrait
{
    /**
     * @return void
     */
    protected function loadConfig(): void
    {
        if (is_null(config('bamboo.sandbox_mode'))) {
            $configs = require(__DIR__ . '/../Configs/bamboo.php');
            Config::set('bamboo', $configs);
        }
        
        // Ensure we have the required config values
        if (is_null(config('bamboo.sandbox_username'))) {
            $configs = require(__DIR__ . '/../Configs/bamboo.php');
            Config::set('bamboo', array_merge(config('bamboo', []), $configs));
        }
    }
}