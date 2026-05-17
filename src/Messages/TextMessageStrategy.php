<?php

namespace TGram\Messages;

use TGram\Context;
use TGram\Interfaces\MessageStrategy;

final class TextMessageStrategy implements MessageStrategy
{
    public function __construct(private string $input, private array $hears) {}

    public function handle(Context $context): void
    {
        $callback =
            $this->hears[$this->input] ??
            fn(Context $ctx) => $ctx->sendMessage("Invalid message!");

        call_user_func($callback, $context);
    }
}
