<?php

namespace TGram\Messages;

use TGram\Context;
use TGram\Interfaces\MessageStrategy;

final class CommandMessageStrategy implements MessageStrategy
{
    public function __construct(
        private string $input,
        private array $commands,
    ) {}

    public function handle(Context $context): void
    {
        $command = ltrim($this->input, "/");

        $callback =
            $this->commands[$command] ??
            fn(Context $ctx) => $ctx->sendMessage("Command not supported!");

        call_user_func($callback, $context);
    }
}
