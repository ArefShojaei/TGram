<?php

namespace TGram\Messages;

use TGram\Context;
use TGram\Executors\MessageExecutor;
use TGram\Interfaces\Message\MessageStrategy;

final class CallbackMessageStrategy extends MessageExecutor implements
    MessageStrategy
{
    public function __construct(private ?object $callback) {}

    public function handle(Context $context): void
    {
        $this->execute($this->callback, $context);
    }
}
