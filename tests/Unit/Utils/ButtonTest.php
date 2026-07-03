<?php

namespace Tests\Unit\Utils;

use PHPUnit\Framework\TestCase;

use TGram\Utils\Keyboard\Button;

/**
 * ButtonTest tests Button utility class.
 * Tests different button types and their properties.
 */
final class ButtonTest extends TestCase
{
    /**
     * Test text button creation.
     */
    public function testTextButtonCreation(): void
    {
        $button = Button::text("Press Me");

        $this->assertIsArray($button);
        $this->assertEquals("Press Me", $button["text"]);
        $this->assertCount(1, $button);
    }

    /**
     * Test URL button creation.
     */
    public function testUrlButtonCreation(): void
    {
        $button = Button::url("GitHub", "https://github.com");

        $this->assertArrayHasKey("text", $button);
        $this->assertArrayHasKey("url", $button);
        $this->assertEquals("GitHub", $button["text"]);
        $this->assertEquals("https://github.com", $button["url"]);
    }

    /**
     * Test callback button creation.
     */
    public function testCallbackButtonCreation(): void
    {
        $button = Button::callback("Vote", "action_vote");

        $this->assertArrayHasKey("text", $button);
        $this->assertArrayHasKey("callback_data", $button);
        $this->assertEquals("Vote", $button["text"]);
        $this->assertEquals("action_vote", $button["callback_data"]);
    }

    /**
     * Test web app button creation.
     */
    public function testWebAppButtonCreation(): void
    {
        $button = Button::webApp("Open App", "https://app.example.com");

        $this->assertArrayHasKey("text", $button);
        $this->assertArrayHasKey("web_app", $button);
        $this->assertEquals("Open App", $button["text"]);
        $this->assertIsArray($button["web_app"]);
    }

    /**
     * Test button with emoji.
     */
    public function testButtonWithEmoji(): void
    {
        $button = Button::text("👍 Like");

        $this->assertStringContainsString("👍", $button["text"]);
    }

    /**
     * Test button with long text.
     */
    public function testButtonWithLongText(): void
    {
        $longText = "This is a very long button text that might wrap";
        $button = Button::text($longText);

        $this->assertEquals($longText, $button["text"]);
    }

    /**
     * Test URL button with special characters in URL.
     */
    public function testUrlButtonWithSpecialCharacters(): void
    {
        $button = Button::url("Search", "https://example.com?q=test&sort=asc");

        $this->assertStringContainsString("?q=test&sort=asc", $button["url"]);
    }
}
