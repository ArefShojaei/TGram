<?php

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use TGram\Utils\Keyboard\Keyboard;
use TGram\Utils\Keyboard\Button;

/**
 * KeyboardInteractionTest tests keyboard creation and usage.
 * Tests complete keyboard workflows.
 */
class KeyboardInteractionTest extends TestCase
{
    /**
     * Test creating reply keyboard.
     */
    public function testCreatingReplyKeyboard(): void
    {
        $keyboard = Keyboard::reply()
            ->row(Button::text('Option 1'), Button::text('Option 2'))
            ->row(Button::text('Option 3'))
            ->toArray();
        
        $this->assertIsArray($keyboard);
        $this->assertArrayHasKey('keyboard', $keyboard);
    }

    /**
     * Test creating inline keyboard.
     */
    public function testCreatingInlineKeyboard(): void
    {
        $keyboard = Keyboard::inline()
            ->row(
                Button::url('GitHub', 'https://github.com'),
                Button::url('Docs', 'https://docs.example.com')
            )
            ->toArray();
        
        $this->assertIsArray($keyboard);
        $this->assertArrayHasKey('inline_keyboard', $keyboard);
    }

    /**
     * Test keyboard with various button types.
     */
    public function testKeyboardWithVariousButtonTypes(): void
    {
        $keyboard = Keyboard::inline()
            ->row(Button::callback('Delete', 'action_delete'))
            ->row(Button::url('Open', 'https://example.com'))
            ->row(Button::webApp('Web App', 'https://app.example.com'))
            ->toArray();
        
        $this->assertIsArray($keyboard);
    }

    /**
     * Test keyboard with emoji buttons.
     */
    public function testKeyboardWithEmojiButtons(): void
    {
        $keyboard = Keyboard::reply()
            ->row(
                Button::text('👍 Like'),
                Button::text('👎 Dislike')
            )
            ->row(
                Button::text('❤️ Love'),
                Button::text('😂 Funny')
            )
            ->toArray();
        
        $this->assertIsArray($keyboard);
    }

    /**
     * Test multi-row keyboard.
     */
    public function testMultiRowKeyboard(): void
    {
        $keyboard = Keyboard::reply()
            ->row(Button::text('1'), Button::text('2'), Button::text('3'))
            ->row(Button::text('4'), Button::text('5'), Button::text('6'))
            ->row(Button::text('7'), Button::text('8'), Button::text('9'))
            ->row(Button::text('0'))
            ->toArray();
        
        $this->assertCount(4, $keyboard['keyboard']);
    }
}
