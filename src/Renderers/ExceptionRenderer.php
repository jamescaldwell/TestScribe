<?php
namespace Box\TestScribe\Renderers;

use Box\TestScribe\ExecutionResult;

/**
 * Generate expected exception statement if an exception is thrown.
 *
 * @var InjectedMocksRenderer|ValueAssertionRenderer|InvocationRenderer
 */
class ExceptionRenderer
{
    /**
     * Generate expected exception statement if an exception is thrown.
     * Otherwise return ''.
     *
     * @param \Box\TestScribe\ExecutionResult $executionResult
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

            // Since the class name should not contain "\n" character
            // the regular var_export should be sufficient.
            $exceptionTypeAsStringInCode = var_export($exceptionType, true);
            // @TODO (ryang 6/3/15) : set more strict exception expectations e.g.
            // exception message
            $exceptionStatement = "\$this->setExpectedException($exceptionTypeAsStringInCode);";
        } else {
            $exceptionStatement = '';
        }

        return $exceptionStatement;
    }
}
