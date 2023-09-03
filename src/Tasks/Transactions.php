<?php

namespace vahidkaargar\BambooCardPortal\Tasks;

use Illuminate\Support\Collection;

class Transactions extends Task
{
    private string $startDate;
    private string $endDate;

    public function get(): Collection
    {
        $request = $this->http->get('transactions', ['startDate' => $this->getStartDate(), 'endDate' => $this->getEndDate()]);
        return $this->api->collect($request);
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