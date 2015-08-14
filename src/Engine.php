<?php
/**
 *
 */

namespace Box\TestScribe;

use Box\TestScribe\Exception\AbortException;
use Box\TestScribe\Execution\Runner;
use Box\TestScribe\InputHistory\InputHistory;
use Box\TestScribe\Renderers\RendererService;

/**
 * Class Engine
 *
 * Delay instantiation of this class until it is actually needed.
 * This is necessary because the engine depends @see GlobalComputedConfig
 * class to be instantiated first.
 * @Injectable(lazy=true)
 *
 * @package Box\TestScribe
 */
class Engine
{
    /**
     * @var Runner
     */
    private $runner;

    /**
     * @var RendererService
     */
    private $rendererService;

    /**
     * @var InputHistory
     */
    private $inputHistory;

    /**
     * @param \Box\TestScribe\Execution\Runner                    $runner
     * @param \Box\TestScribe\Renderers\RendererService $rendererService
     * @param \Box\TestScribe\InputHistory\InputHistory              $inputHistory
     */
    function __construct(
        Runner $runner,
        RendererService $rendererService,
        InputHistory $inputHistory
    )
    {
        $this->runner = $runner;
        $this->rendererService = $rendererService;
        $this->inputHistory = $inputHistory;
    }

    /**
     * Execute the method under test and generate a test for it.
     *
     * @return void
     */
    public function start()
    {
        try {
            $executionResult = $this->runner->run();
        } catch (AbortException $ex) {
            $this->inputHistory->saveHistoryToFile();
            return;
        }

        $this->inputHistory->saveHistoryToFile();
        $this->rendererService->render($executionResult);
    }
} 
