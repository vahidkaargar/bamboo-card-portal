<?php

namespace vahidkaargar\BambooCardPortal\Tasks;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Collection;
use vahidkaargar\BambooCardPortal\Bamboo;

class Notifications extends Bamboo
{
    /**
     * @var string
     */
    protected string $notificationUrl;
    /**
     * @var string
     */
    protected string $secretKey;

    /**
     * @return Collection
     * @throws ConnectionException
     */
    public function get(): Collection
    {
        $notification = $this->http->get('notification');
        return $this->collect($notification);
    }

    /**
     * @return Collection
     * @throws ConnectionException
     */
    public function create(): Collection
    {
        $payload = [
            'notificationUrl' => $this->getNotificationUrl(),
            'secretKey' => $this->getSecretKey()
        ];
        $createNotification = $this->http->post('notification', $payload);
        return $this->collect($createNotification);
    }

    /**
     * @return string
     */
    private function getNotificationUrl(): string
    {
        return $this->notificationUrl;
    }

    /**
     * @param string $notificationUrl
     * @return $this
     */
    public function setNotificationUrl(string $notificationUrl): Notifications
    {
        $this->notificationUrl = $notificationUrl;
        return $this;
    }

    /**
     * @return string
     */
    private function getSecretKey(): string
    {
        return $this->secretKey;
    }

    /**
     * @param string $secretKey
     * @return $this
     */
    public function setSecretKey(string $secretKey): Notifications
    {
        $this->secretKey = $secretKey;
        return $this;
    }
}