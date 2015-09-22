<?php


namespace Box\TestScribe\Mock;

use Box\TestScribe\Utils\ReflectionUtil;


/**
 * @var ReflectionUtil
 */
class PartialMockUtil
{
    /** @var ReflectionUtil */
    private $reflectionUtil;

    /**
     * @param \Box\TestScribe\Utils\ReflectionUtil $reflectionUtil
     */
    function __construct(
        ReflectionUtil $reflectionUtil
    )
    {
        $this->reflectionUtil = $reflectionUtil;
    }

    /**
     * Return true if partial mocking of the class under test is selected.
     *
     * @param \Box\TestScribe\Mock\MockClass|null $mockClassUnderTest
     *
     * @return bool
     */
    public function isClassUnderTestPartiallyMocked(
        $mockClassUnderTest
    )
    {
        if ($mockClassUnderTest === null) {
            // Testing a static method will not create a mock class under test
            // since partial mocking for static methods is not supported.
            return false;
        }

        $nameOfClassBeingMocked = $mockClassUnderTest->getClassNameBeingMocked();
        $isAbstract = $this->reflectionUtil->isAbstractClass($nameOfClassBeingMocked);
        if ($isAbstract){
            // Always use partial mocking when testing an abstract class.
            // The mock class is a concrete class that can be instantiated.
            // The abstract class can't be instantiated.
            return true;
        }

        // Only use partial mocking when the other public/protected methods of the
        // class under test are invoked during execution of the method under test.
        $mockMethodInvocations = $mockClassUnderTest->getMethodInvocations();
        $count = count($mockMethodInvocations);

        return ($count !== 0);
    }

}
