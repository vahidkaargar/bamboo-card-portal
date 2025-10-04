<?php

namespace vahidkaargar\BambooCardPortal\Tests\Unit\Exceptions;

use vahidkaargar\BambooCardPortal\Tests\TestCase;
use vahidkaargar\BambooCardPortal\Exceptions\AuthenticationException;

/**
 * AuthenticationException test
 */
class AuthenticationExceptionTest extends TestCase
{
    /**
     * Test authentication exception
     */
    public function testAuthenticationException()
    {
        $context = ['response' => ['error' => 'Unauthorized']];
        $exception = new AuthenticationException('Invalid credentials', $context);

        $this->assertEquals('Invalid credentials', $exception->getMessage());
        $this->assertEquals(401, $exception->getCode());
        $this->assertEquals($context, $exception->getContext());
    }

    /**
     * Test default message
     */
    public function testDefaultMessage()
    {
        $exception = new AuthenticationException();

        $this->assertEquals('Authentication failed', $exception->getMessage());
        $this->assertEquals(401, $exception->getCode());
    }
}
