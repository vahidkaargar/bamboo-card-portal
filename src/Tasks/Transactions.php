<?php

namespace vahidkaargar\BambooCardPortal\Tasks;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Collection;
use vahidkaargar\BambooCardPortal\Bamboo;
use vahidkaargar\BambooCardPortal\Services\CacheService;

class Transactions extends Bamboo
{
    /**
     * @var string
     */
    private string $startDate;
    /**
     * @var string
     */
    private string $endDate;

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
        $cacheKey = 'transactions_' . $this->getStartDate() . '_' . $this->getEndDate();
        
        return $this->cacheService->remember($cacheKey, function () {
            $transactions = $this->http->get('transactions', ['startDate' => $this->getStartDate(), 'endDate' => $this->getEndDate()]);
            return $this->collect($transactions);
        });
    }

    /**
     * @param string $date
     * @return $this
     */
    public function setStartDate(string $date): Transactions
    {
        $this->startDate = $date;
        return $this;
    }

    /**
     * @return string
     */
    private function getStartDate(): string
    {
        return $this->startDate;
    }

    /**
     * @param string $date
     * @return $this
     */
    public function setEndDate(string $date): Transactions
    {
        $this->endDate = $date;
        return $this;
    }

    /**
     * @return string
     */
    private function getEndDate(): string
    {
        return $this->endDate;
    }
}