<?php

namespace vahidkaargar\BambooCardPortal\Exceptions;

/**
 * Exception thrown when a requested resource is not found
 */
class ResourceNotFoundException extends BambooException
{
    /**
     * @param string $message
     * @param array $context
     */
    public function __construct(string $message = 'Resource not found', array $context = [])
    {
        parent::__construct($message, 404, null, $context);
    }
}
