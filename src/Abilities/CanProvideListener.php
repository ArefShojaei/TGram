<?php

namespace TGram\Abilities;

use Closure;
use TGram\Enums\MediaType;

trait CanProvideListener
{
    use CanProvideListenerState;

    private array $commands = [];

    private array $hears = [];

    private array $events = [];

    private ?object $fallback = null;

    public function command(string $command, Closure $callback): void
    {
        $command = ltrim($command, "/");

        if (!isset($this->commands[$command])) {
            $this->commands[$command] = $callback;
        }
    }

    public function hears(string $pattern, Closure $callback): void
    {
        if (!isset($this->hears[$pattern])) {
            $this->hears[$pattern] = $callback;
        }
    }

    public function on(MediaType $event, Closure $callback): void
    {
        if (!isset($this->events[$event->value])) {
            $this->events[$event->value] = $callback;
        }
    }

    public function fallback(Closure $callback): void
    {
        $this->fallback = $callback;
    }

    public function start(Closure $callback): void
    {
        $this->command("start", $callback);
    }

    public function help(Closure $callback): void
    {
        $this->command("help", $callback);
    }
}
