<?php

namespace vahidkaargar\BambooCardPortal\Tasks;

use Illuminate\Support\Collection;
use vahidkaargar\BambooCardPortal\Bamboo;

class Notifications extends Bamboo
{
    public function get(): Collection
    {
        $notification = $this->http->get('notification');
        return $this->collect($notification);
    }
}