<?php

namespace vahidkaargar\BambooCardPortal\Tasks;

use Illuminate\Support\Collection;
use vahidkaargar\BambooCardPortal\Bamboo;

class Catalogs extends Bamboo
{
    public function get(): Collection
    {
        $catalog = $this->http->get('catalog');
        return $this->collect($catalog);
    }
}