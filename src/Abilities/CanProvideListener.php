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

    private ?object $callback = null;

    public function command(string $command, Closure $handler): void
    {
        $command = ltrim($command, "/");

        if (!isset($this->commands[$command])) {
            $this->commands[$command] = $handler;
        }
    }

    public function hears(string $pattern, Closure $handler): void
    {
        if (!isset($this->hears[$pattern])) {
            $this->hears[$pattern] = $handler;
        }
    }

    public function on(MediaType $event, Closure $handler): void
    {
        if (!isset($this->events[$event->value])) {
            $this->events[$event->value] = $handler;
        }
    }

    public function callback(Closure $handler): void
    {
        $this->callback = $handler;
    }

    public function start(Closure $handler): void
    {
        $this->command("start", $handler);
    }

    public function help(Closure $handler): void
    {
        $this->command("help", $handler);
    }
}
