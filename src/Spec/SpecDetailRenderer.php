<?php


namespace Box\TestScribe\Spec;

use Box\TestScribe\Exception\TestScribeException;
use Box\TestScribe\Execution\ExecutionResult;

/**
 * Create one spec object for a test run.
 */
class SpecDetailRenderer
{
    /**
     * Generate an OneSpec instance from the execution result.
     *
     * @param \Box\TestScribe\Execution\ExecutionResult $executionResult
     *
     * @return \Box\TestScribe\Spec\OneSpec
     */
    public function genSpecDetail(ExecutionResult $executionResult)
    {
        throw new TestScribeException('not implemented');
    }
}
