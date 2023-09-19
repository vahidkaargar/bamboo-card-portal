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
    protected function loadConfig()
    {
        if (is_null(config('bamboo.sandbox_mode'))) {
            $configs = require(__DIR__ . '/../Configs/bamboo.php');
            Config::set('bamboo', $configs);
        }
    }
}