<?php

namespace vahidkaargar\BambooCardPortal\Tasks;

use Illuminate\Support\Collection;
use vahidkaargar\BambooCardPortal\Bamboo;

class Transactions extends Bamboo
{
    private string $startDate;
    private string $endDate;

    public function get(): Collection
    {
        return $this->http->get('transactions', ['startDate' => $this->getStartDate(), 'endDate' => $this->getEndDate()]);
    }

    public function setStartDate(string $date): Transactions
    {
        $this->startDate = $date;
        return $this;
    }

    private function getStartDate(): string
    {
        return $this->startDate;
    }

    public function setEndDate(string $date): Transactions
    {
        $this->endDate = $date;
        return $this;
    }

    private function getEndDate(): string
    {
        return $this->endDate;
    }
}