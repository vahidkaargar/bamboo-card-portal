<?php

namespace vahidkaargar\BambooCardPortal\Tests\unit;

use Orchestra\Testbench\TestCase;
use vahidkaargar\BambooCardPortal\Bamboo;
use vahidkaargar\BambooCardPortal\Tasks\{Account, Catalogs, Exchange, Notifications, Orders, Transactions};

class BambooTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->bamboo = new Bamboo();
    }

    public function testCatalogsMethodReturnsCatalogInstance()
    {
        $this->assertInstanceOf(Catalogs::class, $this->bamboo->catalogs());
    }

    public function testAccountMethodReturnsAccountInstance()
    {
        $this->assertInstanceOf(Account::class, $this->bamboo->account());
    }

    public function testOrdersMethodReturnsOrderInstance()
    {
        $this->assertInstanceOf(Orders::class, $this->bamboo->orders());
    }

    public function testExchangeMethodReturnsExchangeInstance()
    {
        $this->assertInstanceOf(Exchange::class, $this->bamboo->exchange());
    }

    public function testTransactionsMethodReturnsTransactionsInstance()
    {
        $this->assertInstanceOf(Transactions::class, $this->bamboo->transactions());
    }

    public function testNotificationsMethodReturnsNotificationInstance()
    {
        $this->assertInstanceOf(Notifications::class, $this->bamboo->notifications());
    }
}
