<?php

namespace vahidkaargar\BambooCardPortal\Tests\Unit\Facades;

use vahidkaargar\BambooCardPortal\Tests\TestCase;
use vahidkaargar\BambooCardPortal\Facades\BambooFacade;
use vahidkaargar\BambooCardPortal\Bamboo;
use vahidkaargar\BambooCardPortal\Tasks\{Accounts, Catalogs, Exchange, Notifications, Orders, Transactions};

/**
 * Bamboo Facade test
 */
class BambooFacadeTest extends TestCase
{
    /**
     * Setup test
     */
    protected function setUp(): void
    {
        parent::setUp();
        
        // Mock configuration
        $this->app['config']->set('bamboo', [
            'sandbox_mode' => true,
            'sandbox_username' => 'test_user',
            'sandbox_password' => 'test_pass',
            'sandbox_base_url' => 'https://api-test.example.com',
            'connection_timeout' => 160,
        ]);
    }

    /**
     * Test facade returns correct instances
     */
    public function testFacadeReturnsCorrectInstances()
    {
        $this->assertInstanceOf(Catalogs::class, BambooFacade::catalogs());
        $this->assertInstanceOf(Accounts::class, BambooFacade::accounts());
        $this->assertInstanceOf(Orders::class, BambooFacade::orders());
        $this->assertInstanceOf(Exchange::class, BambooFacade::exchange());
        $this->assertInstanceOf(Transactions::class, BambooFacade::transactions());
        $this->assertInstanceOf(Notifications::class, BambooFacade::notifications());
    }

    /**
     * Test facade accessor
     */
    public function testFacadeAccessor()
    {
        // Test that the facade is properly registered
        $this->assertInstanceOf(Bamboo::class, BambooFacade::getFacadeRoot());
    }
}
