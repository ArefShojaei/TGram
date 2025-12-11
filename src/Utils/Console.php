<?php

namespace TGram\Utils;

use TGram\Enums\Console\{Color, Label};
use TGram\Interfaces\Console as IConsole;


final class Console implements IConsole
{
    public static function log(string $message): string
    {
        $level = "[" . Label::LOG->value . "]";

        return self::print($level, $message);
    }

    public static function info(string $message): string
    {
        $level = self::make(Color::BG_BLUE, "[" . Label::INFO->value . "]");
        $message = self::make(Color::TEXT_BLUE, $message);

        return self::print($level, $message);
    }

    public static function success(string $message): string
    {
        $level = self::make(Color::BG_GREEN, "[" . Label::SUCCESS->value . "]");
        $message = self::make(Color::TEXT_GREEN, $message);

        return self::print($level, $message);
    }

    public static function warn(string $message): string
    {
        $level = self::make(Color::BG_YELLOW, "[" . Label::WARN->value . "]");
        $message = self::make(Color::TEXT_YELLOW, $message);

        return self::print($level, $message);
    }

    public static function error(string $message): string
    {
        $level = self::make(Color::BG_RED, "[" . Label::ERROR->value . "]");
        $message = self::make(Color::TEXT_RED, $message);

        return self::print($level, $message);
    }

    private static function make(Color $color, string $content): string
    {
        return Color::ALIAS->value .
            Color::SYMBOL->value .
            $color->value .
            $content .
            Color::ALIAS->value .
            Color::SYMBOL->value .
            Color::RESET->value;
    }

    private static function print(string $level, string $message): string
    {
        return "{$level} {$message}";
    }
}
