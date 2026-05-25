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
        ?int $message_thread_id = null
    ): object {
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

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "sendMessage",
            params: $body,
        );
    }

    public function sendChatAction(ChatAction $action): object
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "action" => $action->value,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "sendChatAction",
            params: $body,
        );
    }

    public function editMessageText(
        string $text,
        ?string $parse_mode = "HTML",
        ?array $reply_markup = null
    ): object {
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

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "editMessageText",
            params: $body,
        );
    }

    public function editMessageCaption(
        string $caption,
        ?string $parse_mode = "HTML",
        ?array $reply_markup = null
    ): object {
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

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "editMessageCaption",
            params: $body,
        );
    }

    public function editMessageReplyMarkup(array $reply_markup): object
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

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "editMessageReplyMarkup",
            params: $body,
        );
    }

    public function deleteMessage(): object
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "message_id" => $this->update->message->message_id,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "deleteMessage",
            params: $body,
        );
    }

    public function deleteMessages(array $message_ids): object
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "message_ids" => $message_ids,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "deleteMessages",
            params: $body,
        );
    }

    public function pinChatMessage(bool $disable_notification = true): object
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "message_id" => $this->update->message->message_id,
                "disable_notification" => $disable_notification,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "pinChatMessage",
            params: $body,
        );
    }

    public function unpinChatMessage(): object
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "message_id" => $this->update->message->message_id,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "unpinChatMessage",
            params: $body,
        );
    }

    public function unpinAllChatMessages(): object
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "unpinAllChatMessages",
            params: $body,
        );
    }

    public function answerCallbackQuery(
        ?string $text = null,
        bool $showAlert = false
    ): object {
        $body = [
            "form_params" => [
                "callback_query_id" => $this->update->callback_id,
                "text" => $text,
                "show_alert" => $showAlert,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "answerCallbackQuery",
            params: $body,
        );
    }

    public function answerInlineQuery(
        string $inlineQueryId,
        array $results,
        int $cacheTime = 300,
        bool $isPersonal = false
    ): object {
        $body = [
            "form_params" => [
                "inline_query_id" => $inlineQueryId,
                "results" => json_encode($results),
                "cache_time" => $cacheTime,
                "is_personal" => $isPersonal,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "answerInlineQuery",
            params: $body,
        );
    }

    public static function switchInlineQuery(string $text, string $query): array
    {
        return [
            "text" => $text,
            "switch_inline_query" => $query,
        ];
    }

    public function editMessageLiveLocation(
        int $messageId,
        float $latitude,
        float $longitude
    ): object {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "message_id" => $messageId,
                "latitude" => $latitude,
                "longitude" => $longitude,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::UPDATABLE,
            endpoint: "editMessageLiveLocation",
            params: $body,
        );
    }

    public function stopPoll(int $messageId): object
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "message_id" => $messageId,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::UPDATABLE,
            endpoint: "stopPoll",
            params: $body,
        );
    }

    public function copyMessage(int|string $fromChatId, int $messageId): object
    {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "from_chat_id" => $fromChatId,
                "message_id" => $messageId,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "copyMessage",
            params: $body,
        );
    }

    public function forwardMessage(
        int|string $fromChatId,
        int $messageId
    ): object {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "from_chat_id" => $fromChatId,
                "message_id" => $messageId,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "forwardMessage",
            params: $body,
        );
    }
}
