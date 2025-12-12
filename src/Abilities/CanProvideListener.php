<?php

namespace TGram\Abilities;

use TGram\Enums\MediaType;


trait CanProvideListener
{
    private array $commands = [];

    private array $hears = [];

    private array $events = [];

    private ?object $fallback = null;


    public function command(string $command, callable $callback): void
    {
        $command = ltrim($command, "/");

        if (!isset($this->commands[$command])) {
            $this->commands[$command] = $callback;
        }
    }

    public function hears(string $pattern, callable $callback): void
    {
        if (!isset($this->hears[$pattern])) {
            $this->hears[$pattern] = $callback;
        }
    }

    public function on(MediaType $event, callable $callback): void
    {
        if (!isset($this->events[$event->value])) {
            $this->events[$event->value] = $callback;
        }
    }

    public function fallback(callable $callback): void
    {
        $this->fallback = $callback;
    }

    public function start(callable $callback): void
    {
        $this->command("start", $callback);
    }

    public function help(callable $callback): void
    {
        $this->command("help", $callback);
    }
}
