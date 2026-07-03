<?php

namespace Tests\Unit\Enums;

use PHPUnit\Framework\TestCase;

use TGram\Enums\HttpMethod;

/**
 * HttpMethodTest tests the HttpMethod enum.
 * Tests HTTP method definitions.
 */
final class HttpMethodTest extends TestCase
{
    /**
     * Test GET method exists.
     */
    public function testGetMethodExists(): void
    {
        $this->assertTrue(defined("TGram\\Enums\\HttpMethod::READABLE"));
    }

    /**
     * Test POST method exists.
     */
    public function testPostMethodExists(): void
    {
        $this->assertTrue(defined("TGram\\Enums\\HttpMethod::CREATABLE"));
    }

    /**
     * Test method names.
     */
    public function testMethodNames(): void
    {
        $this->assertEquals("get", HttpMethod::READABLE->value);
        $this->assertEquals("post", HttpMethod::CREATABLE->value);
    }

    /**
     * Test method values.
     */
    public function testMethodValues(): void
    {
        $this->assertEquals("get", HttpMethod::READABLE->value);
        $this->assertEquals("post", HttpMethod::CREATABLE->value);
    }

    /**
     * Test method comparison.
     */
    public function testMethodComparison(): void
    {
        $this->assertNotEquals(HttpMethod::READABLE, HttpMethod::CREATABLE);
        $this->assertTrue(HttpMethod::READABLE === HttpMethod::READABLE);
    }
}
