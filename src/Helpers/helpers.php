<?php


if (!function_exists('bamboo')) {
    function bamboo(string $username = '', string $password = '', bool $sandbox = false)
    {
        return new vahidkaargar\BambooCardPortal\Bamboo($username, $password, $sandbox);
    }
}