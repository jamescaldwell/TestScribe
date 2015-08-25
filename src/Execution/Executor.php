<?php
namespace Box\TestScribe\Execution;

use Box\TestScribe\Config\GlobalComputedConfig;

/**
 * Execute the method under test.
 *
 * @var  GlobalComputedConfig|StaticMethodExecutor|InstanceMethodExecutor
 */
class Executor
{
    /** @var GlobalComputedConfig */
    private $globalComputedConfig;

    /** @var StaticMethodExecutor */
    private $staticMethodExecutor;

    /** @var InstanceMethodExecutor */
    private $instanceMethodExecutor;

    /**
     * @param \Box\TestScribe\Config\GlobalComputedConfig $globalComputedConfig
     * @param \Box\TestScribe\Execution\StaticMethodExecutor $staticMethodExecutor
     * @param \Box\TestScribe\Execution\InstanceMethodExecutor $instanceMethodExecutor
     */
    function __construct(
        GlobalComputedConfig $globalComputedConfig,
        StaticMethodExecutor $staticMethodExecutor,
        InstanceMethodExecutor $instanceMethodExecutor
    )
    {
        $this->globalComputedConfig = $globalComputedConfig;
        $this->staticMethodExecutor = $staticMethodExecutor;
        $this->instanceMethodExecutor = $instanceMethodExecutor;
    }

    /**
     * @return \Box\TestScribe\Execution\ExecutionResult
     * @throws \Box\TestScribe\Exception\AbortException
     * @throws \Box\TestScribe\Exception\TestScribeException
     */
    public function runMethod()
    {
        $isStatic = $this->globalComputedConfig->isMethodStatic();

        if ($isStatic) {
            $executionResult = $this->staticMethodExecutor->runStaticMethod();
        } else {
            $executionResult = $this->instanceMethodExecutor->runInstanceMethod();
        }

        return $executionResult;
    }
}
