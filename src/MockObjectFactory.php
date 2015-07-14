<?php
/**
 *
 */

namespace Box\TestScribe;

/**
 * Class MockObjectFactory
 * @package Box\TestScribe
 *
 * @var MockClassLoader
 */
class MockObjectFactory
{
    /**
     * Create an instance of the mock object of the given mock class.
     *
     * @param \Box\TestScribe\MockClass $mock
     * @param array                               $arguments
     *  Arguments to the constructor
     *
     * @return object
     */
    public function createMockObjectFromMockClass(
        MockClass $mock,
        array $arguments
    )
    {
        $mockClassName = $mock->getMockClassName();
        $reflectionClass = new \ReflectionClass($mockClassName);
        array_unshift($arguments, $mock);
        $obj = $reflectionClass->newInstanceArgs($arguments);
        if (!$obj) {
            throw new \RuntimeException(
                "Can't instantiate mock class ( $mockClassName )."
            );
        }

        return $obj;
    }
}
