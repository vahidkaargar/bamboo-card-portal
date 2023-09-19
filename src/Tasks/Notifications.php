<?php

namespace vahidkaargar\BambooCardPortal\Tasks;

use Illuminate\Support\Collection;
use vahidkaargar\BambooCardPortal\Bamboo;

/**
 * Notification class
 */
class Notifications extends Bamboo
{
    /**
     * @return Collection
     */
    public function get(): Collection
    {
        $notification = $this->http->get('notification');
        return $this->collect($notification);
    }
}