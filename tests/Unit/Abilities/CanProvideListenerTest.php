<?php

namespace Tests\Unit\Abilities;

use Closure;

use PHPUnit\Framework\TestCase;

use TGram\Telegram;

use Tests\Fixtures\FakeTelegramBotToken;
use Tests\Helpers\TestHelper;

/**
 * CanProvideListenerTest tests the CanProvideListener trait.
 * Tests command registration, message listeners, and event handlers.
 */
class CanProvideListenerTest extends TestCase
{
    private Telegram $telegram;

    protected function setUp(): void
    {
        $this->telegram = new Telegram(FakeTelegramBotToken::getValidToken());
    }

    /**
     * Test command method registers handler.
     */
    public function testCommandMethodRegistersHandler(): void
    {
        $handler = function () {
            return "test";
        };
        $this->telegram->command("/test", $handler);

        $commands = TestHelper::getPrivateProperty($this->telegram, "commands");

        $this->assertArrayHasKey("test", $commands);
        $this->assertIsCallable($commands["test"]);
    }

    /**
     * Test command removes leading slash.
     */
    public function testCommandRemovesLeadingSlash(): void
    {
        $handler = function () {};
        $this->telegram->command("/mycommand", $handler);

        $commands = TestHelper::getPrivateProperty($this->telegram, "commands");

        $this->assertArrayHasKey("mycommand", $commands);
        $this->assertArrayNotHasKey("/mycommand", $commands);
    }

    /**
     * Test hears method registers listener.
     */
    public function testHearsMethodRegistersListener(): void
    {
        $handler = function () {
            return "heard";
        };
        $this->telegram->hears("hello", $handler);

        $hears = TestHelper::getPrivateProperty($this->telegram, "hears");

        $this->assertArrayHasKey("hello", $hears);
        $this->assertIsCallable($hears["hello"]);
    }

    /**
     * Test start method registers start command.
     */
    public function testStartMethodRegistersStartCommand(): void
    {
        $handler = function () {};
        $this->telegram->start($handler);

        $commands = TestHelper::getPrivateProperty($this->telegram, "commands");

        $this->assertArrayHasKey("start", $commands);
    }

    /**
     * Test help method registers help command.
     */
    public function testHelpMethodRegistersHelpCommand(): void
    {
        $handler = function () {};
        $this->telegram->help($handler);

        $commands = TestHelper::getPrivateProperty($this->telegram, "commands");

        $this->assertArrayHasKey("help", $commands);
    }

    /**
     * Test use method registers middleware.
     */
    public function testUseMethodRegistersMiddleware(): void
    {
        $middleware = function () {
            return true;
        };
        $this->telegram->use($middleware);

        $middlewares = TestHelper::getPrivateProperty(
            $this->telegram,
            "middlewares",
        );

        $this->assertCount(1, $middlewares);
    }

    /**
     * Test callback method stores closure.
     */
    public function testCallbackMethodStoresClosure(): void
    {
        $callback = function () {};
        $this->telegram->callback($callback);

        $storedCallback = TestHelper::getPrivateProperty(
            $this->telegram,
            "callback",
        );

        $this->assertNotNull($storedCallback);
        $this->assertInstanceOf(Closure::class, $storedCallback);
    }

    /**
     * Test multiple commands can be registered.
     */
    public function testMultipleCommandsCanBeRegistered(): void
    {
        $this->telegram->command("/cmd1", function () {});
        $this->telegram->command("/cmd2", function () {});
        $this->telegram->command("/cmd3", function () {});

        $commands = TestHelper::getPrivateProperty($this->telegram, "commands");

        $this->assertCount(3, $commands);
    }

    /**
     * Test multiple listeners can be registered.
     */
    public function testMultipleListenersCanBeRegistered(): void
    {
        $this->telegram->hears("hello", function () {});
        $this->telegram->hears("hi", function () {});
        $this->telegram->hears("hey", function () {});

        $hears = TestHelper::getPrivateProperty($this->telegram, "hears");

        $this->assertCount(3, $hears);
    }

    /**
     * Test duplicate command is not overwritten.
     */
    public function testDuplicateCommandIsNotOverwritten(): void
    {
        $handler1 = function () {
            return "first";
        };
        $handler2 = function () {
            return "second";
        };

        $this->telegram->command("/test", $handler1);
        $this->telegram->command("/test", $handler2);

        $commands = TestHelper::getPrivateProperty($this->telegram, "commands");

        $this->assertCount(1, $commands);
    }

    /**
     * Test duplicate listener is not registered.
     */
    public function testDuplicateListenerIsNotRegistered(): void
    {
        $handler1 = function () {
            return "first";
        };
        $handler2 = function () {
            return "second";
        };

        $this->telegram->hears("hello", $handler1);
        $this->telegram->hears("hello", $handler2);

        $hears = TestHelper::getPrivateProperty($this->telegram, "hears");

        $this->assertCount(1, $hears);
    }
}
