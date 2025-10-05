<?php

namespace vahidkaargar\BambooCardPortal\Tests\Unit\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use vahidkaargar\BambooCardPortal\Tests\TestCase;
use vahidkaargar\BambooCardPortal\Services\CacheService;

/**
 * CacheService test
 */
class CacheServiceTest extends TestCase
{
    /**
     * @var CacheService
     */
    protected CacheService $cacheService;

    /**
     * Setup test
     */
    protected function setUp(): void
    {
        parent::setUp();
        
        Config::set('bamboo.cache', [
            'enabled' => true,
            'driver' => 'array',
            'prefix' => 'bamboo_test',
            'ttl' => 3600,
        ]);
        
        $this->cacheService = new CacheService();
    }

    /**
     * Test cache key generation
     */
    public function testGetCacheKey()
    {
        $key = $this->cacheService->getCacheKey('test_key');
        $this->assertEquals('bamboo_test:test_key', $key);
    }

    /**
     * Test cache put and get
     */
    public function testPutAndGet()
    {
        $this->cacheService->put('test_key', 'test_value', 60);
        $value = $this->cacheService->get('test_key');
        
        $this->assertEquals('test_value', $value);
    }

    /**
     * Test cache with default TTL
     */
    public function testPutWithDefaultTtl()
    {
        $this->cacheService->put('test_key', 'test_value');
        $value = $this->cacheService->get('test_key');
        
        $this->assertEquals('test_value', $value);
    }

    /**
     * Test cache forget
     */
    public function testForget()
    {
        $this->cacheService->put('test_key', 'test_value');
        $this->cacheService->forget('test_key');
        $value = $this->cacheService->get('test_key');
        
        $this->assertNull($value);
    }

    /**
     * Test remember method
     */
    public function testRemember()
    {
        $value = $this->cacheService->remember('test_key', function () {
            return 'computed_value';
        });
        
        $this->assertEquals('computed_value', $value);
        
        // Second call should return cached value
        $cachedValue = $this->cacheService->remember('test_key', function () {
            return 'should_not_be_called';
        });
        
        $this->assertEquals('computed_value', $cachedValue);
    }

    /**
     * Test cache when disabled
     */
    public function testCacheWhenDisabled()
    {
        Config::set('bamboo.cache.enabled', false);
        $cacheService = new CacheService();
        
        $this->assertFalse($cacheService->isEnabled());
        $this->assertFalse($cacheService->put('test_key', 'test_value'));
        $this->assertNull($cacheService->get('test_key'));
    }

    /**
     * Test is enabled
     */
    public function testIsEnabled()
    {
        $this->assertTrue($this->cacheService->isEnabled());
    }

    /**
     * Test get TTL
     */
    public function testGetTtl()
    {
        $this->assertEquals(3600, $this->cacheService->getTtl());
    }
}
