<?php

namespace Tests\Unit\Utils;

use PHPUnit\Framework\TestCase;

use TGram\Utils\Console;

/**
 * ConsoleTest tests the Console utility class.
 * Tests console output formatting.
 */
final class ConsoleTest extends TestCase
{
    /**
     * Test info method returns string.
     */
    public function testInfoMethodReturnsString(): void
    {
        $output = Console::info("Test message");

        $this->assertIsString($output);
    }

    /**
     * Test error method returns string.
     */
    public function testErrorMethodReturnsString(): void
    {
        $output = Console::error("Error message");

        $this->assertIsString($output);
    }

    /**
     * Test success method returns string.
     */
    public function testSuccessMethodReturnsString(): void
    {
        $output = Console::success("Success message");

        $this->assertIsString($output);
    }

    /**
     * Test warning method returns string.
     */
    public function testWarningMethodReturnsString(): void
    {
        $output = Console::warn("Warning message");

        $this->assertIsString($output);
    }

    /**
     * Test info output contains message.
     */
    public function testInfoOutputContainsMessage(): void
    {
        $output = Console::info("Test Info");

        $this->assertStringContainsString("Test Info", $output);
    }

    /**
     * Test error output contains message.
     */
    public function testErrorOutputContainsMessage(): void
    {
        $output = Console::error("Test Error");

        $this->assertStringContainsString("Test Error", $output);
    }
}
