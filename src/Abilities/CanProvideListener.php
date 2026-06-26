<?php

namespace TGram\Abilities;

use Closure;

use TGram\Enums\MediaType;

trait CanProvideListener
{
    use CanProvideListenerState;

    private array $middlewares = [];

    private array $commands = [];

    private array $hears = [];

    private array $events = [];

    private ?Closure $callback = null;

    public function use(Closure|array $middleware): void
    {
        $this->middlewares[] = $middleware;
    }

    public function command(string $command, Closure|array $handler): void
    {
        $command = ltrim($command, "/");

        if (!isset($this->commands[$command])) {
            $this->commands[$command] = $handler;
        }
    }

    public function hears(string $pattern, Closure|array $handler): void
    {
        if (!isset($this->hears[$pattern])) {
            $this->hears[$pattern] = $handler;
        }
    }

    public function on(MediaType $event, Closure|array $handler): void
    {
        if (!isset($this->events[$event->value])) {
            $this->events[$event->value] = $handler;
        }
    }

    public function callback(Closure $handler): void
    {
        $this->callback = $handler;
    }

    public function start(Closure|array $handler): void
    {
        $this->command("start", $handler);
    }

    public function help(Closure|array $handler): void
    {
        $this->command("help", $handler);
    }
}
