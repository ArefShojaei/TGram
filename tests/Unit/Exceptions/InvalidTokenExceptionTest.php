<?php

namespace Tests\Unit\Exceptions;

use PHPUnit\Framework\TestCase;

use TGram\Exceptions\InvalidTokenException;

/**
 * InvalidTokenExceptionTest tests the InvalidTokenException class.
 * Tests exception behavior and messages.
 */
class InvalidTokenExceptionTest extends TestCase
{
    /**
     * Test exception extends InvalidArgumentException.
     */
    public function testExceptionExtendsInvalidArgumentException(): void
    {
        $exception = new InvalidTokenException();
        $this->assertInstanceOf(\InvalidArgumentException::class, $exception);
    }

    /**
     * Test exception extends Exception.
     */
    public function testExceptionExtendsException(): void
    {
        $exception = new InvalidTokenException();
        $this->assertInstanceOf(\Exception::class, $exception);
    }

    /**
     * Test default exception message is correct.
     */
    public function testDefaultExceptionMessage(): void
    {
        $exception = new InvalidTokenException();
        $this->assertEquals("Invalid bot token!", $exception->getMessage());
    }

    /**
     * Test custom exception message.
     */
    public function testCustomExceptionMessage(): void
    {
        $customMessage = "Token cannot be empty";
        $exception = new InvalidTokenException($customMessage);
        $this->assertEquals($customMessage, $exception->getMessage());
    }

    /**
     * Test exception can be thrown and caught.
     */
    public function testExceptionCanBeThrownAndCaught(): void
    {
        $this->expectException(InvalidTokenException::class);
        throw new InvalidTokenException();
    }

    /**
     * Test exception message with special characters.
     */
    public function testExceptionMessageWithSpecialCharacters(): void
    {
        $message = 'Invalid token: @#$%^&*()';
        $exception = new InvalidTokenException($message);
        $this->assertEquals($message, $exception->getMessage());
    }
}
