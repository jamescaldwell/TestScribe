<?php
/**
 *
 */

namespace Box\TestScribe\Renderers;

use Box\TestScribe\ExecutionResult;
use Box\TestScribe\GlobalComputedConfig;
use Box\TestScribe\Utils\ArrayUtil;

/**
 * Render method call and result verification statements.
 *
 * @var GlobalComputedConfig|ExecutionRenderer|ArgumentsRenderer|ResultValidationRenderer
 */
class ExecutionAndVerificationRenderer
{
    /** @var GlobalComputedConfig */
    private $globalComputedConfig;

    /** @var ExecutionRenderer */
    private $executionRenderer;

    /** @var ArgumentsRenderer */
    private $argumentsRenderer;

    /** @var ResultValidationRenderer */
    private $resultValidationRenderer;

    /**
     * @param \Box\TestScribe\GlobalComputedConfig               $globalComputedConfig
     * @param \Box\TestScribe\Renderers\ExecutionRenderer        $executionRenderer
     * @param \Box\TestScribe\Renderers\ArgumentsRenderer        $argumentsRenderer
     * @param \Box\TestScribe\Renderers\ResultValidationRenderer $resultValidationRenderer
     */
    function __construct(
        GlobalComputedConfig $globalComputedConfig,
        ExecutionRenderer $executionRenderer,
        ArgumentsRenderer $argumentsRenderer,
        ResultValidationRenderer $resultValidationRenderer
    )
    {
        $this->globalComputedConfig = $globalComputedConfig;
        $this->executionRenderer = $executionRenderer;
        $this->argumentsRenderer = $argumentsRenderer;
        $this->resultValidationRenderer = $resultValidationRenderer;
    }

    /**
     * Return statements for invoking the test and verifying the result.
     *
     * @param \Box\TestScribe\ExecutionResult $executionResult
     *
     * @param string                                    $targetObjectName
     *
     * @return string
     */
    public function genExecutionAndVerification(
        ExecutionResult $executionResult,
        $targetObjectName
    )
    {
        $exception = $executionResult->getException();
        $isReturnTypeVoid = $this->globalComputedConfig->isReturnTypeVoid();
        $shouldVerifyResult = ($exception === null) && (!$isReturnTypeVoid);

        $methodArguments = $executionResult->getMethodArguments();
        $argumentsString = $this->argumentsRenderer->renderArgumentsAsStringInCode(
            $methodArguments
        );
        $executionStatements = $this->executionRenderer->genExecutionStatements(
            $shouldVerifyResult,
            $argumentsString,
            $targetObjectName
        );

        $resultValidationStatements = $this->resultValidationRenderer->genResultValidation(
            $shouldVerifyResult,
            $executionResult
        );

        $result = ArrayUtil::joinNonEmptyStringsWithNewLine(
            [$executionStatements, $resultValidationStatements],
            2
        );

        return $result;
    }
}
