<?php
namespace Box\TestScribe\Renderers;

use Box\TestScribe\Execution\ExecutionResult;
use Box\TestScribe\Utils\VarExporter;

/**
 * Generate expected exception statement if an exception is thrown.
 *
 * @var VarExporter
 */
class ExceptionRenderer
{
    /** @var VarExporter */
    private $varExporter;

    /**
     * @param VarExporter $varExporter
     */
    function __construct(
        VarExporter $varExporter
    )
    {
        $this->varExporter = $varExporter;
    }

    /**
     * Generate expected exception statement if an exception is thrown.
     * Otherwise return ''.
     *
     * @param \Box\TestScribe\Execution\ExecutionResult $executionResult
     *
     * @return string
     */
    public function genExceptionExpectation(
        ExecutionResult $executionResult
    )
    {
        $exception = $executionResult->getException();
        if ($exception !== null) {
            $exceptionType = get_class($exception);

            $exceptionTypeAsStringInCode = $this->varExporter->exportVariable($exceptionType);

            $exceptionMsg = $exception->getMessage();
            $exceptionMsgInCode = $this->varExporter->exportVariable($exceptionMsg);

            $exceptionStatement = "\$this->setExpectedException($exceptionTypeAsStringInCode, $exceptionMsgInCode);";
        } else {
            $exceptionStatement = '';
        }

        return $exceptionStatement;
    }
}
