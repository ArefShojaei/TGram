<?php

namespace Tests\Fixtures;

/**
 * FakeTelegramBotToken provides mock Telegram bot token data for testing.
 */
final class FakeTelegramBotToken
{
    public static function getValidToken(): string
    {
        return "123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11";
    }

    public static function getInvalidToken(): string
    {
        return "defghijklmnopqrstuvwxyz_1234567890";
    }

    public static function getEmptyToken(): string
    {
        return "";
    }

    public static function getEmptyTokenWithWhitespace(): string
    {
        return "       ";
    }
}
