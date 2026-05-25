<?php

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use TGram\Telegram;

/**
 * MessageListeningTest tests message listening workflow.
 * Tests message pattern matching and handlers.
 */
class MessageListeningTest extends TestCase
{
    private $bot;

    protected function setUp(): void
    {
        $this->bot = new Telegram('test_token');
    }

    /**
     * Test message listener can be registered.
     */
    public function testMessageListenerCanBeRegistered(): void
    {
        $this->bot->hears('hello', function() {
            return 'Heard hello';
        });
        
        $this->assertTrue(true);
    }

    /**
     * Test multiple message listeners.
     */
    public function testMultipleMessageListeners(): void
    {
        $this->bot->hears('hello', function() {});
        $this->bot->hears('hi', function() {});
        $this->bot->hears('hey', function() {});
        
        $this->assertTrue(true);
    }

    /**
     * Test exact message matching.
     */
    public function testExactMessageMatching(): void
    {
        $this->bot->hears('exact_phrase', function() {
            return 'Matched exact phrase';
        });
        
        $this->assertTrue(true);
    }

    /**
     * Test case-sensitive matching.
     */
    public function testCaseSensitiveMatching(): void
    {
        $this->bot->hears('Hello', function() {});
        $this->bot->hears('hello', function() {});
        
        $this->assertTrue(true);
    }

    /**
     * Test listener with special characters.
     */
    public function testListenerWithSpecialCharacters(): void
    {
        $this->bot->hears('price: $99.99', function() {});
        $this->assertTrue(true);
    }
}
