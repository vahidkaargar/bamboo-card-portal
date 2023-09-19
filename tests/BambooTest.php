<?php

namespace vahidkaargar\BambooCardPortal\Tests;

use Orchestra\Testbench\TestCase;
use vahidkaargar\BambooCardPortal\Bamboo;
use vahidkaargar\BambooCardPortal\Tasks\{
    Catalog,
    Account,
    Order,
    Exchange,
    Transactions,
    Notification
};

class BambooTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->bamboo = new Bamboo();
    }

    public function testCatalogsMethodReturnsCatalogInstance()
    {
        $this->assertInstanceOf(Catalog::class, $this->bamboo->catalogs());
    }

    public function testAccountMethodReturnsAccountInstance()
    {
        $this->assertInstanceOf(Account::class, $this->bamboo->account());
    }

    public function testOrdersMethodReturnsOrderInstance()
    {
        $this->assertInstanceOf(Order::class, $this->bamboo->orders());
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
        $this->assertInstanceOf(Notification::class, $this->bamboo->notifications());
    }
}
