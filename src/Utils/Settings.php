<?php

namespace TGram\Utils;

use TGram\Interfaces\Settings as ISettings;

final class Settings implements ISettings
{
    private static $data = [];

    public static function set(array $settings): void
    {
        self::$data = $settings;
    }

    public static function get(string $key): mixed
    {
        return self::$data[$key] ?? null;
    }

    public static function getAll(): array
    {
        return self::$data;
    }
}
