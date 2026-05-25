<?php

namespace Tests\Fixtures;

/**
 * FakeUpdateData provides mock Telegram update data for testing.
 * Generates realistic Telegram API response data for different scenarios.
 */
class FakeUpdateData
{
    /**
     * Get a valid basic update with text message.
     * 
     * @return array Update data
     */
    public static function getValidUpdate(): array
    {
        return [
            'update_id' => 123456789,
            'message' => [
                'message_id' => 1,
                'date' => time(),
                'chat' => [
                    'id' => 987654321,
                    'type' => 'private',
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'username' => 'johndoe'
                ],
                'from' => [
                    'id' => 111111,
                    'is_bot' => false,
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'username' => 'johndoe',
                    'language_code' => 'en'
                ],
                'text' => 'Hello World'
            ]
        ];
    }

    /**
     * Get update with /start command.
     * 
     * @return array Update data with /start command
     */
    public static function getStartCommandUpdate(): array
    {
        $data = self::getValidUpdate();
        $data['message']['text'] = '/start';
        return $data;
    }

    /**
     * Get update with /help command.
     * 
     * @return array Update data with /help command
     */
    public static function getHelpCommandUpdate(): array
    {
        $data = self::getValidUpdate();
        $data['message']['text'] = '/help';
        return $data;
    }

    /**
     * Get update with custom command.
     * 
     * @param string $command The command name
     * @return array Update data with custom command
     */
    public static function getCustomCommandUpdate(string $command): array
    {
        $data = self::getValidUpdate();
        $data['message']['text'] = '/' . ltrim($command, '/');
        return $data;
    }

    /**
     * Get update with photo message.
     * 
     * @return array Update data with photo
     */
    public static function getPhotoUpdate(): array
    {
        $data = self::getValidUpdate();
        unset($data['message']['text']);
        $data['message']['photo'] = [
            [
                'file_id' => 'AgACAgIAAxkBAAI...',
                'file_unique_id' => 'AQADXxkBAAI...',
                'file_size' => 12345,
                'width' => 1920,
                'height' => 1080
            ]
        ];
        $data['message']['caption'] = 'Photo caption';
        return $data;
    }

    /**
     * Get update with document message.
     * 
     * @return array Update data with document
     */
    public static function getDocumentUpdate(): array
    {
        $data = self::getValidUpdate();
        unset($data['message']['text']);
        $data['message']['document'] = [
            'file_id' => 'BQACAgIAAxkBAAI...',
            'file_unique_id' => 'AQADXxkBAAI...',
            'file_size' => 524288,
            'mime_type' => 'application/pdf',
            'file_name' => 'document.pdf'
        ];
        return $data;
    }

    /**
     * Get update with voice message.
     * 
     * @return array Update data with voice
     */
    public static function getVoiceUpdate(): array
    {
        $data = self::getValidUpdate();
        unset($data['message']['text']);
        $data['message']['voice'] = [
            'file_id' => 'AwACAgIAAxkBAAI...',
            'file_unique_id' => 'AQADXxkBAAI...',
            'duration' => 15,
            'mime_type' => 'audio/ogg',
            'file_size' => 102400
        ];
        return $data;
    }

    /**
     * Get update with callback query.
     * 
     * @param string $callbackData The callback data
     * @return array Update data with callback query
     */
    public static function getCallbackQueryUpdate(string $callbackData = 'test_callback'): array
    {
        return [
            'update_id' => 123456790,
            'callback_query' => [
                'id' => 'callback_query_id',
                'from' => [
                    'id' => 111111,
                    'is_bot' => false,
                    'first_name' => 'John',
                    'username' => 'johndoe',
                    'language_code' => 'en'
                ],
                'chat_instance' => '7714259149056046',
                'data' => $callbackData,
                'message' => [
                    'message_id' => 1,
                    'date' => time(),
                    'chat' => ['id' => 987654321, 'type' => 'private']
                ]
            ]
        ];
    }

    /**
     * Get update from group chat.
     * 
     * @return array Update data from group
     */
    public static function getGroupChatUpdate(): array
    {
        $data = self::getValidUpdate();
        $data['message']['chat'] = [
            'id' => -987654321,
            'type' => 'group',
            'title' => 'Test Group',
            'all_members_are_administrators' => true
        ];
        $data['message']['from'] = [
            'id' => 111111,
            'is_bot' => false,
            'first_name' => 'John',
            'username' => 'johndoe'
        ];
        return $data;
    }

    /**
     * Get empty update (no message or event).
     * 
     * @return array Empty update
     */
    public static function getEmptyUpdate(): array
    {
        return [
            'update_id' => 123456791
        ];
    }
}
