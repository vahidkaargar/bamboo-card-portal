<?php

namespace vahidkaargar\BambooCardPortal;

use Illuminate\Http\Client\PendingRequest;
use vahidkaargar\BambooCardPortal\Exceptions\ConfigurationException;
use vahidkaargar\BambooCardPortal\Interfaces\{BambooInterface};
use vahidkaargar\BambooCardPortal\Tasks\{Accounts, Catalogs, Exchange, Notifications, Orders, Transactions};
use vahidkaargar\BambooCardPortal\Traits\{ApiTrait, ConfigTrait};

class Bamboo implements BambooInterface
{
    use ApiTrait, ConfigTrait;

    protected PendingRequest $http;
    private string $username;
    private string $password;
    private bool $sandbox;
    private string $baseUrl;
    private string $deployment;

    /**
     * @param string $username
     * @param string $password
     * @param bool $sandbox
     * @throws ConfigurationException
     */
    public function __construct(string $username = '', string $password = '', bool $sandbox = false)
    {
        // load configs
        $this->loadConfig();

        // sandbox or production
        $this->sandbox = ($username and $password) ? $sandbox : config('bamboo.sandbox_mode');
        $this->deployment = $this->sandbox ? 'sandbox' : 'production';

        // basic auth
        if ($username and $password) {
            $this->username = $username;
            $this->password = $password;
        } else {
            $this->username = config("bamboo.{$this->deployment}_username") ?? '';
            $this->password = config("bamboo.{$this->deployment}_password") ?? '';
        }

        // sandbox/production base url address
        $this->baseUrl = config("bamboo.{$this->deployment}_base_url") ?? '';

        // Validate configuration
        $this->validateConfiguration();

        // create PendingRequest
        $this->http = $this->http([
            'username' => $this->username,
            'password' => $this->password,
            'baseUrl' => $this->baseUrl,
        ]);
    }

    /**
     * Validate configuration
     *
     * @throws ConfigurationException
     */
    private function validateConfiguration(): void
    {
        if (empty($this->username) || empty($this->password)) {
            throw new ConfigurationException(
                'Bamboo credentials are not configured. Please set your username and password.',
                [
                    'deployment' => $this->deployment,
                    'sandbox' => $this->sandbox
                ]
            );
        }

        if (empty($this->baseUrl)) {
            throw new ConfigurationException(
                'Bamboo base URL is not configured.',
                [
                    'deployment' => $this->deployment,
                    'sandbox' => $this->sandbox
                ]
            );
        }
    }

    /**
     * @return Bamboo
     */
    public function version2(): Bamboo
    {
        $this->baseUrl = config("bamboo.{$this->deployment}_v2_base_url") ?? '';

        $this->http = $this->http([
            'username' => $this->username,
            'password' => $this->password,
            'baseUrl' => $this->baseUrl,
        ]);
        return $this;
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