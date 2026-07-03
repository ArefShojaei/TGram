<?php

namespace Tests\Fixtures;

/**
 * FakeUpdateData provides mock Telegram update data for testing.
 * Generates realistic Telegram API response data for different scenarios.
 */
final class FakeUpdateData
{
    /**
     * Get a valid basic update with text message.
     */
    public static function getValidUpdate(): object
    {
        return (object) [
            "update_id" => 123456789,
            "message" => [
                "message_id" => 1,
                "date" => time(),
                "chat" => [
                    "id" => 987654321,
                    "type" => "private",
                    "first_name" => "John",
                    "last_name" => "Doe",
                    "username" => "johndoe",
                ],
                "from" => [
                    "id" => 111111,
                    "is_bot" => false,
                    "first_name" => "John",
                    "last_name" => "Doe",
                    "username" => "johndoe",
                    "language_code" => "en",
                ],
                "text" => "Hello World",
            ],
        ];
    }

    /**
     * Get update with /start command.
     *
     * @return object Update data with /start command
     */
    public static function getStartCommandUpdate(): object
    {
        $data = self::getValidUpdate();

        $data->message->text = "/start";

        return $data;
    }

    /**
     * Get update with /help command.
     *
     * @return object Update data with /help command
     */
    public static function getHelpCommandUpdate(): object
    {
        $data = self::getValidUpdate();

        $data->message->text = "/help";

        return $data;
    }

    /**
     * Get update with custom command.
     *
     * @return object Update data with custom command
     */
    public static function getCustomCommandUpdate(string $command): object
    {
        $data = self::getValidUpdate();

        $data->message->text = "/" . ltrim($command, "/");

        return $data;
    }

    /**
     * Get update with photo message.
     */
    public static function getPhotoUpdate(): object
    {
        $data = self::getValidUpdate();

        unset($data["message"]["text"]);

        $data->message->photo = [
            [
                "file_id" => "AgACAgIAAxkBAAI...",
                "file_unique_id" => "AQADXxkBAAI...",
                "file_size" => 12345,
                "width" => 1920,
                "height" => 1080,
            ],
        ];

        $data->message->caption = "Photo caption";

        return $data;
    }

    /**
     * Get update with document message.
     */
    public static function getDocumentUpdate(): object
    {
        $data = self::getValidUpdate();

        unset($data->message->text);

        $data->message->document = [
            "file_id" => "BQACAgIAAxkBAAI...",
            "file_unique_id" => "AQADXxkBAAI...",
            "file_size" => 524288,
            "mime_type" => "application/pdf",
            "file_name" => "document.pdf",
        ];

        return $data;
    }

    /**
     * Get update with voice message.
     */
    public static function getVoiceUpdate(): object
    {
        $data = self::getValidUpdate();

        unset($data->message->text);

        $data->message->voice = [
            "file_id" => "AwACAgIAAxkBAAI...",
            "file_unique_id" => "AQADXxkBAAI...",
            "duration" => 15,
            "mime_type" => "audio/ogg",
            "file_size" => 102400,
        ];

        return $data;
    }

    /**
     * Get update with callback query.
     */
    public static function getCallbackQueryUpdate(
        string $callbackData = "test_callback",
    ): object {
        return (object) [
            "update_id" => 123456790,
            "callback_query" => [
                "id" => "callback_query_id",
                "from" => [
                    "id" => 111111,
                    "is_bot" => false,
                    "first_name" => "John",
                    "username" => "johndoe",
                    "language_code" => "en",
                ],
                "chat_instance" => "7714259149056046",
                "data" => $callbackData,
                "message" => [
                    "message_id" => 1,
                    "date" => time(),
                    "chat" => ["id" => 987654321, "type" => "private"],
                ],
            ],
        ];
    }

    /**
     * Get update from group chat.
     */
    public static function getGroupChatUpdate(): object
    {
        $data = self::getValidUpdate();

        $data->message["chat"] = [
            "id" => -987654321,
            "type" => "group",
            "title" => "Test Group",
            "all_members_are_administrators" => true,
        ];

        $data->message["from"] = [
            "id" => 111111,
            "is_bot" => false,
            "first_name" => "John",
            "username" => "johndoe",
        ];

        return $data;
    }

    /**
     * Get empty update (no message or event).
     */
    public static function getEmptyUpdate(): object
    {
        return (object) [
            "update_id" => 123456791,
        ];
    }
}
