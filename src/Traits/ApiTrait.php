<?php

namespace vahidkaargar\BambooCardPortal\Traits;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Josantonius\HttpStatusCode\HttpStatusCode;
use vahidkaargar\BambooCardPortal\Exceptions\{
    AuthenticationException,
    NetworkException,
    ResourceNotFoundException,
    ValidationException
};
use vahidkaargar\BambooCardPortal\Services\CacheService;

trait ApiTrait
{
    /**
     * @var CacheService|null
     */
    protected ?CacheService $cacheService = null;

    /**
     * @param array $configs
     * @return PendingRequest
     */
    public function http(array $configs): PendingRequest
    {
        return Http::acceptJson()
            ->timeout(config('bamboo.connection_timeout'))
            ->baseUrl($configs['baseUrl'])
            ->withBasicAuth($configs['username'], $configs['password']);
    }

    /**
     * @param $response
     * @return Collection
     */
    public function collect($response): Collection
    {
        if ($response->successful()) {
            return collect([
                "success" => true,
                "status" => $response->getStatusCode(),
                "message" => $this->messages($response->getStatusCode()),
                "body" => $response->collect()
            ]);
        }

        return $this->handleFailedResponse($response);
    }

    /**
     * Handle failed response with appropriate exceptions
     *
     * @param $response
     * @return Collection
     * @throws AuthenticationException
     * @throws NetworkException
     * @throws ResourceNotFoundException
     * @throws ValidationException
     */
    private function handleFailedResponse($response): Collection
    {
        $status = $response->getStatusCode();
        $body = $response->json() ?? [];

        switch ($status) {
            case 401:
                throw new AuthenticationException(
                    'Authentication failed. Please check your credentials.',
                    ['response' => $body]
                );
            case 404:
                throw new ResourceNotFoundException(
                    'The requested resource was not found.',
                    ['response' => $body]
                );
            case 422:
                throw new ValidationException(
                    'Validation failed.',
                    $body['errors'] ?? [],
                    ['response' => $body]
                );
            case 500:
            case 502:
            case 503:
            case 504:
                throw new NetworkException(
                    'Server error occurred.',
                    $status,
                    ['response' => $body]
                );
            default:
                throw new NetworkException(
                    'Request failed with status: ' . $status,
                    $status,
                    ['response' => $body]
                );
        }
    }

    /**
     * @param int $status
     * @param array|null $body
     * @return Collection
     */
    private function failed(int $status = 400, ?array $body = []): Collection
    {
        return collect([
            "success" => false,
            "status" => $status,
            "message" => $this->messages($status),
            "body" => $body
        ]);
    }

    /**
     * @param $status
     * @return string
     */
    private function messages($status): string
    {
        $httpStatusCode = new HttpStatusCode();
        $messages = $httpStatusCode->getMessages();

        return $messages[$status] ?? 'N/A';
    }

    /**
     * Get cache service instance
     *
     * @return CacheService
     */
    protected function getCacheService(): CacheService
    {
        if ($this->cacheService === null) {
            $this->cacheService = new CacheService();
        }

        return $this->cacheService;
    }

    /**
     * Make cached request
     *
     * @param string $cacheKey
     * @param callable $callback
     * @param int|null $ttl
     * @return mixed
     */
    protected function cachedRequest(string $cacheKey, callable $callback, ?int $ttl = null): mixed
    {
        $cacheService = $this->getCacheService();
        
        if (!$cacheService->isEnabled()) {
            return $callback();
        }

        return $cacheService->remember($cacheKey, $callback, $ttl);
    }
}