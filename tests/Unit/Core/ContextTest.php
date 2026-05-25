<?php

namespace Tests\Unit\Core;

use PHPUnit\Framework\TestCase;
use TGram\Context;
use TGram\DTO\Update;
use Tests\Fixtures\FakeUpdateData;
use Tests\Helpers\TestHelper;

/**
 * ContextTest tests the Context class.
 * Tests message context and response methods.
 */
class ContextTest extends TestCase
{
    private $context;
    private $mockBot;

    protected function setUp(): void
    {
        $this->mockBot = $this->createMock(\TGram\Bot::class);
        
        $updateData = FakeUpdateData::getValidUpdate();
        $update = new Update();
        
        foreach ($updateData as $key => $value) {
            $update->$key = $value;
        }
        
        $this->context = new Context($update, $this->mockBot);
    }

    /**
     * Test context constructor stores update object.
     */
    public function testContextConstructorStoresUpdate(): void
    {
        $update = TestHelper::getPrivateProperty($this->context, 'update');
        $this->assertIsObject($update);
    }

    /**
     * Test context provides access to update data.
     */
    public function testContextProvidesAccessToUpdate(): void
    {
        $this->assertIsObject($this->context->update);
        $this->assertIsObject($this->context->update->message);
    }

    /**
     * Test context can access user information.
     */
    public function testContextCanAccessUserInformation(): void
    {
        $user = $this->context->update->message->from;
        
        $this->assertIsObject($user);
        $this->assertEquals('John', $user->first_name);
        $this->assertEquals('johndoe', $user->username);
    }

    /**
     * Test context can access message information.
     */
    public function testContextCanAccessMessageInformation(): void
    {
        $message = $this->context->update->message;
        
        $this->assertIsObject($message);
        $this->assertEquals('Hello World', $message->text);
        $this->assertEquals(1, $message->message_id);
    }

    /**
     * Test context can access chat information.
     */
    public function testContextCanAccessChatInformation(): void
    {
        $chat = $this->context->update->message->chat;
        
        $this->assertIsObject($chat);
        $this->assertEquals(987654321, $chat->id);
        $this->assertEquals('private', $chat->type);
    }

    /**
     * Test context with group chat update.
     */
    public function testContextWithGroupChatUpdate(): void
    {
        $groupData = FakeUpdateData::getGroupChatUpdate();
        $update = new Update();
        
        foreach ($groupData as $key => $value) {
            $update->$key = $value;
        }
        
        $context = new Context($update, $this->mockBot);
        $chat = $context->update->message->chat;
        
        $this->assertEquals('group', $chat->type);
        $this->assertEquals('Test Group', $chat->title);
    }
}
