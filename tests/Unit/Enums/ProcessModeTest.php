<?php

namespace Tests\Unit\Enums;

use PHPUnit\Framework\TestCase;
use TGram\Enums\ProcessMode;

/**
 * ProcessModeTest tests the ProcessMode enum.
 * Tests enum cases and values.
 */
class ProcessModeTest extends TestCase
{
    /**
     * Test WEBHOOK case exists.
     */
    public function testWebhookCaseExists(): void
    {
        $this->assertTrue(defined('TGram\\Enums\\ProcessMode::WEBHOOK'));
    }

    /**
     * Test POLLING case exists.
     */
    public function testPollingCaseExists(): void
    {
        $this->assertTrue(defined('TGram\\Enums\\ProcessMode::POLLING'));
    }

    /**
     * Test enum case names.
     */
    public function testEnumCaseNames(): void
    {
        $this->assertEquals('WEBHOOK', ProcessMode::WEBHOOK->name);
        $this->assertEquals('POLLING', ProcessMode::POLLING->name);
    }

    /**
     * Test enum comparison works correctly.
     */
    public function testEnumComparisonSameValue(): void
    {
        $mode1 = ProcessMode::POLLING;
        $mode2 = ProcessMode::POLLING;
        
        $this->assertTrue($mode1 === $mode2);
    }

    /**
     * Test enum comparison with different values.
     */
    public function testEnumComparisonDifferentValues(): void
    {
        $mode1 = ProcessMode::POLLING;
        $mode2 = ProcessMode::WEBHOOK;
        
        $this->assertFalse($mode1 === $mode2);
    }

    /**
     * Test enum values are different.
     */
    public function testEnumValuesAreDifferent(): void
    {
        $this->assertNotEquals(ProcessMode::WEBHOOK, ProcessMode::POLLING);
    }
}
