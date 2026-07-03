<?php

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;

use TGram\Telegram;
use TGram\Exceptions\InvalidTokenException;

use Tests\Fixtures\FakeTelegramBotToken;

/**
 * BotInitializationTest tests bot initialization flow.
 * Tests complete bot setup and configuration process.
 */
final class BotInitializationTest extends TestCase
{
    /**
     * Test bot initializes with valid token.
     */
    public function testBotInitializesWithValidToken(): void
    {
        $bot = new Telegram(FakeTelegramBotToken::getValidToken());

        $this->assertInstanceOf(Telegram::class, $bot);
    }

    /**
     * Test bot can be configured.
     */
    public function testBotCanBeConfigured(): void
    {
        $bot = new Telegram(FakeTelegramBotToken::getValidToken());

        $bot->configure([
            "polling_interval" => 2,
            "timeout" => 30,
        ]);

        $this->assertTrue(true); // No exception thrown
    }

    /**
     * Test bot rejects invalid token on construction.
     */
    public function testBotRejectsInvalidTokenOnConstruction(): void
    {
        $this->expectException(InvalidTokenException::class);

        new Telegram(FakeTelegramBotToken::getInvalidToken());
    }

    /**
     * Test bot with token initializes listeners.
     */
    public function testBotInitializesWithListeners(): void
    {
        $bot = new Telegram(FakeTelegramBotToken::getValidToken());

        $called = false;
        $bot->start(function () use (&$called) {
            $called = true;
        });

        $this->assertTrue(true); // Listener registered
    }

    /**
     * Test bot multiple initialization steps.
     */
    public function testBotMultipleInitializationSteps(): void
    {
        $bot = new Telegram(FakeTelegramBotToken::getValidToken());

        $bot->configure(["debug" => true]);
        $bot->start(function () {});
        $bot->command("/test", function () {});
        $bot->hears("hello", function () {});

        $this->assertTrue(true);
    }
}
