<?php
/**
 *
 */

namespace Box\TestScribe\Execution;

use Box\TestScribe\Output;
use Box\TestScribe\Utils\ValueFormatter;

/**
 * @var Output | ValueFormatter
 */
class ResultDisplay
{
    /** @var Output */
    private $output;

    /** @var ValueFormatter */
    private $valueFormatter;

    /**
     * @param \Box\TestScribe\Output               $output
     * @param \Box\TestScribe\Utils\ValueFormatter $valueFormatter
     */
    function __construct(
        Output $output,
        ValueFormatter $valueFormatter
    )
    {
        $this->output = $output;
        $this->valueFormatter = $valueFormatter;
    }

    /**
     * @param \Box\TestScribe\Execution\ExecutionResult $result
     *
     * @return void
     */
    public function showExecutionResult(
        ExecutionResult $result
    )
    {
        $exception = $result->getException();
        if ($exception) {
            $exceptionType = get_class($exception);
            $exceptionMsg = $exception->getMessage();
            $resultMsg =
                "An exception ( $exceptionType ) is thrown.\n" .
                "Exception message ( $exceptionMsg ).";
        } else {
            $value = $result->getResultValue();
            // @TODO (ryang 6/4/15) : don't show the value if the return value of the method is void.
            $valueStr = $this->valueFormatter->getReadableFormat($value);
            $resultMsg =
                "Result from this method execution is :\n" .
                "$valueStr\n" .
                "End of the result.";
        }

        $msg =
            "$resultMsg\n\n" .
            "Please verify this result and the interactions with the mocks are what you expect.";

        $this->output->writeln($msg);
    }
}
