<?php

namespace TGram\Utils\Keyboard;

use TGram\Interfaces\Keyboard\KeyboardButton;

final class Button implements KeyboardButton
{
    public static function url(string $text, string $url): array
    {
        return [
            "text" => $text,
            "url" => $url,
        ];
    }

    public static function login(string $text, string $url): array
    {
        return [
            "text" => $text,
            "login_url" => [
                "url" => $url,
            ],
        ];
    }

    public static function text(string $text): array
    {
        return [
            "text" => $text,
        ];
    }

    public static function callback(string $text, string $data): array
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

    public static function webApp(string $text, string $url): array
    {
        return [
            "text" => $text,
            "web_app" => [
                "url" => $url,
            ],
        ];
    }
}
