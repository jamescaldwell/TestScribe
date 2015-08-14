<?php
/**
 *
 */

namespace Box\TestScribe;

/**
 * Create and load mock classes for instance method invocations only.
 *
 * @var MockClassFactory | ClassBuilder
 */
class MockClassLoader
{
    /** @var MockClassFactory */
    private $mockClassFactory;

    /** @var ClassBuilder */
    private $classBuilder;

    /**
     * @param \Box\TestScribe\MockClassFactory $mockClassFactory
     * @param \Box\TestScribe\ClassBuilder     $classBuilder
     */
    function __construct(
        MockClassFactory $mockClassFactory,
        ClassBuilder $classBuilder
    )
    {
        $this->mockClassFactory = $mockClassFactory;
        $this->classBuilder = $classBuilder;
    }

    /**
     * Create and load the definition of a mock class
     * for instance method invocations only.
     *
     * @param string $className
     * @param string $nameOfTheMethodToPassThrough
     *   If not empty string, it tells this instance to pass calls to
     *   this method to the real object of the class being mocked
     *   and continue to mock other methods.
     *   If it is empty, it tells this instance to mock all methods.
     *
     * @return \Box\TestScribe\Mock\MockClass
     * @throws \DI\NotFoundException
     */
    public function createAndLoadMockClass(
        $className,
        $nameOfTheMethodToPassThrough
    )
    {
        $mockClass = $this->mockClassFactory->create(
            $className,
            false,
            $nameOfTheMethodToPassThrough
        );

        $mockObjectName = $mockClass->getMockObjectName();

        // Use my own implementation of mock objects which will
        // intercept protected methods.
        $mockClassName = $this->classBuilder->create(
            $mockObjectName,
            $className,
            $nameOfTheMethodToPassThrough
        );
        $mockClass->setMockClassName($mockClassName);

        return $mockClass;
    }
}
