<?php

namespace TGram\Abilities;

use TGram\Enums\HttpVerb;


trait CanSendMedia
{
    public function sendLocation(
        int $chatId,
        float $lat,
        float $lon,
        array $options = [],
    ): object {
        $body = [
            "chat_id" => $chatId,
            "latitude" => $lat,
            "longitude" => $lon,
            ...$options,
        ];

        return $this->request(
            method: HttpVerb::CREATABLE,
            endpoint: "sendLocation",
            options: $body,
        );
    }

    public function sendContact(
        int $chatId,
        string $phone,
        string $firstName,
        array $options = [],
    ): object {
        $body = [
            "chat_id" => $chatId,
            "phone_number" => $phone,
            "first_name" => $firstName,
            ...$options,
        ];

        return $this->request(
            method: HttpVerb::CREATABLE,
            endpoint: "sendContact",
            options: $body,
        );
    }

    public function sendPhoto(
        int $chatId,
        string $src,
        string $caption = "",
        array $options = [],
    ): object {
        $body = [
            "chat_id" => $chatId,
            "photo" => $src,
            "caption" => $caption,
            ...$options,
        ];

        return $this->request(
            method: HttpVerb::CREATABLE,
            endpoint: "sendPhoto",
            options: $body,
        );
    }

    public function sendAudio(
        int $chatId,
        string $src,
        string $caption = "",
        array $options = [],
    ): object {
        $body = [
            "chat_id" => $chatId,
            "audio" => $src,
            "caption" => $caption,
            ...$options,
        ];

        return $this->request(
            method: HttpVerb::CREATABLE,
            endpoint: "sendAudio",
            options: $body,
        );
    }

    public function sendAnimation(
        int $chatId,
        string $src,
        string $caption = "",
        array $options = [],
    ): object {
        $body = [
            "chat_id" => $chatId,
            "animation" => $src,
            "caption" => $caption,
            ...$options,
        ];

        return $this->request(
            method: HttpVerb::CREATABLE,
            endpoint: "sendAnimation",
            options: $body,
        );
    }

    public function sendSticker(
        int $chatId,
        string $src,
        array $options = [],
    ): object {
        $body = [
            "chat_id" => $chatId,
            "sticker" => $src,
            ...$options,
        ];

        return $this->request(
            method: HttpVerb::CREATABLE,
            endpoint: "sendSticker",
            options: $body,
        );
    }
}
