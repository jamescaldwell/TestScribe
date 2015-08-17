<?php
namespace Box\TestScribe\Execution;

use Box\TestScribe\ArgumentsCollector;
use Box\TestScribe\MethodInfo\Method;
use Box\TestScribe\Execution\ClassUnderTestMockCreator;
use Box\TestScribe\Mock\MockClass;
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
     * @param \Box\TestScribe\Execution\ClassUnderTestMockCreator $classUnderTestMockCreator
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
     * @param \Box\TestScribe\Mock\MockClass $mockClassUnderTest
     * @param \Box\TestScribe\MethodInfo\Method    $method
     *
     * @return \Box\TestScribe\Execution\InstanceMethodExecutionResultValue
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
