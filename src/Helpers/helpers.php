<?php


use vahidkaargar\BambooCardPortal\Bamboo;

if (!function_exists('bamboo')) {
    /**
     * @param string $username
     * @param string $password
     * @param bool $sandbox
     * @return Bamboo
     */
    function bamboo(string $username = '', string $password = '', bool $sandbox = false): Bamboo
    {
        return new vahidkaargar\BambooCardPortal\Bamboo($username, $password, $sandbox);
    }
}