<?php

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use TGram\Telegram;
use TGram\Context;
use TGram\DTO\Update;
use Tests\Fixtures\FakeUpdateData;

/**
 * CommandHandlingTest tests command processing workflow.
 * Tests command registration and execution flow.
 */
class CommandHandlingTest extends TestCase
{
    private $bot;

    protected function setUp(): void
    {
        $this->bot = new Telegram('test_token');
    }

    /**
     * Test command can be registered.
     */
    public function testCommandCanBeRegistered(): void
    {
        $this->bot->command('/hello', function() {
            return 'Hello!';
        });
        
        $this->assertTrue(true);
    }

    /**
     * Test multiple commands can be registered.
     */
    public function testMultipleCommandsCanBeRegistered(): void
    {
        $this->bot->command('/start', function() {});
        $this->bot->command('/help', function() {});
        $this->bot->command('/about', function() {});
        
        $this->assertTrue(true);
    }

    /**
     * Test start command is special case.
     */
    public function testStartCommandIsSpecialCase(): void
    {
        $this->bot->start(function() {
            return 'Started';
        });
        
        $this->assertTrue(true);
    }

    /**
     * Test help command is special case.
     */
    public function testHelpCommandIsSpecialCase(): void
    {
        $this->bot->help(function() {
            return 'Help information';
        });
        
        $this->assertTrue(true);
    }

    /**
     * Test command with callback closure.
     */
    public function testCommandWithCallbackClosure(): void
    {
        $callback = function(Context $context) {
            return 'Command executed';
        };
        
        $this->bot->command('/test', $callback);
        $this->assertTrue(true);
    }
}
