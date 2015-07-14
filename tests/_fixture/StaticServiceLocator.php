<?php
/**
 *
 */

namespace Box\TestScribe\_fixture;

use Box\TestScribe\App;


/**
 * Simple service locator implementation for testing
 * intercepting static calls.
 *
 * Modeled after the web app Statics implementation.
 */
class StaticServiceLocator
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
     * that class object with the given name.
     *
     * @param string $classname
     * @param string $replacementClassName
     *
     * @NOTE: THIS SHOULD ONLY BE CALLED FROM TESTS
     * @return void
     */
    public static function overwrite($classname, $replacementClassName)
    {
        self::$overrides[$classname] = $replacementClassName;
    }

    /**
     * @param  string $className
     *
     * @return string
     */
    public static function resolve($className)
    {
        
        // Added another caller layer for now to mimic the call depth 
        // of Statics which has __callStatic layer.
        
        // Can't use __callStatic since it doesn't support namespaces.
        
        // @TODO (ryang 1/27/15) : after it is configurable the distance 
        // between resolve call and App::createMockedInstance,
        // remove this layer.
        return self::resolveInternal($className);
 
    }
    /**
     * @param  string $className
     *
     * @return string
     */
    public static function resolveInternal($className)
    {
        if (App::$shouldInjectMockObjects) {
            // It allows the test generator to substitue the real class instance with a
            // mock object controlled by the test generator so that the test
            // generator can monitor the creation and execution of the class
            // being resolved.
            $mock = App::createMockedClass(
                $className
            );
            if ($mock) {
                return $mock;
            }
            // If null is returned by the unit test generator,
            // it means that the developer has decided not to mock this class.
            // Proceed with creating the original class name.
        }

        return $className;
    }

}
