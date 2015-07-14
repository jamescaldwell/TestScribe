<?php

namespace Box\TestScribe;

/**
 * Helper methods for Method class
 */
class MethodHelper
{
    /**
     * @param PhpClass $class
     * @param string   $methodName
     *
     * @return \Box\TestScribe\Method
     */
    public function createFromMethodName(PhpClass $class, $methodName)
    {
        $classUnderTest = $class->getReflectionClass();

        // A ReflectionException will be thrown if the method does not exist.
        // @see http://php.net/manual/en/reflectionclass.getmethod.php
        $reflectionMethod = $classUnderTest->getMethod($methodName);
        $method = new Method($class, $reflectionMethod);

        return $method;
    }

    /**
     * Create the Method class instance that represents the constructor of the class
     * under test.
     *
     * @param PhpClass $class
     *
     * @return Method|null
     */
    public function createConstructor(PhpClass $class)
    {
        $classUnderTest = $class->getReflectionClass();
        $reflectionMethod = $classUnderTest->getConstructor();
        if (!$reflectionMethod) {
            return null;
        }
        $method = new Method($class, $reflectionMethod);

        return $method;
    }
}
