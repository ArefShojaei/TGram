<?php

namespace TGram\Abilities;

use TGram\Enums\HttpVerb;


trait CanManageMessage
{
    public function sendMessage(int $chatId, string $text, array $options = []): object
    {
        $body = [
            "chat_id" => $chatId,
            "text" => $text,
            "parse_mode" => "HTML",
            ...$options
        ];

        return $this->request(
            method: HttpVerb::CREATABLE,
            endpoint: "sendMessage",
            options: $body,
        );
    }

    public function deleteMessage(int $chatId, int $messageId, array $options = []): object
    {
        $body = [
            "chat_id" => $chatId,
            "message_id" => $messageId,
            ...$options,
        ];

        return $this->request(
            method: HttpVerb::CREATABLE,
            endpoint: "deleteMessage",
            options: $body,
        );
    }
}

