<?php

namespace vahidkaargar\BambooCardPortal\Tasks;

use Illuminate\Support\Collection;

class Notification extends Task
{
    public function get(): Collection
    {
        $request = $this->http->get('notification');
        return $this->api->collect($request);
    }
}