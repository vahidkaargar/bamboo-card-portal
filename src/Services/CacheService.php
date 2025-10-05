<?php

namespace vahidkaargar\BambooCardPortal\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Psr\SimpleCache\InvalidArgumentException;

/**
 * Cache service for Bamboo Card Portal
 */
class CacheService
{
    /**
     * @var string
     */
    protected string $prefix;

    /**
     * @var int
     */
    protected int $defaultTtl;

    /**
     * @var bool
     */
    protected bool $enabled;

    /**
     * @var string
     */
    protected string $driver;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->prefix = Config::get('bamboo.cache.prefix', 'bamboo');
        $this->defaultTtl = Config::get('bamboo.cache.ttl', 3600);
        $this->enabled = Config::get('bamboo.cache.enabled', true);
        $this->driver = Config::get('bamboo.cache.driver', 'default');
    }

    /**
     * Get cache key
     *
     * @param string $key
     * @return string
     */
    public function getCacheKey(string $key): string
    {
        return $this->prefix . ':' . $key;
    }

    /**
     * Get cached data
     *
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function get(string $key, mixed $default = null)
    {
        if (!$this->enabled) {
            return $default;
        }

        return Cache::driver($this->driver)->get($this->getCacheKey($key), $default);
    }

    /**
     * Store data in cache
     *
     * @param string $key
     * @param mixed $value
     * @param int|null $ttl
     * @return bool
     */
    public function put(string $key, mixed $value, ?int $ttl = null): bool
    {
        if (!$this->enabled) {
            return false;
        }

        $ttl = $ttl ?? $this->defaultTtl;
        
        return Cache::driver($this->driver)->put($this->getCacheKey($key), $value, $ttl);
    }

    /**
     * Store data in cache forever
     *
     * @param string $key
     * @param mixed $value
     * @return bool
     */
    public function forever(string $key, mixed $value): bool
    {
        if (!$this->enabled) {
            return false;
        }

        return Cache::driver($this->driver)->forever($this->getCacheKey($key), $value);
    }

    /**
     * Remove data from cache
     *
     * @param string $key
     * @return bool
     */
    public function forget(string $key): bool
    {
        if (!$this->enabled) {
            return false;
        }

        return Cache::driver($this->driver)->forget($this->getCacheKey($key));
    }

    /**
     * Clear all cache with prefix
     *
     * @return bool
     */
    public function flush(): bool
    {
        if (!$this->enabled) {
            return false;
        }

        return Cache::driver($this->driver)->flush();
    }

    /**
     * Check if cache is enabled
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * Get cache TTL
     *
     * @return int
     */
    public function getTtl(): int
    {
        return $this->defaultTtl;
    }

    /**
     * Remember data with callback
     *
     * @param string $key
     * @param callable $callback
     * @param int|null $ttl
     * @return mixed
     */
    public function remember(string $key, callable $callback, ?int $ttl = null): mixed
    {
        if (!$this->enabled) {
            return $callback();
        }

        $ttl = $ttl ?? $this->defaultTtl;
        
        return Cache::driver($this->driver)->remember($this->getCacheKey($key), $ttl, $callback);
    }
}
