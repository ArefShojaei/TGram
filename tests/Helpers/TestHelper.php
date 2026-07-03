<?php

namespace Tests\Helpers;

use ReflectionClass;

/**
 * TestHelper provides utility methods for unit testing.
 * Used to access private properties and methods for testing purposes.
 */
final class TestHelper
{
    /**
     * Get private or protected property value from an object.
     */
    public static function getPrivateProperty(
        object $object,
        string $property,
    ): mixed {
        $reflection = new ReflectionClass($object);

        $reflectionProperty = $reflection->getProperty($property);

        $reflectionProperty->setAccessible(true);

        return $reflectionProperty->getValue($object);
    }

    /**
     * Set private or protected property value on an object.
     */
    public static function setPrivateProperty(
        object $object,
        string $property,
        mixed $value,
    ): void {
        $reflection = new ReflectionClass($object);

        $reflectionProperty = $reflection->getProperty($property);

        $reflectionProperty->setAccessible(true);

        $reflectionProperty->setValue($object, $value);
    }

    /**
     * Call private or protected method on an object.
     */
    public static function callPrivateMethod(
        object $object,
        string $method,
        array $args = [],
    ): mixed {
        $reflection = new ReflectionClass($object);

        $reflectionMethod = $reflection->getMethod($method);

        $reflectionMethod->setAccessible(true);

        return $reflectionMethod->invokeArgs($object, $args);
    }

    /**
     * Check if object has private property.
     */
    public static function hasPrivateProperty(
        object $object,
        string $property,
    ): bool {
        $reflection = new ReflectionClass($object);

        return $reflection->hasProperty($property);
    }
}
