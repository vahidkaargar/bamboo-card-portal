<?php

namespace vahidkaargar\BambooCardPortal\Tasks;

class Catalog extends Task
{
    public function get()
    {
        $request = $this->http->get('catalog');
        return $this->api->collect($request);
    }
}