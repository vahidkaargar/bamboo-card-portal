<?php

namespace vahidkaargar\BambooCardPortal\Tests\Unit;

use vahidkaargar\BambooCardPortal\Tests\TestCase;
use vahidkaargar\BambooCardPortal\Bamboo;
use vahidkaargar\BambooCardPortal\Exceptions\ConfigurationException;
use vahidkaargar\BambooCardPortal\Tasks\{Accounts, Catalogs, Exchange, Notifications, Orders, Transactions};

/**
 * Bamboo class test
 */
class BambooTest extends TestCase
{
    /**
     * @var Bamboo
     */
    protected Bamboo $bamboo;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        
        // Mock configuration
        $this->app['config']->set('bamboo', [
            'sandbox_mode' => true,
            'bamboo.sandbox_username' => 'test_user',
            'bamboo.sandbox_password' => 'test_pass',
            'bamboo.sandbox_base_url' => 'https://api-test.example.com',
            'connection_timeout' => 160,
            'cache' => [
                'enabled' => false, // Disable cache for tests
                'driver' => 'array',
                'prefix' => 'bamboo_test',
                'ttl' => 3600,
            ],
        ]);
        
        $this->bamboo = new Bamboo('test_user', 'test_pass', true);
    }

    /**
     * Test catalogs method returns catalog instance
     */
    public function testCatalogsMethodReturnsCatalogInstance()
    {
        $this->assertInstanceOf(Catalogs::class, $this->bamboo->catalogs());
    }

    /**
     * Test accounts method returns account instance
     */
    public function testAccountMethodReturnsAccountInstance()
    {
        $this->assertInstanceOf(Accounts::class, $this->bamboo->accounts());
    }

    /**
     * Test orders method returns order instance
     */
    public function testOrdersMethodReturnsOrderInstance()
    {
        $this->assertInstanceOf(Orders::class, $this->bamboo->orders());
    }

    /**
     * Test exchange method returns exchange instance
     */
    public function testExchangeMethodReturnsExchangeInstance()
    {
        $this->assertInstanceOf(Exchange::class, $this->bamboo->exchange());
    }

    /**
     * Test transactions method returns transactions instance
     */
    public function testTransactionsMethodReturnsTransactionsInstance()
    {
        $this->assertInstanceOf(Transactions::class, $this->bamboo->transactions());
    }

    /**
     * Test notifications method returns notification instance
     */
    public function testNotificationsMethodReturnsNotificationInstance()
    {
        $this->assertInstanceOf(Notifications::class, $this->bamboo->notifications());
    }

    /**
     * Test version2 method
     */
    public function testVersion2Method()
    {
        $result = $this->bamboo->version2();
        $this->assertInstanceOf(Bamboo::class, $result);
    }

    /**
     * Test configuration exception when credentials are missing
     */
    public function testConfigurationExceptionWhenCredentialsMissing()
    {
        $this->app['config']->set('bamboo', [
            'sandbox_mode' => true,
            'sandbox_username' => '',
            'sandbox_password' => '',
            'sandbox_base_url' => 'https://api-test.example.com',
            'connection_timeout' => 160,
        ]);

        $this->expectException(ConfigurationException::class);
        $this->expectExceptionMessage('Bamboo credentials are not configured');
        
        new Bamboo();
    }

    /**
     * Test configuration exception when base URL is missing
     */
    public function testConfigurationExceptionWhenBaseUrlMissing()
    {
        $this->app['config']->set('bamboo', [
            'sandbox_mode' => true,
            'sandbox_username' => 'test_user',
            'sandbox_password' => 'test_pass',
            'sandbox_base_url' => '',
            'connection_timeout' => 160,
        ]);

        $this->expectException(ConfigurationException::class);
        $this->expectExceptionMessage('Bamboo base URL is not configured');
        
        new Bamboo();
    }

    /**
     * Test constructor with explicit credentials
     */
    public function testConstructorWithExplicitCredentials()
    {
        $bamboo = new Bamboo('test_user', 'test_pass', true);
        $this->assertInstanceOf(Bamboo::class, $bamboo);
    }
}
