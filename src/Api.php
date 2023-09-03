<?php

namespace vahidkaargar\BambooCardPortal;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

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
                "data" => $response->collect()->toArray()
            ]);
        }

        return $this->failed('Connect to server has been failed',);
    }

    /**
     * @param string $message
     * @param int $status
     * @return Collection
     */
    public function failed(string $message, int $status = 400): Collection
    {
        return collect([
            "success" => false,
            "status" => $status,
            "message" => $this->messages($status),
            "data" => null
        ]);
    }

    public function messages($status): string
    {
        $messages = [
            '400' => 'Bad request'
        ];

        return $messages[(string)$status] ?? 'N/A';
    }
}