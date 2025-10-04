<?php

namespace vahidkaargar\BambooCardPortal\Exceptions;

/**
 * Exception thrown when configuration is invalid or missing
 */
class ConfigurationException extends BambooException
{
    /**
     * @param string $message
     * @param array $context
     */
    public function __construct(string $message = 'Configuration error', array $context = [])
    {
        parent::__construct($message, 500, null, $context);
    }
}
