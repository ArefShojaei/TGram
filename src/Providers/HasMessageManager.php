<?php

namespace TGram\Providers;

use TGram\Enums\HttpMethod;


trait HasMessageManager
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
    ): void {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "text" => $text,
                "parse_mode" => $parse_mode,
                "disable_web_page_preview" => $disable_web_page_preview,
                "disable_notification" => $disable_notification,
                "protect_content" => $protect_content,
                "reply_to_message_id" => $reply_to_message_id,
                "reply_markup" => $reply_markup ? json_encode($reply_markup) : null,
                "message_thread_id" => $message_thread_id,
            ],
        ];

        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "sendMessage",
            params: $body,
        );
    }
}
