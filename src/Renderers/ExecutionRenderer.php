<?php
/**
 *
 */

namespace Box\TestScribe\Renderers;

use Box\TestScribe\Config\GlobalComputedConfig;

/**
 * Render method call statements.
 * @var NonPublicMethodExecutionRenderer|GlobalComputedConfig
 */
class ExecutionRenderer
{
    /** @var NonPublicMethodExecutionRenderer */
    private $nonPublicMethodExecutionRenderer;

    /** @var GlobalComputedConfig */
    private $globalComputedConfig;

    /**
     * @param \Box\TestScribe\Renderers\NonPublicMethodExecutionRenderer $nonPublicMethodExecutionRenderer
     * @param \Box\TestScribe\Config\GlobalComputedConfig                       $globalComputedConfig
     */
    function __construct(
        NonPublicMethodExecutionRenderer $nonPublicMethodExecutionRenderer,
        GlobalComputedConfig $globalComputedConfig
    )
    {
        $this->nonPublicMethodExecutionRenderer = $nonPublicMethodExecutionRenderer;
        $this->globalComputedConfig = $globalComputedConfig;
    }

    /**
     * Return statements for invoking the test.
     *
     * @param bool   $shouldVerifyResult
     * @param string $argumentsString
     * @param string $targetObjectName
     *
     * @return string
     */
    public function genExecutionStatements(
        $shouldVerifyResult,
        $argumentsString,
        $targetObjectName
    )
    {
        if ($shouldVerifyResult) {
            // The space character has to be included here
            // instead of the place where string concatenation happens
            // because when the string is empty, we don't want to
            // include an extra space character.
            $assignmentStr = '$executionResult = ';
        } else {
            // If the return value type of the method under test is void
            // don't assign the return value to a local variable.
            // Otherwise intellij will warn you about using such a value.
            $assignmentStr = '';
        }

        $isPublic = $this->globalComputedConfig->isMethodPublic();
        $isStatic = $this->globalComputedConfig->isMethodStatic();
        $fullClassName = $this->globalComputedConfig->getFullClassName();
        $methodName = $this->globalComputedConfig->getMethodName();

        if ($isPublic) {
            if ($isStatic) {
                $invocationStatement =
                    "$assignmentStr$fullClassName::$methodName($argumentsString);";
            } else {
                $invocationStatement =
                    "$assignmentStr\$$targetObjectName->$methodName($argumentsString);";
            }
        } else {
            $invocationStatement =
                $this->nonPublicMethodExecutionRenderer->genNonPublicExecutionStatements(
                    $assignmentStr,
                    $isStatic,
                    $fullClassName,
                    $methodName,
                    $argumentsString,
                    $targetObjectName
                );
        }

        return $invocationStatement;
    }
}
