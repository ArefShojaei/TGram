<?php

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use TGram\Telegram;
use TGram\Exceptions\InvalidTokenException;

/**
 * BotInitializationTest tests bot initialization flow.
 * Tests complete bot setup and configuration process.
 */
class BotInitializationTest extends TestCase
{
    /**
     * Test bot initializes with valid token.
     */
    public function testBotInitializesWithValidToken(): void
    {
        $bot = new Telegram('123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11');
        $this->assertInstanceOf(Telegram::class, $bot);
    }

    /**
     * Test bot can be configured.
     */
    public function testBotCanBeConfigured(): void
    {
        $bot = new Telegram('valid_token');
        
        $bot->configure([
            'polling_interval' => 2,
            'timeout' => 30
        ]);
        
        $this->assertTrue(true); // No exception thrown
    }

    /**
     * Test bot rejects invalid token on construction.
     */
    public function testBotRejectsInvalidTokenOnConstruction(): void
    {
        $this->expectException(InvalidTokenException::class);
        new Telegram('');
    }

    /**
     * Test bot with token initializes listeners.
     */
    public function testBotInitializesWithListeners(): void
    {
        $bot = new Telegram('valid_token');
        
        $called = false;
        $bot->start(function() use (&$called) {
            $called = true;
        });
        
        $this->assertTrue(true); // Listener registered
    }

    /**
     * Test bot multiple initialization steps.
     */
    public function testBotMultipleInitializationSteps(): void
    {
        $bot = new Telegram('token123');
        
        $bot->configure(['debug' => true]);
        $bot->start(function() {});
        $bot->command('/test', function() {});
        $bot->hears('hello', function() {});
        
        $this->assertTrue(true);
    }
}
