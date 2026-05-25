<?php

namespace Tests\Helpers;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;

/**
 * TestHelper provides utility methods for unit testing.
 * Used to access private properties and methods for testing purposes.
 */
class TestHelper
{
    /**
     * Get private or protected property value from an object.
     * 
     * @param object $object The object instance
     * @param string $property Property name
     * @return mixed The property value
     */
    public static function getPrivateProperty($object, $property)
    {
        $reflection = new ReflectionClass($object);
        $reflectionProperty = $reflection->getProperty($property);
        $reflectionProperty->setAccessible(true);
        return $reflectionProperty->getValue($object);
    }

    /**
     * Set private or protected property value on an object.
     * 
     * @param object $object The object instance
     * @param string $property Property name
     * @param mixed $value The value to set
     * @return void
     */
    public static function setPrivateProperty($object, $property, $value)
    {
        $reflection = new ReflectionClass($object);
        $reflectionProperty = $reflection->getProperty($property);
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($object, $value);
    }

    /**
     * Call private or protected method on an object.
     * 
     * @param object $object The object instance
     * @param string $method Method name
     * @param array $args Arguments to pass to the method
     * @return mixed The method return value
     */
    public static function callPrivateMethod($object, $method, $args = [])
    {
        $reflection = new ReflectionClass($object);
        $reflectionMethod = $reflection->getMethod($method);
        $reflectionMethod->setAccessible(true);
        return $reflectionMethod->invokeArgs($object, $args);
    }

    /**
     * Check if object has private property.
     * 
     * @param object $object The object instance
     * @param string $property Property name
     * @return bool True if property exists
     */
    public static function hasPrivateProperty($object, $property): bool
    {
        $reflection = new ReflectionClass($object);
        return $reflection->hasProperty($property);
    }
}
