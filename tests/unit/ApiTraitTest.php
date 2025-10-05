<?php

namespace vahidkaargar\BambooCardPortal\Tests\Unit;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use vahidkaargar\BambooCardPortal\Tests\TestCase;
use vahidkaargar\BambooCardPortal\Bamboo;

/**
 * Api trait test
 */
class ApiTraitTest extends TestCase
{
    /**
     * @var Bamboo
     */
    protected Bamboo $bamboo;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->bamboo = new Bamboo('test_user', 'test_pass', true);
    }

    /**
     * @return void
     */
    public function testIsApiResponseSuitable()
    {
        // Mock the HTTP response
        Http::fake([
            'https://api-test.example.com/*' => Http::response([
                'success' => true,
                'status' => 200,
                'message' => 'Success',
                'body' => [
                    'data' => 'test data'
                ]
            ], 200)
        ]);

        $request = $this->bamboo->http([
            "username" => 'test',
            "password" => 'test',
            "baseUrl" => 'https://api-test.example.com/api/integration/v1.0/'
        ])->get('accounts');
        
        $response = $this->bamboo->collect($request);
        $this->assertInstanceOf(Collection::class, $response);
        $this->assertArrayHasKey('success', $response);
        $this->assertArrayHasKey('status', $response);
        $this->assertArrayHasKey('message', $response);
        $this->assertArrayHasKey('body', $response);
    }
}
