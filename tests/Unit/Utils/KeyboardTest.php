<?php

namespace Tests\Unit\Utils;

use PHPUnit\Framework\TestCase;

use TGram\Utils\Keyboard\{Keyboard, Button, ReplyKeyboard, InlineKeyboard};

/**
 * KeyboardTest tests keyboard utilities.
 * Tests keyboard creation and button handling.
 */
final class KeyboardTest extends TestCase
{
    /**
     * Test Keyboard::reply creates ReplyKeyboard.
     */
    public function testKeyboardReplyCreatesReplyKeyboard(): void
    {
        $keyboard = Keyboard::reply();

        $this->assertInstanceOf(ReplyKeyboard::class, $keyboard);
    }

    /**
     * Test Keyboard::inline creates InlineKeyboard.
     */
    public function testKeyboardInlineCreatesInlineKeyboard(): void
    {
        $keyboard = Keyboard::inline();

        $this->assertInstanceOf(InlineKeyboard::class, $keyboard);
    }

    /**
     * Test Button::text creates text button.
     */
    public function testButtonTextCreatesTextButton(): void
    {
        $button = Button::text("Click Me");

        $this->assertIsArray($button);
        $this->assertArrayHasKey("text", $button);
        $this->assertEquals("Click Me", $button["text"]);
    }

    /**
     * Test Button::url creates URL button.
     */
    public function testButtonUrlCreatesUrlButton(): void
    {
        $button = Button::url("Visit", "https://example.com");

        $this->assertIsArray($button);
        $this->assertArrayHasKey("text", $button);
        $this->assertArrayHasKey("url", $button);
        $this->assertEquals("Visit", $button["text"]);
        $this->assertEquals("https://example.com", $button["url"]);
    }

    /**
     * Test Button::callback creates callback button.
     */
    public function testButtonCallbackCreatesCallbackButton(): void
    {
        $button = Button::callback("Vote", "vote_yes");

        $this->assertIsArray($button);
        $this->assertArrayHasKey("text", $button);
        $this->assertArrayHasKey("callback_data", $button);
        $this->assertEquals("Vote", $button["text"]);
        $this->assertEquals("vote_yes", $button["callback_data"]);
    }

    /**
     * Test keyboard row method adds buttons.
     */
    public function testKeyboardRowAddButtons(): void
    {
        $keyboard = Keyboard::reply()->row(
            Button::text("Yes"),
            Button::text("No"),
        );

        $this->assertInstanceOf(ReplyKeyboard::class, $keyboard);
    }

    /**
     * Test keyboard toArray returns correct format.
     */
    public function testKeyboardToArrayReturnsCorrectFormat(): void
    {
        $keyboard = Keyboard::reply()->row(Button::text("Button"))->toArray();

        $this->assertIsArray($keyboard);
        $this->assertArrayHasKey("keyboard", $keyboard);
    }

    /**
     * Test inline keyboard toArray format.
     */
    public function testInlineKeyboardToArrayFormat(): void
    {
        $keyboard = Keyboard::inline()
            ->row(Button::url("Link", "https://example.com"))
            ->toArray();

        $this->assertIsArray($keyboard);
        $this->assertArrayHasKey("inline_keyboard", $keyboard);
    }

    /**
     * Test keyboard builder pattern.
     */
    public function testKeyboardBuilderPattern(): void
    {
        $keyboard = Keyboard::reply()
            ->row(Button::text("Option 1"))
            ->row(Button::text("Option 2"))
            ->row(Button::text("Option 3"))
            ->toArray();

        $this->assertIsArray($keyboard);
        $this->assertIsArray($keyboard["keyboard"]);
        $this->assertCount(3, $keyboard["keyboard"]);
    }

    /**
     * Test multiple buttons in single row.
     */
    public function testMultipleButtonsInSingleRow(): void
    {
        $keyboard = Keyboard::reply()
            ->row(
                Button::text("Yes"),
                Button::text("No"),
                Button::text("Maybe"),
            )
            ->toArray();

        $this->assertIsArray($keyboard["keyboard"][0]);
        $this->assertCount(3, $keyboard["keyboard"][0]);
    }

    /**
     * Test inline keyboard with mixed button types.
     */
    public function testInlineKeyboardWithMixedButtonTypes(): void
    {
        $keyboard = Keyboard::inline()
            ->row(
                Button::url("GitHub", "https://github.com"),
                Button::callback("Delete", "delete"),
            )
            ->toArray();

        $this->assertIsArray($keyboard["inline_keyboard"]);
        $this->assertCount(1, $keyboard["inline_keyboard"]);
        $this->assertCount(2, $keyboard["inline_keyboard"][0]);
    }
}
