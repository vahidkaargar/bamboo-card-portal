<?php

namespace vahidkaargar\BambooCardPortal;

use vahidkaargar\BambooCardPortal\Tasks\{Account, Catalog, Order, Exchange, Transactions, Notification};

class Bamboo extends AbstractBamboo
{
    public function catalogs(): Catalog
    {
        return new Catalog();
    }

    public function account(): Account
    {
        return new Account();
    }

    public function orders(): Order
    {
        return new Order();
    }

    public function exchange(): Exchange
    {
        return new Exchange();
    }

    public function transactions(): Transactions
    {
        return new Transactions();
    }

    public function notification(): Notification
    {
        return new Notification();
    }
}