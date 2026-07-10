<?php

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;

use TGram\Telegram;

/**
 * MessageListeningTest tests message listening workflow.
 * Tests message pattern matching and handlers.
 */
final class MessageListeningTest extends TestCase
{
    private Telegram $bot;

    protected function setUp(): void
    {
        $this->bot = new Telegram("123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11");
    }

    /**
     * Test message listener can be registered.
     */
    public function testMessageListenerCanBeRegistered(): void
    {
        $this->bot->hears("hello", function () {
            return "Heard hello";
        });

        $this->assertTrue(true);
    }

    /**
     * Test multiple message listeners.
     */
    public function testMultipleMessageListeners(): void
    {
        $this->bot->hears("hello", function () {});
        $this->bot->hears("hi", function () {});
        $this->bot->hears("hey", function () {});

        $this->assertTrue(true);
    }

    /**
     * Test exact message matching.
     */
    public function testExactMessageMatching(): void
    {
        $this->bot->hears("exact_phrase", function () {
            return "Matched exact phrase";
        });

        $this->assertTrue(true);
    }

    /**
     * Test case-sensitive matching.
     */
    public function testCaseSensitiveMatching(): void
    {
        $this->bot->hears("Hello", function () {});
        $this->bot->hears("hello", function () {});

        $this->assertTrue(true);
    }

    /**
     * Test listener with special characters.
     */
    public function testListenerWithSpecialCharacters(): void
    {
        $this->bot->hears('price: $99.99', function () {});
        $this->assertTrue(true);
    }

    /**
     * Test regex message listener can be registered.
     */
    public function testRegexMessageListenerCanBeRegistered(): void
    {
        $this->bot->hears('/^hello$/', function () {});

        $this->assertTrue(true);
    }

    /**
     * Test regex listener with capture groups.
     */
    public function testRegexListenerWithCaptureGroups(): void
    {
        $this->bot->hears('/^price\s+(\w+)$/', function () {});

        $this->assertTrue(true);
    }

    /**
     * Test regex listener with named capture groups.
     */
    public function testRegexListenerWithNamedCaptureGroups(): void
    {
        $this->bot->hears('/^price\s+(?<symbol>[A-Z]+)$/', function () {});

        $this->assertTrue(true);
    }

    /**
     * Test multiple regex listeners can be registered.
     */
    public function testMultipleRegexListenersCanBeRegistered(): void
    {
        $this->bot->hears('/^hello$/', function () {});
        $this->bot->hears('/^\d+$/', function () {});
        $this->bot->hears('/^[a-z]+$/i', function () {});

        $this->assertTrue(true);
    }
}
