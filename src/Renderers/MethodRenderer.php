<?php
/**
 *
 */

namespace Box\TestScribe\Renderers;

use Box\TestScribe\Execution\ExecutionResult;
use Box\TestScribe\Config\GlobalComputedConfig;

/**
 * Class MethodRenderer
 * @package Box\TestScribe
 *
 * Generate the test method body.
 *
 * @var \Box\TestScribe\Config\GlobalComputedConfig|MethodBodyRenderer
 */
class MethodRenderer
{
    /** @var GlobalComputedConfig */
    private $globalComputedConfig;

    /** @var MethodBodyRenderer */
    private $methodBodyRenderer;

    /**
     * @param \Box\TestScribe\Config\GlobalComputedConfig         $globalComputedConfig
     * @param \Box\TestScribe\Renderers\MethodBodyRenderer $methodBodyRenderer
     */
    function __construct(
        GlobalComputedConfig $globalComputedConfig,
        MethodBodyRenderer $methodBodyRenderer
    )
    {
        $this->globalComputedConfig = $globalComputedConfig;
        $this->methodBodyRenderer = $methodBodyRenderer;
    }

    /**
     * Generate the test method as a string.
     *
     * @param \Box\TestScribe\Execution\ExecutionResult $executionResult
     *
     * @return string
     */
    public function renderMethod(
        ExecutionResult $executionResult
    )
    {
        $config = $this->globalComputedConfig;
        $methodName = $config->getMethodName();
        $fullyQualifiedClassName = $config->getFullClassName();

        // @TODO (ryang 6/3/15) : move exception expectation statement after all the mocks statements.
        $methodBody = $this->methodBodyRenderer->renderMethodBody(
            $executionResult
        );

        $indentationUtlObj = new IndentationUtil();
        $shiftedMethodBody = $indentationUtlObj->indent(2, $methodBody);

        $testMethodName = $config->getTestMethodName();

        $methodStatements = <<<TAG
    /**
     * @covers $fullyQualifiedClassName::$methodName
     * @covers $fullyQualifiedClassName
     */
    public function $testMethodName()
    {
$shiftedMethodBody
    }
TAG;

        return $methodStatements;
    }
}
