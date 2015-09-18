<?php
/**
 *
 */

namespace Box\TestScribe;

use Box\TestScribe\Config\GlobalComputedConfig;
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
 * @var Runner|RendererService|InputHistory|SpecRenderer|GlobalComputedConfig
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

    /** @var GlobalComputedConfig */
    private $globalComputedConfig;

    /**
     * @param \Box\TestScribe\Execution\Runner $runner
     * @param \Box\TestScribe\Renderers\RendererService $rendererService
     * @param \Box\TestScribe\InputHistory\InputHistory $inputHistory
     * @param \Box\TestScribe\Spec\SpecRenderer $specRenderer
     * @param \Box\TestScribe\Config\GlobalComputedConfig $globalComputedConfig
     */
    function __construct(
        Runner $runner,
        RendererService $rendererService,
        InputHistory $inputHistory,
        SpecRenderer $specRenderer,
        GlobalComputedConfig $globalComputedConfig
    )
    {
        $this->runner = $runner;
        $this->rendererService = $rendererService;
        $this->inputHistory = $inputHistory;
        $this->specRenderer = $specRenderer;
        $this->globalComputedConfig = $globalComputedConfig;
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

        // @TODO (Ray Yang 9/18/15) : the output directory structure is created
        // in renderService. Remove this dependency.
        if ($this->globalComputedConfig->isGenerateSpec()){
            $this->specRenderer->genSpec($executionResult);
        }

    }
} 
