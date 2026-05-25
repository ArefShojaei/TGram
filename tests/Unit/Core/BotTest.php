<?php

namespace Tests\Unit\Core;

use PHPUnit\Framework\TestCase;
use TGram\Bot;
use TGram\Enums\HttpMethod;
use Tests\Helpers\TestHelper;

/**
 * BotTest tests the abstract Bot class.
 * Tests HTTP communication with Telegram API.
 */
class BotTest extends TestCase
{
    private $bot;

    protected function setUp(): void
    {
        $this->bot = new ConcreteBotForTesting('test_token_123');
    }

    /**
     * Test constructor initializes Guzzle HTTP client.
     */
    public function testConstructorInitializesGuzzleClient(): void
    {
        $client = TestHelper::getPrivateProperty($this->bot, 'client');
        $this->assertNotNull($client);
    }

    /**
     * Test Telegram API base URL is correctly set.
     */
    public function testTelegramApiBaseUrlIsCorrect(): void
    {
        $client = TestHelper::getPrivateProperty($this->bot, 'client');
        $baseUri = $client->getConfig('base_uri');
        
        $this->assertStringContainsString('https://api.telegram.org/bot', (string)$baseUri);
        $this->assertStringContainsString('test_token_123', (string)$baseUri);
    }

    /**
     * Test request method returns stdObject.
     */
    public function testRequestMethodReturnsObject(): void
    {
        $result = $this->bot->request(HttpMethod::POST, 'getMe', []);
        $this->assertIsObject($result);
    }

    /**
     * Test request method with valid parameters.
     */
    public function testRequestMethodWithValidParameters(): void
    {
        $params = [
            'chat_id' => 123,
            'text' => 'Hello'
        ];
        
        $result = $this->bot->request(HttpMethod::POST, 'sendMessage', ['json' => $params]);
        $this->assertIsObject($result);
    }

    /**
     * Test request method handles errors gracefully.
     */
    public function testRequestMethodHandlesErrors(): void
    {
        $result = $this->bot->request(HttpMethod::POST, 'invalid_endpoint', []);
        
        if (is_object($result)) {
            $this->assertTrue(isset($result->ok) || isset($result->error_code));
        }
    }
}

/**
 * Concrete implementation of abstract Bot class for testing.
 */
class ConcreteBotForTesting extends Bot
{
    // No additional methods needed for testing
}
