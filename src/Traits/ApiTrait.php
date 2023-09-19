<?php

namespace vahidkaargar\BambooCardPortal\Traits;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Josantonius\HttpStatusCode\HttpStatusCode;

trait ApiTrait
{
    public function http(array $configs): PendingRequest
    {
        return Http::acceptJson()
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
                "body" => $response->collect()->toArray()
            ]);
        }

        return $this->failed($response->getStatusCode(), $response->json() ?? []);
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

    private function messages($status): string
    {
        $httpStatusCode = new HttpStatusCode();
        $messages = $httpStatusCode->getMessages();;

        return $messages[$status] ?? 'N/A';
    }
}