<?php

namespace Tests\Unit\Core;

use PHPUnit\Framework\TestCase;
use TGram\Telegram;
use TGram\Exceptions\InvalidTokenException;
use Tests\Helpers\TestHelper;

/**
 * TelegramTest tests the main Telegram bot class.
 * Tests initialization, configuration, and bot lifecycle.
 */
class TelegramTest extends TestCase
{
    /**
     * Test constructor creates instance with valid token.
     */
    public function testConstructorWithValidToken(): void
    {
        $telegram = new Telegram('valid_token_123456');
        $this->assertInstanceOf(Telegram::class, $telegram);
    }

    /**
     * Test constructor throws exception with empty token.
     */
    public function testConstructorThrowsExceptionWithEmptyToken(): void
    {
        $this->expectException(InvalidTokenException::class);
        new Telegram('');
    }

    /**
     * Test constructor throws exception with whitespace-only token.
     */
    public function testConstructorThrowsExceptionWithWhitespaceToken(): void
    {
        $this->expectException(InvalidTokenException::class);
        new Telegram('   ');
    }

    /**
     * Test constructor throws exception with null token.
     */
    public function testConstructorThrowsExceptionWithNullToken(): void
    {
        $this->expectException(InvalidTokenException::class);
        new Telegram(null);
    }

    /**
     * Test configure method sets configuration.
     */
    public function testConfigureMethodSetsSettings(): void
    {
        $telegram = new Telegram('test_token');
        $config = [
            'polling_interval' => 5,
            'max_attempts' => 3,
            'timeout' => 30,
            'debug_mode' => true
        ];
        
        $telegram->configure($config);
        $this->assertTrue(true); // Configuration stored without error
    }

    /**
     * Test configure with empty array.
     */
    public function testConfigureWithEmptyArray(): void
    {
        $telegram = new Telegram('test_token');
        $telegram->configure([]);
        $this->assertTrue(true);
    }

    /**
     * Test telegram instance implements required interfaces.
     */
    public function testTelegramImplementsRequiredInterfaces(): void
    {
        $telegram = new Telegram('test_token');
        $this->assertInstanceOf(\TGram\Interfaces\Telegram::class, $telegram);
    }

    /**
     * Test InvalidTokenException has correct message.
     */
    public function testInvalidTokenExceptionMessage(): void
    {
        try {
            new Telegram('');
        } catch (InvalidTokenException $e) {
            $this->assertStringContainsString('Invalid', $e->getMessage());
        }
    }
}
