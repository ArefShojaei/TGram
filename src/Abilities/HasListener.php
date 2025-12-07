<?php

namespace TGram\Abilities;

use TGram\Enums\MediaReciver;


trait HasListener
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

    public function on(MediaReciver $event, callable $callback): void
    {
        if (!isset($this->events[$event->value])) {
            $this->events[$event->value] = $callback;
        }
    }

    public function fallback(callable $callback): void
    {
        $this->fallback = $callback;
    }
}
