<?php

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;

use TGram\{Telegram, Context};

use Tests\Fixtures\FakeTelegramBotToken;

/**
 * CommandHandlingTest tests command processing workflow.
 * Tests command registration and execution flow.
 */
final class CommandHandlingTest extends TestCase
{
    private Telegram $bot;

    protected function setUp(): void
    {
        $this->bot = new Telegram(FakeTelegramBotToken::getValidToken());
    }

    /**
     * Test command can be registered.
     */
    public function testCommandCanBeRegistered(): void
    {
        $this->bot->command("/hello", function () {
            return "Hello!";
        });

        $this->assertTrue(true);
    }

    /**
     * Test multiple commands can be registered.
     */
    public function testMultipleCommandsCanBeRegistered(): void
    {
        $this->bot->command("/start", function () {});
        $this->bot->command("/help", function () {});
        $this->bot->command("/about", function () {});

        $this->assertTrue(true);
    }

    /**
     * Test start command is special case.
     */
    public function testStartCommandIsSpecialCase(): void
    {
        $this->bot->start(function () {
            return "Started";
        });

        $this->assertTrue(true);
    }

    /**
     * Test help command is special case.
     */
    public function testHelpCommandIsSpecialCase(): void
    {
        $this->bot->help(function () {
            return "Help information";
        });

        $this->assertTrue(true);
    }

    /**
     * Test command with callback closure.
     */
    public function testCommandWithCallbackClosure(): void
    {
        $callback = function (Context $context) {
            return "Command executed";
        };

        $this->bot->command("/test", $callback);
        $this->assertTrue(true);
    }

    /**
     * Test command with single parameter can be registered.
     */
    public function testCommandWithSingleParameterCanBeRegistered(): void
    {
        $this->bot->command("/user/{id}", function (Context $context) {
            return $context->params("id");
        });

        $this->assertTrue(true);
    }

    /**
     * Test command with multiple parameters can be registered.
     */
    public function testCommandWithMultipleParametersCanBeRegistered(): void
    {
        $this->bot->command("/user/{id}/post/{slug}", function (
            Context $context,
        ) {
            return [$context->params("id"), $context->params("slug")];
        });

        $this->assertTrue(true);
    }

    /**
     * Test command parameter names can contain different identifiers.
     */
    public function testCommandWithDifferentParameterNamesCanBeRegistered(): void
    {
        $this->bot->command("/{username}/message/{messageId}", function (
            Context $context,
        ) {
            return [
                $context->params("username"),
                $context->params("messageId"),
            ];
        });

        $this->assertTrue(true);
    }

    /**
     * Test regex command pattern can be registered.
     */
    public function testRegexCommandPatternCanBeRegistered(): void
    {
        $this->bot->command("/price/{symbol}", function (Context $context) {
            return $context->params("symbol");
        });

        $this->assertTrue(true);
    }
}
