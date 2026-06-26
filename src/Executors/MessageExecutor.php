<?php

namespace TGram\Executors;

use Closure;

use TGram\Context;

abstract class MessageExecutor extends BaseExecutor
{
    protected function execute(
        Closure|array|null $handler,
        Context $context,
    ): void {
        $callable = $this->resolve($handler);

        !is_null($callable) && call_user_func($callable, $context);
    }
}
