<?php

namespace TGram\Interfaces\Command;

use Closure;
use TGram\Enums\MediaType;

interface CommandListener
{
    public function command(string $command, Closure|array $handler): void;

    public function hears(string $pattern, Closure|array $handler): void;

    public function on(MediaType $event, Closure|array $handler): void;

    public function callback(Closure $handler): void;

    public function start(Closure|array $handler): void;

    public function help(Closure|array $handler): void;
}
