<?php

namespace vahidkaargar\BambooCardPortal\Interfaces;

use vahidkaargar\BambooCardPortal\Tasks\{Accounts, Catalogs, Exchange, Notifications, Orders, Transactions};

/**
 * Bamboo interface
 */
interface BambooInterface
{
    /**
     * @return mixed
     */
    public function catalogs(): Catalogs;

    /**
     * @return mixed
     */
    public function accounts(): Accounts;

    /**
     * @return mixed
     */
    public function orders(): Orders;

    /**
     * @return mixed
     */
    public function exchange(): Exchange;

    /**
     * @return mixed
     */
    public function transactions(): Transactions;

    /**
     * @return mixed
     */
    public function notifications(): Notifications;
}