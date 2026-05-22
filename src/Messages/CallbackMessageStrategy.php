<?php

namespace TGram\Messages;

use TGram\Context;
use TGram\Interfaces\Message\MessageStrategy;

final class CallbackMessageStrategy implements MessageStrategy
{
    public function __construct(private ?object $callback) {}

    public function handle(Context $context): void
    {
        !is_null($this->callback) && call_user_func($this->callback, $context);
    }
}
