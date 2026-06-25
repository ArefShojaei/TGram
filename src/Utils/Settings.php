<?php

namespace TGram\Utils;

use TGram\Interfaces\Settings as ISettings;

final class Settings implements ISettings
{
    private static $data = [];

    public static function set(array $settings): void
    {
        self::$data = array_replace_recursive(self::$data, $settings);
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        $segments = explode(".", $key);

        $data = self::$data;

        foreach ($segments as $segment) {
            if (!isset($data[$segment])) return $default;

            $data = $data[$segment];
        }

        return $data;
    }

    public static function getAll(): array
    {
        return self::$data;
    }
}
