<?php

namespace TGram\Providers;

use TGram\Enums\{HttpMethod, ChatAction};


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
                "reply_markup" => $reply_markup
                    ? json_encode($reply_markup)
                    : null,
                "message_thread_id" => $message_thread_id,
            ],
        ];

        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "sendMessage",
            params: $body,
        );
    }

    public function sendChatAction(ChatAction $action): void
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "action" => $action->value,
            ],
        ];

        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "sendChatAction",
            params: $body,
        );
    }

    public function editMessageText(
        string $text,
        ?string $parse_mode = "HTML",
        ?array $reply_markup = null,
    ): void {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "message_id" => $this->update->message->message_id,
                "text" => $text,
                "prase_mode" => $parse_mode,
                "reply_markup" => $reply_markup
                    ? json_encode($reply_markup)
                    : null,
            ],
        ];

        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "editMessageText",
            params: $body,
        );
    }

    public function editMessageCaption(
        string $caption,
        ?string $parse_mode = "HTML",
        ?array $reply_markup = null,
    ): void {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "message_id" => $this->update->message->message_id,
                "caption" => $caption,
                "prase_mode" => $parse_mode,
                "reply_markup" => $reply_markup
                    ? json_encode($reply_markup)
                    : null,
            ],
        ];

        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "editMessageCaption",
            params: $body,
        );
    }

    public function editMessageReplyMarkup(array $reply_markup): void
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "message_id" => $this->update->message->message_id,
                "reply_markup" => $reply_markup
                    ? json_encode($reply_markup)
                    : null,
            ],
        ];

        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "editMessageReplyMarkup",
            params: $body,
        );
    }

    public function deleteMessage(): void
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "message_id" => $this->update->message->message_id,
            ],
        ];

        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "deleteMessage",
            params: $body,
        );
    }

    public function deleteMessages(array $message_ids): void
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "message_ids" => $message_ids,
            ],
        ];

        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "deleteMessages",
            params: $body,
        );
    }

    public function pinChatMessage(bool $disable_notification = true): void
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "message_id" => $this->update->message->message_id,
                "disable_notification" => $disable_notification,
            ],
        ];

        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "pinChatMessage",
            params: $body,
        );
    }

    public function unpinChatMessage(): void
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "message_id" => $this->update->message->message_id,
            ],
        ];

        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "unpinChatMessage",
            params: $body,
        );
    }

    public function unpinAllChatMessages(): void
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
            ],
        ];

        $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "unpinAllChatMessages",
            params: $body,
        );
    }
}
