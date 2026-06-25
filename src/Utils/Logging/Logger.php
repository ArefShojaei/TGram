<?php

namespace TGram\Utils\Logging;

use TGram\Interfaces\Loggable;
use TGram\Utils\Settings;

final class Logger implements Loggable
{
    public static function log(string $message): void
    {
        if (!Settings::get("logging.enabled")) return;

        file_put_contents(
            Settings::get("logging.path"),
            $message . PHP_EOL,
            FILE_APPEND,
        );
    }
}
