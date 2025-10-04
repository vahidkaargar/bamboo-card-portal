<?php

namespace vahidkaargar\BambooCardPortal\Exceptions;

/**
 * Exception thrown when network requests fail
 */
class NetworkException extends BambooException
{
    /**
     * @param string $message
     * @param int $code
     * @param array $context
     */
    public function __construct(string $message = 'Network request failed', int $code = 0, array $context = [])
    {
        parent::__construct($message, $code, null, $context);
    }
}
