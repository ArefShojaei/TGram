<?php

namespace TGram\Interfaces\Command;

interface CommandListenerState {
    public function getCommandList(): array;

    public function getHears(): array;

    public function getEvents(): array;

    public function getCallback(): ?object;
}
