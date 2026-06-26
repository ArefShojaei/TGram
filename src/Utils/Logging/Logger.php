<?php

namespace TGram\Utils\Logging;

use TGram\Interfaces\Loggable;
use TGram\Utils\Settings;

final class Logger implements Loggable
{
    public static function log(string $message): void
    {
        if (!Settings::get("logging.enabled")) return;

        $message = self::createLogMessage($message);

        file_put_contents(
            Settings::get("logging.path"),
            $message . PHP_EOL,
            FILE_APPEND,
        );
    }

    private static function createLogMessage(string $message): string
    {
        $now = date("Y-m-d H:h:s");

        return "[{$now}] {$message}";
    }
}
