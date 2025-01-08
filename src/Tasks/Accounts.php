<?php

namespace vahidkaargar\BambooCardPortal\Tasks;

use Illuminate\Support\Collection;
use vahidkaargar\BambooCardPortal\Bamboo;

class Accounts extends Bamboo
{
    /**
     * @return Collection
     */
    public function get(): Collection
    {
        $accounts = $this->http->get('accounts');
        return $this->collect($accounts);
    }
}