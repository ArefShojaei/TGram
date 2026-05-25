<?php

namespace TGram\Abilities;

trait CanProvideListenerState
{
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    public function getCommandList(): array
    {
        return $this->commands;
    }

    public function getHears(): array
    {
        return $this->hears;
    }

    public function getEvents(): array
    {
        return $this->events;
    }

    public function getCallback(): ?object
    {
        return $this->callback;
    }
}
