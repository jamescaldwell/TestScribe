<?php
namespace Box\TestScribe\Mock;

use Box\TestScribe\GlobalCounter;
use Box\TestScribe\ClassInfo\PhpClass;
use Box\TestScribe\ClassInfo\PhpClassName;

/**
 * Class MockClassFactory
 * @package Box\TestScribe
 *
 * @var MockClassService | GlobalCounter
 */
class MockClassFactory
{
    /** @var MockClassService */
    private $mockClassService;

    /** @var GlobalCounter */
    private $globalCounter;

    /**
     * @param \Box\TestScribe\Mock\MockClassService $mockClassService
     * @param \Box\TestScribe\GlobalCounter    $globalCounter
     */
    function __construct(
        MockClassService $mockClassService,
        GlobalCounter $globalCounter
    )
    {
        $this->mockClassService = $mockClassService;
        $this->globalCounter = $globalCounter;
    }

    /**
     * @param string $className
     * @param bool   $isStatic
     * @param string $nameOfTheMethodToPassThrough
     *   If not empty string, it tells this instance to pass calls to
     *   this method to the real object of the class being mocked
     *   and continue to mock other methods.
     *   If it is empty, it tells this instance to mock all methods.
     *
     * @return \Box\TestScribe\Mock\MockClass
     * @throws \DI\NotFoundException
     */
    public function create(
        $className,
        $isStatic,
        $nameOfTheMethodToPassThrough
    )
    {
        $phpClassName = new PhpClassName($className);
        $phpClass = new PhpClass($phpClassName);
        $mockObjectName = $this->createMockObjectName($phpClassName);

        $mock = new MockClass(
            $this->mockClassService,
            $phpClass,
            $isStatic,
            $nameOfTheMethodToPassThrough,
            $mockObjectName
        );

        return $mock;
    }

    /**
     * Return an unique name for the mock object.
     * This name is NOT prefixed with '$'.
     *
     * @param \Box\TestScribe\ClassInfo\PhpClassName $phpClassName
     *
     * @return string
     */
    private function createMockObjectName(
        PhpClassName $phpClassName
    )
    {
        // We want a global unique number to avoid naming collision when
        // the same class is mocked for static invocation and instance invocation.

        $counter = $this->globalCounter->getNextCounter();

        $simpleClassName = $phpClassName->getClassName();

        $name = 'mock' . $simpleClassName . $counter;

        return $name;
    }
}
