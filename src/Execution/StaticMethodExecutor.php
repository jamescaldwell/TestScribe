<?php
namespace Box\TestScribe\Execution;

use Box\TestScribe\ArgumentInfo\Arguments;
use Box\TestScribe\ArgumentInfo\ArgumentsCollector;
use Box\TestScribe\Config\GlobalComputedConfig;
use Box\TestScribe\Utils\ReflectionUtil;

/**
 * Execute the static method under test.
 *
 * @var  ReflectionUtil| GlobalComputedConfig| ArgumentsCollector | ExpectedExceptionCatcher
 */
class StaticMethodExecutor
{
    /** @var ReflectionUtil */
    private $reflectionUtil;

    /** @var GlobalComputedConfig */
    private $globalComputedConfig;

    /** @var ArgumentsCollector */
    private $argumentsCollector;

    /** @var ExpectedExceptionCatcher */
    private $expectedExceptionCatcher;

    /**
     * @param \Box\TestScribe\Utils\ReflectionUtil $reflectionUtil
     * @param \Box\TestScribe\Config\GlobalComputedConfig $globalComputedConfig
     * @param \Box\TestScribe\ArgumentInfo\ArgumentsCollector $argumentsCollector
     * @param \Box\TestScribe\Execution\ExpectedExceptionCatcher $expectedExceptionCatcher
     */
    function __construct(
        ReflectionUtil $reflectionUtil,
        GlobalComputedConfig $globalComputedConfig,
        ArgumentsCollector $argumentsCollector,
        ExpectedExceptionCatcher $expectedExceptionCatcher
    )
    {
        $this->reflectionUtil = $reflectionUtil;
        $this->globalComputedConfig = $globalComputedConfig;
        $this->argumentsCollector = $argumentsCollector;
        $this->expectedExceptionCatcher = $expectedExceptionCatcher;
    }

    /**
     * @return \Box\TestScribe\Execution\ExecutionResult
     *
     * @throws \Box\TestScribe\Exception\AbortException
     * @throws \Exception
     */
    public function runStaticMethod()
    {
        $config = $this->globalComputedConfig;
        $methodObj = $config->getInMethod();
        $methodArgs = $this->argumentsCollector->collect($methodObj);

        $result = $this->expectedExceptionCatcher->execute(
            [
                $this->reflectionUtil,
                'invokeMethodRegardlessOfProtectionLevel'
            ],
            [
                null,
                $methodObj,
                $methodArgs
            ]
        );

        $exceptionFromExecution = $result->getException();
        $executionResult = $result->getResult();

        // No constructor arguments needed for static methods invocation.
        $constructorArgs = new Arguments([]);
        // Partial mocking of static methods is not supported.
        $mockClassUnderTest = null;

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
