<?php

namespace TGram\Interfaces;

interface Settings
{
    public static function set(array $settings): void;

    public static function get(string $key, mixed $default = null): mixed;

    public static function getAll(): array;
}
