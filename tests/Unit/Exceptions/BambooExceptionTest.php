<?php

namespace vahidkaargar\BambooCardPortal\Tests\Unit\Exceptions;

use vahidkaargar\BambooCardPortal\Tests\TestCase;
use vahidkaargar\BambooCardPortal\Exceptions\BambooException;

/**
 * BambooException test
 */
class BambooExceptionTest extends TestCase
{
    /**
     * Test exception with context
     */
    public function testExceptionWithContext()
    {
        $context = ['key' => 'value'];
        $exception = new BambooException('Test message', 500, null, $context);

        $this->assertEquals('Test message', $exception->getMessage());
        $this->assertEquals(500, $exception->getCode());
        $this->assertEquals($context, $exception->getContext());
    }

    /**
     * Test setting context
     */
    public function testSetContext()
    {
        $exception = new BambooException();
        $context = ['new' => 'context'];
        
        $exception->setContext($context);
        
        $this->assertEquals($context, $exception->getContext());
    }
}
