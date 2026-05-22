<?php

namespace TGram\Interfaces\Command;

use Closure;
use TGram\Enums\MediaType;

interface CommandListener
{
    public function command(string $command, Closure $handler): void;

    public function hears(string $pattern, Closure $handler): void;

    public function on(MediaType $event, Closure $handler): void;

    public function callback(Closure $handler): void;

    public function start(Closure $handler): void;

    public function help(Closure $handler): void;
}
