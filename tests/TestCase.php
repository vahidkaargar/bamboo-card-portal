<?php

namespace vahidkaargar\BambooCardPortal\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use vahidkaargar\BambooCardPortal\ServiceProviders\BambooServiceProvider;

/**
 * Base test case for Bamboo Card Portal tests
 */
abstract class TestCase extends BaseTestCase
{
    /**
     * Get package providers
     *
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            BambooServiceProvider::class,
        ];
    }

    /**
     * Define environment setup
     *
     * @param \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function defineEnvironment($app)
    {
        // Setup default database to use in-memory SQLite
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        // Setup cache configuration
        $app['config']->set('cache.default', 'array');
        $app['config']->set('cache.stores.array', [
            'driver' => 'array',
        ]);

        // Setup bamboo configuration
        $app['config']->set('bamboo', [
            'sandbox_mode' => true,
            'sandbox_username' => 'test_user',
            'sandbox_password' => 'test_pass',
            'sandbox_base_url' => 'https://api-test.example.com',
            'connection_timeout' => 160,
            'cache' => [
                'enabled' => false, // Disable cache for tests by default
                'driver' => 'array',
                'prefix' => 'bamboo_test',
                'ttl' => 3600,
            ],
        ]);
    }
}
