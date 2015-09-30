<?php


namespace Box\TestScribe\Spec;

use Box\TestScribe\Config\GlobalComputedConfig;
use Box\TestScribe\Execution\ExecutionResult;

/**
 * Create one spec object for a test run.
 * @var GlobalComputedConfig
 */
class SpecDetailRenderer
{
    /** @var GlobalComputedConfig */
    private $globalComputedConfig;

    /**
     * @param \Box\TestScribe\Config\GlobalComputedConfig $globalComputedConfig
     */
    function __construct(
        GlobalComputedConfig $globalComputedConfig
    )
    {
        $this->globalComputedConfig = $globalComputedConfig;
    }

    /**
     * Generate an OneSpec instance from the execution result.
     *
     * @param \Box\TestScribe\Execution\ExecutionResult $executionResult
     *
     * @return \Box\TestScribe\Spec\OneSpec
     */
    public function genSpecDetail(ExecutionResult $executionResult)
    {
        $testName = $this->globalComputedConfig->getTestMethodName();
        $result = $executionResult->getResultValue();
        $methodArguments = $executionResult->getMethodArguments();
        $methodParameters = $methodArguments->getValues();
        $constructorArguments = $executionResult->getConstructorArguments();
        $constructorParameters = $constructorArguments->getValues();
        $oneSpec = new OneSpec(
            $testName,
            $result,
            $constructorParameters,
            $methodParameters
        );

        return $oneSpec;
    }
}
