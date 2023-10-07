<?php

namespace vahidkaargar\BambooCardPortal;

use Illuminate\Http\Client\PendingRequest;
use vahidkaargar\BambooCardPortal\Interfaces\{BambooInterface};
use vahidkaargar\BambooCardPortal\Tasks\{Accounts, Catalogs, Exchange, Notifications, Orders, Transactions};
use vahidkaargar\BambooCardPortal\Traits\{ApiTrait, ConfigTrait};

/**
 * Bamboo class
 */
class Bamboo implements BambooInterface
{
    use ApiTrait, ConfigTrait;

    protected PendingRequest $http;
    private string $username;
    private string $password;
    private bool $sandbox;
    private string $baseUrl;

    /**
     * @param string $username
     * @param string $password
     * @param bool $sandbox
     */
    public function __construct(string $username = '', string $password = '', bool $sandbox = false)
    {
        // load configs
        $this->loadConfig();

        // sandbox or production
        $this->sandbox = ($username and $password) ? $sandbox : config('bamboo.sandbox_mode');
        $deployment = "bamboo." . ($this->sandbox ? 'sandbox' : 'production');

        // basic auth
        if ($username and $password) {
            $this->username = $username;
            $this->password = $password;
        } else {
            $this->username = config("{$deployment}_username");
            $this->password = config("{$deployment}_password");
        }

        // sandbox/production base url address
        $this->baseUrl = config("{$deployment}_base_url");

        // create PendingRequest
        $this->http = $this->http([
            'username' => $this->username,
            'password' => $this->password,
            'baseUrl' => $this->baseUrl,
        ]);
    }

    /**
     * @return Catalogs
     */
    public function catalogs(): Catalogs
    {
        return new Catalogs();
    }

    /**
     * @return Accounts
     */
    public function accounts(): Accounts
    {
        return new Accounts();
    }

    /**
     * @return Orders
     */
    public function orders(): Orders
    {
        return new Orders();
    }

    /**
     * @return Exchange
     */
    public function exchange(): Exchange
    {
        return new Exchange();
    }

    /**
     * @return Transactions
     */
    public function transactions(): Transactions
    {
        return new Transactions();
    }

    /**
     * @return Notifications
     */
    public function notifications(): Notifications
    {
        return new Notifications();
    }
}