<?php

namespace vahidkaargar\BambooCardPortal\Exceptions;

/**
 * Exception thrown when validation fails
 */
class ValidationException extends BambooException
{
    /**
     * @var array
     */
    protected array $errors = [];

    /**
     * @param string $message
     * @param array $errors
     * @param array $context
     */
    public function __construct(string $message = 'Validation failed', array $errors = [], array $context = [])
    {
        parent::__construct($message, 422, null, $context);
        $this->errors = $errors;
    }

    /**
     * Get validation errors
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Set validation errors
     *
     * @param array $errors
     * @return self
     */
    public function setErrors(array $errors): self
    {
        $this->errors = $errors;
        return $this;
    }
}
