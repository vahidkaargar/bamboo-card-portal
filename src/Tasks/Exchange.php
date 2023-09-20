<?php

namespace vahidkaargar\BambooCardPortal\Tasks;

use Illuminate\Support\Collection;
use vahidkaargar\BambooCardPortal\Bamboo;

/**
 * Exchange class
 */
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
     * @return Collection
     */
    public function rate(): Collection
    {
        $exchange = $this->http->get('exchange-rates', ['baseCurrency' => $this->getBaseCurrency(), 'currency' => $this->getCurrency()]);
        return $this->collect($exchange);

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