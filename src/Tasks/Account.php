<?php

namespace vahidkaargar\BambooCardPortal\Tasks;


use Illuminate\Support\Collection;

class Account extends Task
{
    public function get(): Collection
    {
        $request = $this->http->get('accounts');
        return $this->api->collect($request);
    }
}