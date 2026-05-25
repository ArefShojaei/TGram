<?php

namespace TGram\Executors;

use Closure;
use TGram\Context;

abstract class MiddlewareExecutor
{
    private const ARRAY_CALLABLE_SIZE = 2;

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
        callable $next
    ): void {
        is_array($middleware) &&
        count($middleware) === self::ARRAY_CALLABLE_SIZE
            ? $this->executeArrayCallable($middleware, $context, $next)
            : $this->executeClosure($middleware, $context, $next);
    }

    private function executeClosure(
        Closure $middleware,
        Context $context,
        callable $next
    ): void {
        call_user_func($middleware, $context, $next);
    }

    private function executeArrayCallable(
        array $middleware,
        Context $context,
        callable $next
    ): void {
        $namespace = current($middleware);
        $method = end($middleware);

        $instnace = new $namespace();

        $instnace->{$method}($context, $next);
    }
}
