<?php
/**
 *
 */

namespace Box\TestScribe\Execution;

use Box\TestScribe\App;
use Box\TestScribe\ResultDisplay;


/**
 * Class Runner
 * @package Box\TestScribe
 *
 * Run the method under test.
 *
 * @var Executor | ResultDisplay
 */
class Runner
{
    /** @var Executor */
    private $executor;

    /** @var ResultDisplay */
    private $resultDisplay;

    /**
     * @param \Box\TestScribe\Execution\Executor             $executor
     * @param \Box\TestScribe\ResultDisplay        $resultDisplay
     */
    function __construct(
        Executor $executor,
        ResultDisplay $resultDisplay
    )
    {
        $this->executor = $executor;
        $this->resultDisplay = $resultDisplay;
    }

    /**
     * Execute the method under test and return the execution result.
     *
     * @return \Box\TestScribe\Execution\ExecutionResult
     */
    public function run()
    {
        // Only inject our own mocks during the execution of the method under test.
        // This is done to avoid interrupting the bootstrap script.
        App::$shouldInjectMockObjects = true;

        $result = $this->executor->runMethod();

        $this->resultDisplay->showExecutionResult($result);

        App::$shouldInjectMockObjects = false;

        return $result;
    }
}
