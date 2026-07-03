<?php

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;

use TGram\Telegram;
use TGram\Exceptions\InvalidTokenException;

use Tests\Fixtures\FakeTelegramBotToken;

/**
 * ExceptionHandlingTest tests exception scenarios.
 * Tests error handling in bot workflows.
 */
final class ExceptionHandlingTest extends TestCase
{
    /**
     * Test invalid token throws exception.
     */
    public function testInvalidTokenThrowsException(): void
    {
        $this->expectException(InvalidTokenException::class);
        new Telegram(FakeTelegramBotToken::getEmptyToken());
    }

    /**
     * Test whitespace-only token throws exception.
     */
    public function testWhitespaceTokenThrowsException(): void
    {
        $this->expectException(InvalidTokenException::class);
        new Telegram(FakeTelegramBotToken::getEmptyTokenWithWhitespace());
    }

    /**
     * Test exception message is descriptive.
     */
    public function testExceptionMessageIsDescriptive(): void
    {
        try {
            new Telegram(FakeTelegramBotToken::getEmptyToken());
        } catch (InvalidTokenException $e) {
            $this->assertStringContainsString(
                "token",
                strtolower($e->getMessage()),
            );
        }
    }

    /**
     * Test exception can be caught and handled.
     */
    public function testExceptionCanBeCaughtAndHandled(): void
    {
        $caught = false;

        try {
            new Telegram(FakeTelegramBotToken::getEmptyToken());
        } catch (InvalidTokenException $e) {
            $caught = true;
        }

        $this->assertTrue($caught);
    }
}
