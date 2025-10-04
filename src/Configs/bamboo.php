<?php
/**
 * Bamboo configs
 */
return [

    /*
     * SANDBOX
     * basic authentication
     * you can add BAMBOO_SANDBOX_USERNAME and BAMBOO_SANDBOX_PASSWORD to env and set value for it
     * otherwise you can add it to default value
     */
    "sandbox_base_url" => "https://api-stage.bamboocardportal.com/api/integration/v1.0/", // sandbox
    "sandbox_username" => env('BAMBOO_SANDBOX_USERNAME', 'default username'),
    "sandbox_password" => env('BAMBOO_SANDBOX_PASSWORD', 'default password'),

    /*
     * set sandbox mode enable for tests
     * set it false for production mode
     */
    "sandbox_mode" => env('BAMBOO_SANDBOX_MODE', true),

    /*
     * PRODUCTION
     * basic authentication
     * you can add BAMBOO_PRODUCTION_USERNAME and BAMBOO_PRODUCTION_PASSWORD to env and set value for it
     * otherwise you can add it to default value
     */
    "production_v2_base_url" => "https://api.bamboocardportal.com/api/integration/v2.0/", // production version 2
    "production_base_url" => "https://api.bamboocardportal.com/api/integration/v1.0/", // production
    "production_username" => env('BAMBOO_PRODUCTION_USERNAME', 'default username'),
    "production_password" => env('BAMBOO_PRODUCTION_PASSWORD', 'default password'),

    /*
     * Curl timeout
     */
    "connection_timeout" => env('BAMBOO_CONNECTION_TIMEOUT', 160),

    /*
     * Cache configuration
     */
    "cache" => [
        "enabled" => env('BAMBOO_CACHE_ENABLED', true),
        "driver" => env('BAMBOO_CACHE_DRIVER', 'default'),
        "prefix" => env('BAMBOO_CACHE_PREFIX', 'bamboo'),
        "ttl" => env('BAMBOO_CACHE_TTL', 3600), // 1 hour in seconds
    ],
];