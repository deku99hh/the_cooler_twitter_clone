<?php

namespace Core;

use ReflectionClass;

class Container
{
    protected static $bindings = [];

    public static function bind($abstract, $concrete)
    {
        static::$bindings[$abstract] = $concrete;
    }

    public static function resolve($className)
    {
        $reflector = new ReflectionClass($className);

        $constructor = $reflector->getConstructor();
        if (!$constructor) {
            return new $className();
        }

        $parameters = $constructor->getParameters();
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $type = $parameter->getType();
            
            if ($type) {
                $interfaceName = $type->getName();
                
                if (isset(static::$bindings[$interfaceName])) {
                    $concreteClass = static::$bindings[$interfaceName];
                    $dependencies[] = static::resolve($concreteClass);
                } else {
                    $dependencies[] = static::resolve($interfaceName);
                }
            }
        }

        return $reflector->newInstanceArgs($dependencies);
    }
}







/*

getMethods(): Returns an array of ReflectionMethod objects for the class.
getProperties(): Returns an array of ReflectionProperty objects.
getConstants(): Returns an array of defined class constants.
getConstructor(): Returns a ReflectionMethod specifically for the constructor.
getDocComment(): Parses the PHPDoc block above the class.
newInstanceArgs(): Dynamically instantiates the class using an array of arguments.

*/