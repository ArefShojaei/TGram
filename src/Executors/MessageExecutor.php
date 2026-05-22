<?php

namespace TGram\Executors;

use Closure;
use TGram\Context;

abstract class MessageExecutor
{
    private const ARRAY_CALLABLE_SIZE = 2;

    protected function execute(
        Closure|array|null $handler,
        Context $context,
    ): void {
        is_array($handler) && count($handler) === self::ARRAY_CALLABLE_SIZE
            ? $this->executeArrayCallable($handler, $context)
            : $this->executeClosure($handler, $context);
    }

    private function executeClosure(?Closure $handler, Context $context): void
    {
        !is_null($handler) && call_user_func($handler, $context);
    }

    private function executeArrayCallable(
        array $handler,
        Context $context,
    ): void {
        $namespace = current($handler);
        $method = end($handler);

        $instnace = new $namespace();

        $instnace->{$method}($context);
    }
}
