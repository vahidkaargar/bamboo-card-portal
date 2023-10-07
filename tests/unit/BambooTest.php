<?php

namespace vahidkaargar\BambooCardPortal\Tests\Unit;

use Orchestra\Testbench\TestCase;
use vahidkaargar\BambooCardPortal\Bamboo;
use vahidkaargar\BambooCardPortal\Tasks\{Accounts, Catalogs, Exchange, Notifications, Orders, Transactions};

/**
 * Bamboo class test
 */
class BambooTest extends TestCase
{
    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->bamboo = new Bamboo();
    }

    /**
     * @return void
     */
    public function testCatalogsMethodReturnsCatalogInstance()
    {
        $this->assertInstanceOf(Catalogs::class, $this->bamboo->catalogs());
    }

    /**
     * @return void
     */
    public function testAccountMethodReturnsAccountInstance()
    {
        $this->assertInstanceOf(Accounts::class, $this->bamboo->accounts());
    }

    /**
     * @return void
     */
    public function testOrdersMethodReturnsOrderInstance()
    {
        $this->assertInstanceOf(Orders::class, $this->bamboo->orders());
    }

    /**
     * @return void
     */
    public function testExchangeMethodReturnsExchangeInstance()
    {
        $this->assertInstanceOf(Exchange::class, $this->bamboo->exchange());
    }

    /**
     * @return void
     */
    public function testTransactionsMethodReturnsTransactionsInstance()
    {
        $this->assertInstanceOf(Transactions::class, $this->bamboo->transactions());
    }

    /**
     * @return void
     */
    public function testNotificationsMethodReturnsNotificationInstance()
    {
        $this->assertInstanceOf(Notifications::class, $this->bamboo->notifications());
    }
}
