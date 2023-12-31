<?php

namespace vahidkaargar\BambooCardPortal\Tests\Unit;

use Illuminate\Support\Collection;
use Orchestra\Testbench\TestCase;
use vahidkaargar\BambooCardPortal\Bamboo;

/**
 * Api trait test
 */
class ApiTraitTest extends TestCase
{
    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->bamboo = new Bamboo();
    }

    /**
     * @return void
     */
    public function testIsApiResponseSuitable()
    {
        $request = $this->bamboo->http([
            "username" => 'test',
            "password" => 'test',
            "baseUrl" => 'https://api.bamboocardportal.com/api/integration/v1.0/'
        ])->get('accounts');
        $response = $this->bamboo->collect($request);
        $this->assertInstanceOf(Collection::class, $response);
        $this->assertArrayHasKey('success', $response);
        $this->assertArrayHasKey('status', $response);
        $this->assertArrayHasKey('message', $response);
        $this->assertArrayHasKey('body', $response);
    }
}
