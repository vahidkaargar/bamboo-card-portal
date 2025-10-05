<?php

namespace vahidkaargar\BambooCardPortal\Tests\Unit\Exceptions;

use vahidkaargar\BambooCardPortal\Tests\TestCase;
use vahidkaargar\BambooCardPortal\Exceptions\ValidationException;

/**
 * ValidationException test
 */
class ValidationExceptionTest extends TestCase
{
    /**
     * Test validation exception with errors
     */
    public function testValidationExceptionWithErrors()
    {
        $errors = ['field' => ['is required']];
        $context = ['response' => ['errors' => $errors]];
        $exception = new ValidationException('Validation failed', $errors, $context);

        $this->assertEquals('Validation failed', $exception->getMessage());
        $this->assertEquals(422, $exception->getCode());
        $this->assertEquals($errors, $exception->getErrors());
        $this->assertEquals($context, $exception->getContext());
    }

    /**
     * Test setting errors
     */
    public function testSetErrors()
    {
        $exception = new ValidationException();
        $errors = ['new' => ['error']];
        
        $exception->setErrors($errors);
        
        $this->assertEquals($errors, $exception->getErrors());
    }
}
