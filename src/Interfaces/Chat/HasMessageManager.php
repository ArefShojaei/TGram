<?php

namespace TGram\Interfaces\Chat;

use TGram\Enums\ChatAction;

interface HasMessageManager
{
    public function sendMessage(
        string $text,
        ?int $chat_id = null,
        ?string $parse_mode = "HTML",
        ?array $reply_markup = null,
        ?int $reply_to_message_id = null,
        bool $disable_web_page_preview = false,
        bool $disable_notification = false,
        bool $protect_content = false,
        ?int $message_thread_id = null,
    ): object;

    public function sendChatAction(
        ChatAction $action,
        ?int $chat_id = null,
    ): object;

    public function editMessageCaption(
        string $caption,
        ?int $chat_id = null,
        ?int $message_id = null,
        ?string $parse_mode = "HTML",
        ?array $reply_markup = null,
    ): object;

    public function editMessageReplyMarkup(
        array $reply_markup,
        ?int $chat_id = null,
        ?int $message_id = null,
    ): object;

    public function editMessageMedia(
        array $media,
        ?array $reply_markup = null,
        ?int $chat_id = null,
        ?int $message_id = null,
    ): object;

    public function deleteMessage(
        ?int $chat_id = null,
        ?int $message_id = null,
    ): object;

    public function deleteMessages(
        array $message_ids,
        ?int $chat_id = null,
    ): object;

    public function pinChatMessage(
        bool $disable_notification = true,
        ?int $chat_id = null,
        ?int $message_id = null,
    ): object;

    public function unpinChatMessage(
        ?int $chat_id = null,
        ?int $message_id = null,
    ): object;

    public function unpinAllChatMessages(?int $chat_id = null): object;

    public function stopMessageLiveLocation(
        ?array $reply_markup = null,
        ?int $chat_id = null,
        ?int $message_id = null,
    ): object;

    public function editMessageLiveLocation(
        int $message_id,
        float $latitude,
        float $longitude,
        ?array $reply_markup = null,
        ?int $chat_id = null,
    ): object;

    public function stopPoll(
        int $message_id,
        ?int $chat_id = null,
        ?array $reply_markup = null,
    ): object;

    public function copyMessage(
        int|string $from_chat_id,
        int $message_id,
        ?int $chat_id = null,
        ?string $caption = null,
        ?string $parse_mode = null,
        ?array $reply_markup = null,
        ?int $reply_to_message_id = null,
    ): object;

    public function forwardMessage(
        int|string $from_chat_id,
        int $message_id,
        ?int $chat_id = null,
        bool $disable_notification = false,
        bool $protect_content = false,
    ): object;
}
