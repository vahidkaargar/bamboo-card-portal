<?php

namespace vahidkaargar\BambooCardPortal;

use vahidkaargar\BambooCardPortal\Tasks\{Account, Catalog, Order, Exchange, Transactions, Notification};
use Illuminate\Support\Collection;

class Bamboo implements InterfaceBamboo
{
    protected Collection $http;
    protected Api $api;

    public function __construct()
    {
        $this->api = new Api();
        $this->http = $this->api->http();
    }

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