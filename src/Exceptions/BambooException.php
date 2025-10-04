<?php

namespace vahidkaargar\BambooCardPortal\Exceptions;

use Exception;

/**
 * Base exception class for Bamboo Card Portal
 */
class BambooException extends Exception
{
    /**
     * @var array
     */
    protected array $context = [];

    /**
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     * @param array $context
     */
    public function __construct(string $message = '', int $code = 0, Exception $previous = null, array $context = [])
    {
        parent::__construct($message, $code, $previous);
        $this->context = $context;
    }

    /**
     * Get the exception context
     *
     * @return array
     */
    public function getContext(): array
    {
        return $this->context;
    }

    /**
     * Set the exception context
     *
     * @param array $context
     * @return self
     */
    public function setContext(array $context): self
    {
        $this->context = $context;
        return $this;
    }
}
