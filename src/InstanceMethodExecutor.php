<?php
namespace Box\TestScribe;

use Box\TestScribe\Utils\ReflectionUtil;

/**
 * Execute the method under test.
 *
 * @var   ReflectionUtil| ArgumentsCollector| ClassUnderTestMockCreator
 */
class InstanceMethodExecutor
{
    /** @var ReflectionUtil */
    private $reflectionUtil;

    /** @var ArgumentsCollector */
    private $argumentsCollector;

    /** @var ClassUnderTestMockCreator */
    private $classUnderTestMockCreator;

    /**
     * @param \Box\TestScribe\Utils\ReflectionUtil      $reflectionUtil
     * @param \Box\TestScribe\ArgumentsCollector        $argumentsCollector
     * @param \Box\TestScribe\ClassUnderTestMockCreator $classUnderTestMockCreator
     */
    function __construct(
        ReflectionUtil $reflectionUtil,
        ArgumentsCollector $argumentsCollector,
        ClassUnderTestMockCreator $classUnderTestMockCreator
    )
    {
        $this->reflectionUtil = $reflectionUtil;
        $this->argumentsCollector = $argumentsCollector;
        $this->classUnderTestMockCreator = $classUnderTestMockCreator;
    }

    /**
     * @param \Box\TestScribe\MockClass $mockClassUnderTest
     * @param \Box\TestScribe\Method    $method
     *
     * @return \Box\TestScribe\InstanceMethodExecutionResultValue
     */
    public function runInstanceMethod(
        MockClass $mockClassUnderTest,
        Method $method
    )
    {
        $mockCreationResult =
            $this->classUnderTestMockCreator->createMockObjectForTheClassUnderTest(
            $mockClassUnderTest
        );
        $constructorArgs = $mockCreationResult->getConstructorArgs();
        $mockObj = $mockCreationResult->getMockObj();

        $methodArgs = $this->argumentsCollector->collect($method);

        $returnValue = $this->reflectionUtil->invokeMethodRegardlessOfProtectionLevel(
            $mockObj,
            $method,
            $methodArgs
        );

        $result = new InstanceMethodExecutionResultValue($returnValue, $constructorArgs, $methodArgs);

        return $result;
    }
}
