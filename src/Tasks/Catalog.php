<?php

namespace vahidkaargar\BambooCardPortal\Tasks;

use vahidkaargar\BambooCardPortal\Bamboo;

class Catalog extends Bamboo
{
    public function get()
    {
        $catalog = $this->http->get('catalog');
        return $this->api->collect($catalog);
    }
}