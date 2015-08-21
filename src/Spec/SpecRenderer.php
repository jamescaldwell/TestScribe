<?php

namespace Box\TestScribe\Spec;

use Box\TestScribe\Config\GlobalComputedConfig;
use Box\TestScribe\Execution\ExecutionResult;

/**
 * Create the intermediate test expectation called specs.
 * They describe at a higher level what the expected results
 * should be.
 *
 * @var SpecPersistence|SpecDetailRenderer|GlobalComputedConfig|SpecsPerClassService
 */
class SpecRenderer
{
    /** @var SpecPersistence */
    private $specPersistence;

    /** @var SpecDetailRenderer */
    private $specDetailRenderer;

    /** @var GlobalComputedConfig */
    private $globalComputedConfig;

    /** @var SpecsPerClassService */
    private $specsPerClassService;

    /**
     * @param \Box\TestScribe\Spec\SpecPersistence $specPersistence
     * @param \Box\TestScribe\Spec\SpecDetailRenderer $specDetailRenderer
     * @param \Box\TestScribe\Config\GlobalComputedConfig $globalComputedConfig
     * @param \Box\TestScribe\Spec\SpecsPerClassService $specsPerClassService
     */
    function __construct(
        SpecPersistence $specPersistence,
        SpecDetailRenderer $specDetailRenderer,
        GlobalComputedConfig $globalComputedConfig,
        SpecsPerClassService $specsPerClassService
    )
    {
        $this->specPersistence = $specPersistence;
        $this->specDetailRenderer = $specDetailRenderer;
        $this->globalComputedConfig = $globalComputedConfig;
        $this->specsPerClassService = $specsPerClassService;
    }

    /**
     * @param \Box\TestScribe\Execution\ExecutionResult $executionResult
     *
     * @return void
     */
    public function genSpec(
        ExecutionResult $executionResult
    )
    {
        $specsPerClass = $this->specPersistence->loadSpec();

        $oneSpec = $this->specDetailRenderer->genSpecDetail($executionResult);
        $methodName = $this->globalComputedConfig->getMethodName();
        $newSpecsPerClass = $this->specsPerClassService->addOneSpec(
            $specsPerClass,
            $methodName,
            $oneSpec
        );

        $this->specPersistence->writeSpec($newSpecsPerClass);
    }

}
