<?php

namespace Tests\Unit\Enums;

use PHPUnit\Framework\TestCase;
use TGram\Enums\HttpMethod;

/**
 * HttpMethodTest tests the HttpMethod enum.
 * Tests HTTP method definitions.
 */
class HttpMethodTest extends TestCase
{
    /**
     * Test GET method exists.
     */
    public function testGetMethodExists(): void
    {
        $this->assertTrue(defined('TGram\\Enums\\HttpMethod::GET'));
    }

    /**
     * Test POST method exists.
     */
    public function testPostMethodExists(): void
    {
        $this->assertTrue(defined('TGram\\Enums\\HttpMethod::POST'));
    }

    /**
     * Test method names.
     */
    public function testMethodNames(): void
    {
        $this->assertEquals('GET', HttpMethod::GET->name);
        $this->assertEquals('POST', HttpMethod::POST->name);
    }

    /**
     * Test method values.
     */
    public function testMethodValues(): void
    {
        $this->assertEquals('get', HttpMethod::GET->value);
        $this->assertEquals('post', HttpMethod::POST->value);
    }

    /**
     * Test method comparison.
     */
    public function testMethodComparison(): void
    {
        $this->assertNotEquals(HttpMethod::GET, HttpMethod::POST);
        $this->assertTrue(HttpMethod::GET === HttpMethod::GET);
    }
}
