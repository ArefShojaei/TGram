<?php

namespace TGram\Interfaces\Chat;

use TGram\Enums\ChatAction;

interface HasMessageManager
{
    public function sendMessage(
        string $text,
        ?string $parse_mode = "HTML",
        ?array $reply_markup = null,
        ?int $reply_to_message_id = null,
        bool $disable_web_page_preview = false,
        bool $disable_notification = false,
        bool $protect_content = false,
        ?int $message_thread_id = null
    ): object;

    public function sendChatAction(ChatAction $action): object;

    public function editMessageCaption(
        string $caption,
        ?string $parse_mode = "HTML",
        ?array $reply_markup = null
    ): object;

    public function editMessageReplyMarkup(array $reply_markup): object;

    public function editMessageMedia(
        array $media,
        ?array $reply_markup = null
    ): object;

    public function deleteMessage(): object;

    public function deleteMessages(array $message_ids): object;

    public function pinChatMessage(bool $disable_notification = true): object;

    public function unpinChatMessage(): object;

    public function unpinAllChatMessages(): object;

    public function stopMessageLiveLocation(
        ?array $reply_markup = null
    ): object;

    public function editMessageLiveLocation(
        int $messageId,
        float $latitude,
        float $longitude,
        ?array $reply_markup = null
    ): object;

    public function stopPoll(
        int $messageId,
        ?array $reply_markup = null
    ): object;

    public function copyMessage(
        int|string $fromChatId,
        int $messageId,
        ?string $caption = null,
        ?string $parse_mode = null,
        ?array $reply_markup = null,
        ?int $reply_to_message_id = null
    ): object;

    public function forwardMessage(
        int|string $fromChatId,
        int $messageId,
        bool $disable_notification = false,
        bool $protect_content = false
    ): object;
}
