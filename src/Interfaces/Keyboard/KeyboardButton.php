<?php

namespace TGram\Interfaces\Keyboard;

interface KeyboardButton
{
    public static function url(string $text, string $address): array;

    public static function login(string $text, string $address): array;

    public static function text(string $text): array;

    public static function callback(string $text, mixed $data): array;

    public static function contact(string $text): array;

    public static function location(string $text): array;
}
