<?php

namespace vahidkaargar\BambooCardPortal\Tasks;

use Illuminate\Support\Collection;
use vahidkaargar\BambooCardPortal\Bamboo;

/**
 * Catalogs of products
 */
class Catalogs extends Bamboo
{
    /**
     * @return Collection
     */
    public function get(): Collection
    {
        $catalog = $this->http->get('catalog');
        return $this->collect($catalog);
    }
}