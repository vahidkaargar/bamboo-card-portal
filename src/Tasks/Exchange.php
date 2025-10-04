<?php

namespace vahidkaargar\BambooCardPortal\Tasks;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Collection;
use vahidkaargar\BambooCardPortal\Bamboo;
use vahidkaargar\BambooCardPortal\Services\CacheService;

class Exchange extends Bamboo
{
    /**
     * @var string
     */
    private string $baseCurrency;
    /**
     * @var string
     */
    private string $currency;

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
    public function rate(): Collection
    {
        $cacheKey = 'exchange_rate_' . $this->getBaseCurrency() . '_' . $this->getCurrency();
        
        return $this->cacheService->remember($cacheKey, function () {
            $exchange = $this->http->get('exchange-rates', ['baseCurrency' => $this->getBaseCurrency(), 'currency' => $this->getCurrency()]);
            return $this->collect($exchange);
        });
    }

    /**
     * @param string $currency
     * @return $this
     */
    public function setBaseCurrency(string $currency): Exchange
    {
        $this->baseCurrency = $currency;
        return $this;
    }

    /**
     * @return string
     */
    private function getBaseCurrency(): string
    {
        return $this->baseCurrency;
    }

    /**
     * @param string $currency
     * @return $this
     */
    public function setCurrency(string $currency): Exchange
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return string
     */
    private function getCurrency(): string
    {
        return $this->currency;
    }
}