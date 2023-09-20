<?php

namespace vahidkaargar\BambooCardPortal\Tasks;

use Illuminate\Support\Collection;
use vahidkaargar\BambooCardPortal\Bamboo;

/**
 * Transactions class
 */
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
     * @return Collection
     */
    public function get(): Collection
    {
        $transactions = $this->http->get('transactions', ['startDate' => $this->getStartDate(), 'endDate' => $this->getEndDate()]);
        return $this->collect($transactions);
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