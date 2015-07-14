<?php
/**
 *
 */

namespace Box\TestScribe\_fixture;

use Box\TestScribe\App;
use ReflectionClass;


/**
 * Simple service locator implementation for testing.
 * Modeled after the web app Diesel implementation.
 */
class ServiceLocator
{
    /**
     * @var array Registry
     */
    private static $overrides = [];

    /**
     * Clears the overrides registry.
     *
     * @NOTE: THIS SHOULD ONLY BE CALLED FROM TESTS
     * @return void
     */
    public static function clearOverrides()
    {
        self::$overrides = [];
    }

    /**
     * Overwrites a registration for a class name and replaces any requests for
     * that class object with the given instance
     *
     * @param string $classname
     * @param object $instance - an instance of an object
     *
     * @NOTE: THIS SHOULD ONLY BE CALLED FROM TESTS
     * @return void
     */
    public static function overwrite($classname, $instance)
    {
        self::$overrides[$classname] = $instance;
    }

    /**
     * @param  string $className
     * @param  array  $arguments
     *
     * @return object
     */
    public static function resolve($className, $arguments = array())
    {
        // Added another caller layer for now to mimic the call depth 
        // of Diesel which has __callStatic layer.
        
        // @TODO (ryang 1/27/15) : after it is configurable the distance 
        // between resolve call and App::createMockedInstance,
        // remove this layer.
        return self::resolve_internal($className, $arguments);
    }

    /**
     * @param  string $className
     * @param  array  $arguments
     *
     * @return object
     */
    public static function resolve_internal($className, $arguments = array())
    {
        if (App::$shouldInjectMockObjects) {
            // It allows the test generator to substitute the real class instance with a
            // mock object controlled by the test generator so that the test
            // generator can monitor the creation and execution of the class
            // being resolved.
            $mock = App::createMockedInstance(
                $className,
                $arguments
            );
            if ($mock) {
                return $mock;
            }
            // If null is returned by the unit test generator,
            // it means that the developer has decided not to mock this class.
            // Proceed with creating the real object.
        }

        $singletonOrInstantiator = null;
        $isOverride = isset(self::$overrides[$className]);
        if ($isOverride) {
            return self::$overrides[$className];
        } else {
            return self::createNewInstanceWithArguments($className, $arguments);
        }
    }
    
    /**
     * @param  string $className
     * @param  array  $arguments
     *
     * @return object
     */
    private static function createNewInstanceWithArguments($className, $arguments)
    {
        if (count($arguments) == 0) {
            return new $className();
        } else {
            // Pass the arguments through to the constructor
            $class = new ReflectionClass($className);

            return $class->newInstanceArgs($arguments);
        }
    }
    

}
