<?php


namespace Box\TestScribe\Execution;

use Box\TestScribe\Config\GlobalComputedConfig;
use Box\TestScribe\Exception\AbortException;
use Box\TestScribe\Exception\TestScribeException;
use Box\TestScribe\Utils\ExceptionUtil;


/**
 * Catches exceptions thrown in the production code
 * so that proper tests for them can be created
 * in case these are expected exceptions
 *
 * @var GlobalComputedConfig
 */
class ExpectedExceptionCatcher
{
    /** @var GlobalComputedConfig */
    private $globalComputedConfig;

    /**
     * @param \Box\TestScribe\Config\GlobalComputedConfig $globalComputedConfig
     */
    function __construct(
        GlobalComputedConfig $globalComputedConfig
    )
    {
        $this->globalComputedConfig = $globalComputedConfig;
    }

    /**
     * @param callable $func
     * @param array $params
     *
     * @return \Box\TestScribe\Execution\ExecutionResultWithExceptionValue
     * @throws \Box\TestScribe\Exception\AbortException
     * @throws \Box\TestScribe\Exception\TestScribeException
     * @throws \Exception
     */
    public function execute(
        callable $func,
        array $params
    )
    {
        $result = null;
        $exceptionFromExecution = null;

        try {
            $result = call_user_func_array($func, $params);
        } catch (AbortException $abortException) {
            throw $abortException;
        } catch (TestScribeException $testScribeException) {
            if ($this->globalComputedConfig->isTheTestRunAgainstTheToolItself()) {
                $exceptionFromExecution = $testScribeException;
            } else {
                // Chain the original exception to provide details on the original exception.
                ExceptionUtil::rethrowSameException($testScribeException);
            }
        } catch (\Exception $exception) {
            $exceptionFromExecution = $exception;
        }

        $returnValue = new ExecutionResultWithExceptionValue(
            $result,
            $exceptionFromExecution
        );

        return $returnValue;
    }
}
