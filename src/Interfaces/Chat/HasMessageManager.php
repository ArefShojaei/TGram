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
        ?int $message_thread_id = null,
    ): void;

    public function sendChatAction(ChatAction $action): void;

    public function editMessageText(
        string $text,
        ?string $parse_mode = "HTML",
        ?array $reply_markup = null,
    ): void;

    public function editMessageCaption(
        string $caption,
        ?string $parse_mode = "HTML",
        ?array $reply_markup = null,
    ): void;

    public function editMessageReplyMarkup(array $reply_markup): void;

    public function deleteMessage(): void;

    public function deleteMessages(array $message_ids): void;

    public function pinChatMessage(bool $disable_notification = true): void;

    public function unpinChatMessage(): void;

    public function unpinAllChatMessages(): void;
}
