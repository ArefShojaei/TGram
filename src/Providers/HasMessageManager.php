<?php

namespace TGram\Providers;

use TGram\Enums\{HttpMethod, ChatAction};
use TGram\Exceptions\ValidationException;

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
    ): object {
        if (empty(trim($text))) {
            throw new ValidationException("Message text cannot be empty");
        }

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
        ?array $reply_markup = null,
    ): object {
        if (empty(trim($text))) {
            throw new ValidationException("Message text cannot be empty");
        }

        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "message_id" => $this->update->message->message_id,
                "text" => $text,
                "parse_mode" => $parse_mode,
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
        ?array $reply_markup = null,
    ): object {
        if (empty(trim($caption))) {
            throw new ValidationException("Caption cannot be empty");
        }

        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "message_id" => $this->update->message->message_id,
                "caption" => $caption,
                "parse_mode" => $parse_mode,
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
                "reply_markup" => json_encode($reply_markup),
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "editMessageReplyMarkup",
            params: $body,
        );
    }

    public function editMessageMedia(
        array $media,
        ?array $reply_markup = null,
    ): object {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "message_id" => $this->update->message->message_id,
                "media" => json_encode($media),
                "reply_markup" => $reply_markup
                    ? json_encode($reply_markup)
                    : null,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::UPDATABLE,
            endpoint: "editMessageMedia",
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
        if (empty($message_ids)) {
            throw new ValidationException("Message IDs array cannot be empty");
        }

        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "message_ids" => json_encode($message_ids),
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

    public function stopMessageLiveLocation(?array $reply_markup = null): object
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
            method: HttpMethod::UPDATABLE,
            endpoint: "stopMessageLiveLocation",
            params: $body,
        );
    }

    public function editMessageLiveLocation(
        int $messageId,
        float $latitude,
        float $longitude,
        ?array $reply_markup = null,
    ): object {
        if (!is_numeric($latitude) || !is_numeric($longitude)) {
            throw new ValidationException(
                "Latitude and Longitude must be numeric",
            );
        }

        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "message_id" => $messageId,
                "latitude" => $latitude,
                "longitude" => $longitude,
                "reply_markup" => $reply_markup
                    ? json_encode($reply_markup)
                    : null,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::UPDATABLE,
            endpoint: "editMessageLiveLocation",
            params: $body,
        );
    }

    public function stopPoll(
        int $messageId,
        ?array $reply_markup = null,
    ): object {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "message_id" => $messageId,
                "reply_markup" => $reply_markup
                    ? json_encode($reply_markup)
                    : null,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::UPDATABLE,
            endpoint: "stopPoll",
            params: $body,
        );
    }

    public function copyMessage(
        int|string $fromChatId,
        int $messageId,
        ?string $caption = null,
        ?string $parse_mode = null,
        ?array $reply_markup = null,
        ?int $reply_to_message_id = null,
    ): object {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "from_chat_id" => $fromChatId,
                "message_id" => $messageId,
                "caption" => $caption,
                "parse_mode" => $parse_mode,
                "reply_markup" => $reply_markup
                    ? json_encode($reply_markup)
                    : null,
                "reply_to_message_id" => $reply_to_message_id,
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
        int $messageId,
        bool $disable_notification = false,
        bool $protect_content = false,
    ): object {
        $body = [
            "form_params" => [
                "chat_id" => $this->update->chat->id,
                "from_chat_id" => $fromChatId,
                "message_id" => $messageId,
                "disable_notification" => $disable_notification,
                "protect_content" => $protect_content,
            ],
        ];

        return $this->bot->request(
            method: HttpMethod::CREATABLE,
            endpoint: "forwardMessage",
            params: $body,
        );
    }
}
