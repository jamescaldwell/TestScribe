<?php
namespace Box\TestScribe\Execution;

use Box\TestScribe\ArgumentsCollector;
use Box\TestScribe\Config\GlobalComputedConfig;
use Box\TestScribe\Utils\ReflectionUtil;

/**
 * Execute the static method under test.
 *
 * @var  ReflectionUtil| GlobalComputedConfig| ArgumentsCollector
 */
class StaticMethodExecutor
{
    /** @var ReflectionUtil */
    private $reflectionUtil;

    /** @var GlobalComputedConfig */
    private $globalComputedConfig;

    /** @var ArgumentsCollector */
    private $argumentsCollector;

    /**
     * @param \Box\TestScribe\Utils\ReflectionUtil $reflectionUtil
     * @param \Box\TestScribe\Config\GlobalComputedConfig $globalComputedConfig
     * @param \Box\TestScribe\ArgumentsCollector   $argumentsCollector
     */
    function __construct(
        ReflectionUtil $reflectionUtil,
        GlobalComputedConfig $globalComputedConfig,
        ArgumentsCollector $argumentsCollector
    )
    {
        $this->reflectionUtil = $reflectionUtil;
        $this->globalComputedConfig = $globalComputedConfig;
        $this->argumentsCollector = $argumentsCollector;
    }

    /**
     * @return \Box\TestScribe\Execution\StaticExecutionResultValue
     */
    public function runStaticMethod()
    {
        $config = $this->globalComputedConfig;
        $methodObj = $config->getInMethod();
        $arguments = $this->argumentsCollector->collect($methodObj);

        // Note partial mocking of static methods is not supported.
        $returnValue = $this->reflectionUtil->invokeMethodRegardlessOfProtectionLevel(
            null,
            $methodObj,
            $arguments
        );

        $result = new StaticExecutionResultValue($returnValue, $arguments);

        return $result;
    }
}
