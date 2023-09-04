<?php

namespace vahidkaargar\BambooCardPortal;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Josantonius\HttpStatusCode\HttpStatusCode;

class Api
{
    public function http()
    {
        return Http::acceptJson()
            ->withBasicAuth(config('bamboo.username'), config('bamboo.password'))
            ->baseUrl(config('bamboo.api_base_url'));
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

        return $this->failed($response->getStatusCode(), $response->json());
    }

    /**
     * @param int $status
     * @param null $body
     * @return Collection
     */
    public function failed(int $status = 400, $body = null): Collection
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