<?php

namespace vahidkaargar\BambooCardPortal;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Josantonius\HttpStatusCode\HttpStatusCode;
use Illuminate\Support\Facades\Config;

class Api
{
    public function http(): PendingRequest
    {
        if (is_null(config('bamboo.sandbox_base_url'))) {
            $configs = require(__DIR__ . '/../config/bamboo.php');
            Config::set('bamboo', $configs);
        }
        $deployment = 'bamboo.' . (\config('bamboo.sandbox_mode') ? 'sandbox' : 'production');
        return Http::acceptJson()
            ->baseUrl(\config($deployment . '_base_url'))
            ->withBasicAuth(\config($deployment . '_username'), \config($deployment . '_password'));
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
     * @param null $body
     * @return Collection
     */
    public function failed(int $status = 400, $body = []): Collection
    {
        return collect([
            "success" => false,
            "status" => $status,
            "message" => $this->messages($status),
            "body" => $body
        ]);
    }

    public function messages($status): string
    {
        $httpStatusCode = new HttpStatusCode();
        $messages = $httpStatusCode->getMessages();;

        return $messages[$status] ?? 'N/A';
    }
}