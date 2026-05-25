<?php

namespace TGram\Executors;

use Closure;
use TGram\Exceptions\{InvalidClassMethodException, InvalidNamespaceException};

abstract class BaseExecutor
{
    protected const ARRAY_CALLABLE_SIZE = 2;

    protected function resolve(Closure|array|null $handler): ?callable
    {
        if (is_null($handler)) return null;

        if ($handler instanceof Closure) return $handler;

        if (
            is_array($handler) &&
            count($handler) === self::ARRAY_CALLABLE_SIZE
        ) {
            [$namespace, $method] = $handler;

            if (!class_exists($namespace)) {
                throw new InvalidNamespaceException(
                    "Class does not exist: {$namespace}",
                );
            }

            $instance = new $namespace();

            if (!method_exists($instance, $method)) {
                throw new InvalidClassMethodException(
                    "Method does not exist: {$namespace}:{$method}",
                );
            }

            return [$instance, $method];
        }

        return null;
    }
}
