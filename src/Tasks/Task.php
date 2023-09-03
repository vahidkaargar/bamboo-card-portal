<?php

namespace vahidkaargar\BambooCardPortal\Tasks;

use vahidkaargar\BambooCardPortal\Api;

class Task
{
    protected Api $api;
    protected $http;

    public function __construct()
    {
        $this->api = new Api();
        $this->http = $this->api->http();
    }
}