<?php

namespace vahidkaargar\BambooCardPortal\Tasks;

use Illuminate\Support\Collection;
use vahidkaargar\BambooCardPortal\Bamboo;

class Exchange extends Bamboo
{
    private string $baseCurrency;
    private string $currency;

    public function rate(): Collection
    {
        $exchange = $this->http->get('exchange-rates', ['baseCurrency' => $this->getBaseCurrency(), 'currency' => $this->getCurrency()]);
        return $this->api->collect($exchange);

    }

    public function setBaseCurrency(string $currency): Exchange
    {
        $this->baseCurrency = $currency;
        return $this;
    }

    private function getBaseCurrency(): string
    {
        return $this->baseCurrency;
    }

    public function setCurrency(string $currency): Exchange
    {
        $this->currency = $currency;
        return $this;
    }

    private function getCurrency(): string
    {
        return $this->currency;
    }
}