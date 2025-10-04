<?php

namespace vahidkaargar\BambooCardPortal\Tasks;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Collection;
use vahidkaargar\BambooCardPortal\Bamboo;

class Accounts extends Bamboo
{
    /**
     * @return Collection
     * @throws ConnectionException
     */
    public function get(): Collection
    {
        $accounts = $this->http->get('accounts');
        return $this->collect($accounts);
    }
}