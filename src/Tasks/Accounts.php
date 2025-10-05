<?php

namespace vahidkaargar\BambooCardPortal\Tasks;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Collection;
use vahidkaargar\BambooCardPortal\Bamboo;
use vahidkaargar\BambooCardPortal\Services\CacheService;

class Accounts extends Bamboo
{
    /**
     * @var CacheService|null
     */
    protected ?CacheService $cacheService;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->cacheService = app(CacheService::class);
    }

    /**
     * @return Collection
     * @throws ConnectionException
     */
    public function get(): Collection
    {
        $cacheKey = 'accounts';
        
        return $this->cacheService->remember($cacheKey, function () {
            $accounts = $this->http->get('accounts');
            return $this->collect($accounts);
        });
    }
}