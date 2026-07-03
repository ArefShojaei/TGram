<?php

namespace Tests\Unit\Exceptions;

use PHPUnit\Framework\TestCase;

use TGram\Exceptions\ValidationException;

/**
 * ValidationExceptionTest tests the ValidationException class.
 * Tests validation error handling.
 */
class ValidationExceptionTest extends TestCase
{
    /**
     * Test validation exception can be instantiated.
     */
    public function testValidationExceptionCanBeInstantiated(): void
    {
        $exception = new ValidationException("Validation failed");
        $this->assertInstanceOf(ValidationException::class, $exception);
    }

    /**
     * Test validation exception extends Exception.
     */
    public function testValidationExceptionExtendsException(): void
    {
        $exception = new ValidationException("Test");
        $this->assertInstanceOf(\Exception::class, $exception);
    }

    /**
     * Test validation exception message is stored.
     */
    public function testValidationExceptionMessageIsStored(): void
    {
        $message = "Chat ID is required";
        $exception = new ValidationException($message);
        $this->assertEquals($message, $exception->getMessage());
    }

    /**
     * Test validation exception can be thrown.
     */
    public function testValidationExceptionCanBeThrown(): void
    {
        $this->expectException(ValidationException::class);
        throw new ValidationException("Invalid input");
    }
}
