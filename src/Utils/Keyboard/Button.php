<?php

namespace TGram\Utils\Keyboard;

use TGram\Interfaces\Keyboard\KeyboardButton;

final class Button implements KeyboardButton
{
    public static function url(string $text, string $address): array
    {
        return [
            "text" => $text,
            "url" => $address,
        ];
    }

    public static function login(string $text, string $address): array
    {
        return [
            "text" => $text,
            "login_url" => [
                "url" => $address
            ],
        ];
    }

    public static function text(string $text): array
    {
        return [
            "text" => $text,
        ];
    }

    public static function callback(string $text, mixed $data): array
    {
        return [
            "text" => $text,
            "callback_data" => $data,
        ];
    }

    public static function contact(string $text): array
    {
        return [
            "text" => $text,
            "request_contact" => true,
        ];
    }

    public static function location(string $text): array
    {
        return [
            "text" => $text,
            "request_location" => true,
        ];
    }
}
