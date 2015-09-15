<?php
/**
 *
 */

namespace Box\TestScribe;

use Box\TestScribe\Exception\AbortException;
use Box\TestScribe\Execution\Runner;
use Box\TestScribe\InputHistory\InputHistory;
use Box\TestScribe\Renderers\RendererService;
use Box\TestScribe\Spec\SpecRenderer;

/**
 * Class Engine
 *
 * Delay instantiation of this class until it is actually needed.
 * This is necessary because the engine depends @see GlobalComputedConfig
 * class to be instantiated first.
 * @Injectable(lazy=true)
 *
 * @var Runner|RendererService|InputHistory|SpecRenderer
 */
class Engine
{
    /** @var Runner */
    private $runner;

    /** @var RendererService */
    private $rendererService;

    /** @var InputHistory */
    private $inputHistory;

    /** @var SpecRenderer */
    private $specRenderer;

    /**
     * @param \Box\TestScribe\Execution\Runner $runner
     * @param \Box\TestScribe\Renderers\RendererService $rendererService
     * @param \Box\TestScribe\InputHistory\InputHistory $inputHistory
     * @param \Box\TestScribe\Spec\SpecRenderer $specRenderer
     */
    function __construct(
        Runner $runner,
        RendererService $rendererService,
        InputHistory $inputHistory,
        SpecRenderer $specRenderer
    )
    {
        $this->runner = $runner;
        $this->rendererService = $rendererService;
        $this->inputHistory = $inputHistory;
        $this->specRenderer = $specRenderer;
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
        //$this->specRenderer->genSpec($executionResult);
        $this->rendererService->render($executionResult);
    }
} 
