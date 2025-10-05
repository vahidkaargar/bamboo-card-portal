<?php


use vahidkaargar\BambooCardPortal\Bamboo;
use vahidkaargar\BambooCardPortal\Exceptions\ConfigurationException;

if (!function_exists('bamboo')) {
    /**
     * @param string $username
     * @param string $password
     * @param bool $sandbox
     * @return Bamboo
     * @throws ConfigurationException
     */
    function bamboo(string $username = '', string $password = '', bool $sandbox = false): Bamboo
    {
        return new vahidkaargar\BambooCardPortal\Bamboo($username, $password, $sandbox);
    }
}