<?php

namespace vahidkaargar\BambooCardPortal\Tests;

use Illuminate\Support\Collection;
use Orchestra\Testbench\TestCase;
use vahidkaargar\BambooCardPortal\Bamboo;

class ApiTest extends TestCase
{
    public function testIsApiResponseSuitable()
    {
        $response = (new Bamboo())->account()->get();
        $this->assertInstanceOf(Collection::class, $response);
        $this->assertArrayHasKey('success', $response);
        $this->assertArrayHasKey('status', $response);
        $this->assertArrayHasKey('message', $response);
        $this->assertArrayHasKey('body', $response);
    }
}
