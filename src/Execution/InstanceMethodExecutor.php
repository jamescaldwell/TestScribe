<?php
namespace Box\TestScribe\Execution;

use Box\TestScribe\ArgumentInfo\Arguments;
use Box\TestScribe\ArgumentInfo\ArgumentsCollector;
use Box\TestScribe\Config\GlobalComputedConfig;
use Box\TestScribe\Mock\MockClassLoader;
use Box\TestScribe\Utils\ReflectionUtil;

/**
 * Execute the method under test.
 *
 * @var ReflectionUtil| ArgumentsCollector| ClassUnderTestMockCreator |
 *     GlobalComputedConfig|MockClassLoader|ExpectedExceptionCatcher
 */
class InstanceMethodExecutor
{
    /** @var ReflectionUtil */
    private $reflectionUtil;

    /** @var ArgumentsCollector */
    private $argumentsCollector;

    /** @var ClassUnderTestMockCreator */
    private $classUnderTestMockCreator;

    /** @var GlobalComputedConfig */
    private $globalComputedConfig;

    /** @var MockClassLoader */
    private $mockClassLoader;

    /** @var ExpectedExceptionCatcher */
    private $expectedExceptionCatcher;

    /**
     * @param \Box\TestScribe\Utils\ReflectionUtil $reflectionUtil
     * @param \Box\TestScribe\ArgumentInfo\ArgumentsCollector $argumentsCollector
     * @param \Box\TestScribe\Execution\ClassUnderTestMockCreator $classUnderTestMockCreator
     * @param \Box\TestScribe\Config\GlobalComputedConfig $globalComputedConfig
     * @param \Box\TestScribe\Mock\MockClassLoader $mockClassLoader
     * @param \Box\TestScribe\Execution\ExpectedExceptionCatcher $expectedExceptionCatcher
     */
    function __construct(
        ReflectionUtil $reflectionUtil,
        ArgumentsCollector $argumentsCollector,
        ClassUnderTestMockCreator $classUnderTestMockCreator,
        GlobalComputedConfig $globalComputedConfig,
        MockClassLoader $mockClassLoader,
        ExpectedExceptionCatcher $expectedExceptionCatcher
    )
    {
        $this->reflectionUtil = $reflectionUtil;
        $this->argumentsCollector = $argumentsCollector;
        $this->classUnderTestMockCreator = $classUnderTestMockCreator;
        $this->globalComputedConfig = $globalComputedConfig;
        $this->mockClassLoader = $mockClassLoader;
        $this->expectedExceptionCatcher = $expectedExceptionCatcher;
    }

    /**
     * @return \Box\TestScribe\Execution\ExecutionResult
     *
     * @throws \Box\TestScribe\Exception\AbortException
     * @throws \Exception
     */
    public function runInstanceMethod()
    {
        // Even when the real constructor throws an exception,
        // the mocked object of the class under test is still needed
        // to generate the mock statements to cause the exception
        // to happen.
        $config = $this->globalComputedConfig;
        $className = $config->getFullClassName();
        $methodName = $config->getMethodName();
        $methodObj = $config->getInMethod();

        $mockClassUnderTest = $this->mockClassLoader->createAndLoadMockClass(
            $className,
            $methodName
        );
        $mockCreationResult =
            $this->classUnderTestMockCreator->createMockObjectForTheClassUnderTest(
                $mockClassUnderTest
            );
        $constructorArgs = $mockCreationResult->getConstructorArgs();
        $mockObj = $mockCreationResult->getMockObj();
        $exceptionFromExecution = $mockCreationResult->getException();

        if ($exceptionFromExecution === null) {
            $methodArgs = $this->argumentsCollector->collect($methodObj);

            $result = $this->expectedExceptionCatcher->execute(
                [
                    $this->reflectionUtil,
                    'invokeMethodRegardlessOfProtectionLevel'
                ],
                [
                    $mockObj,
                    $methodObj,
                    $methodArgs
                ]
            );

            $exceptionFromExecution = $result->getException();
            $executionResult = $result->getResult();
        } else {
            $methodArgs = new Arguments([]);
            $executionResult = null;
        }

        $returnValue = new ExecutionResult(
            $constructorArgs,
            $methodArgs,
            $mockClassUnderTest,
            $executionResult,
            $exceptionFromExecution
        );

        return $returnValue;
    }
}
