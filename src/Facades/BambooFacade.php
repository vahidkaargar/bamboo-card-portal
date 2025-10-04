<?php

namespace vahidkaargar\BambooCardPortal\Facades;

use Illuminate\Support\Facades\Facade;
use vahidkaargar\BambooCardPortal\Bamboo;
use vahidkaargar\BambooCardPortal\Tasks\{Accounts, Catalogs, Exchange, Notifications, Orders, Transactions};
/**
 * Bamboo Facade
 * 
 * @method static Catalogs catalogs()
 * @method static Accounts accounts()
 * @method static Orders orders()
 * @method static Exchange exchange()
 * @method static Transactions transactions()
 * @method static Notifications notifications()
 * @method static Bamboo version2()
 * 
 * @see Bamboo
 */
class BambooFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'bamboo';
    }
}
