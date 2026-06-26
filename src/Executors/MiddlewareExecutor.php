<?php

namespace TGram\Executors;

use Closure;

use TGram\Context;

abstract class MiddlewareExecutor extends BaseExecutor
{
    protected ?bool $next = null;

    protected function __construct(Context $context, array $middlewares)
    {
        if (!count($middlewares)) {
            return;
        }

        $this->next = false;

        foreach ($middlewares as $middleware) {
            $this->execute($middleware, $context, fn() => ($this->next = true));
        }
    }

    private function execute(
        Closure|array $middleware,
        Context $context,
        callable $next,
    ): void {
        $callable = $this->resolve($middleware);

        !is_null($callable) && call_user_func($callable, $context, $next);
    }
}
