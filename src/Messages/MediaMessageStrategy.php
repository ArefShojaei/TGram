<?php

namespace TGram\Messages;

use TGram\Context;
use TGram\Interfaces\MessageStrategy;

final class MediaMessageStrategy implements MessageStrategy
{
    public function __construct(private string $event, private array $events) {}

    public function handle(Context $context): void
    {
        $callback =
            $this->events[$this->event] ??
            fn(Context $ctx) => $ctx->sendMessage("Media not supported!");

        call_user_func($callback, $context);
    }
}
