<?php

namespace Tests\Fixtures;

/**
 * FakeTelegramResponse provides mock Telegram API responses for testing.
 * Generates realistic Telegram Bot API response objects.
 */
class FakeTelegramResponse
{
    /**
     * Get successful API response.
     * 
     * @param mixed $result The result data
     * @return object Standard Telegram API response
     */
    public static function getSuccessResponse($result = null): object
    {
        return (object) [
            'ok' => true,
            'result' => $result ?? true
        ];
    }

    /**
     * Get error API response.
     * 
     * @param string $description Error description
     * @param int $errorCode Error code
     * @return object Error response
     */
    public static function getErrorResponse(string $description = 'Bad Request', int $errorCode = 400): object
    {
        return (object) [
            'ok' => false,
            'error_code' => $errorCode,
            'description' => $description
        ];
    }

    /**
     * Get response for sent message.
     * 
     * @param int $messageId Message ID
     * @return object Message response
     */
    public static function getSentMessageResponse(int $messageId = 1): object
    {
        return self::getSuccessResponse([
            'message_id' => $messageId,
            'date' => time(),
            'chat' => [
                'id' => 987654321,
                'type' => 'private'
            ],
            'text' => 'Test message'
        ]);
    }

    /**
     * Get response for sent photo.
     * 
     * @return object Photo response
     */
    public static function getSentPhotoResponse(): object
    {
        return self::getSuccessResponse([
            'message_id' => 1,
            'date' => time(),
            'chat' => ['id' => 987654321, 'type' => 'private'],
            'photo' => [
                [
                    'file_id' => 'AgACAgIAAxkBAAI...',
                    'file_unique_id' => 'AQADXxkBAAI...',
                    'width' => 1920,
                    'height' => 1080,
                    'file_size' => 12345
                ]
            ]
        ]);
    }

    /**
     * Get response for chat info.
     * 
     * @return object Chat info response
     */
    public static function getChatInfoResponse(): object
    {
        return self::getSuccessResponse([
            'id' => 987654321,
            'type' => 'private',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'username' => 'johndoe',
            'is_bot' => false,
            'is_premium' => false
        ]);
    }

    /**
     * Get response for user profile photos.
     * 
     * @return object Photos response
     */
    public static function getUserPhotosResponse(): object
    {
        return self::getSuccessResponse([
            'total_count' => 2,
            'photos' => [
                [
                    [
                        'file_id' => 'AgACAgIAAxkBAAI...',
                        'file_unique_id' => 'AQADXxkBAAI...',
                        'width' => 640,
                        'height' => 640,
                        'file_size' => 8192
                    ]
                ]
            ]
        ]);
    }

    /**
     * Get response for chat member info.
     * 
     * @return object Chat member response
     */
    public static function getChatMemberResponse(): object
    {
        return self::getSuccessResponse([
            'user' => [
                'id' => 111111,
                'is_bot' => false,
                'first_name' => 'John',
                'username' => 'johndoe'
            ],
            'status' => 'member',
            'is_member' => true
        ]);
    }
}
