<?php


namespace Box\TestScribe\Spec;

use Box\TestScribe\Config\GlobalComputedConfig;
use Box\TestScribe\Execution\ExecutionResult;
use Box\TestScribe\Mock\MockMgr;

/**
 * Create one spec object for a test run.
 * @var GlobalComputedConfig| AllMockSpecs
 */
class SpecDetailRenderer
{
    /** @var GlobalComputedConfig */
    private $globalComputedConfig;

    /** @var AllMockSpecs */
    private $allMockSpecs;

    /**
     * @param \Box\TestScribe\Config\GlobalComputedConfig $globalComputedConfig
     * @param \Box\TestScribe\Spec\AllMockSpecs           $allMockSpecs
     */
    function __construct(
        GlobalComputedConfig $globalComputedConfig,
        AllMockSpecs $allMockSpecs
    )
    {
        $this->globalComputedConfig = $globalComputedConfig;
        $this->allMockSpecs = $allMockSpecs;
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
        $mockSpecs = $this->allMockSpecs->getAllMockSpecs();

        $oneSpec = new OneSpec(
            $testName,
            $result,
            $constructorParameters,
            $methodParameters,
            $mockSpecs
        );

        return $oneSpec;
    }
}
