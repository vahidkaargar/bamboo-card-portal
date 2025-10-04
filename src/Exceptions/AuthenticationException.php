<?php

namespace vahidkaargar\BambooCardPortal\Exceptions;

/**
 * Exception thrown when authentication fails
 */
class AuthenticationException extends BambooException
{
    /**
     * @param string $message
     * @param array $context
     */
    public function __construct(string $message = 'Authentication failed', array $context = [])
    {
        parent::__construct($message, 401, null, $context);
    }
}
