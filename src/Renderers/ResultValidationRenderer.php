<?php
namespace Box\TestScribe\Renderers;

use Box\TestScribe\ExecutionResult;

/**
 * @var ValueAssertionRenderer
 */
class ResultValidationRenderer
{
    /** @var ValueAssertionRenderer */
    private $valueAssertionRenderer;

    /**
     * @param \Box\TestScribe\Renderers\ValueAssertionRenderer $valueAssertionRenderer
     */
    function __construct(
        ValueAssertionRenderer $valueAssertionRenderer
    )
    {
        $this->valueAssertionRenderer = $valueAssertionRenderer;
    }

    /**
     * Generate the test method as a string.
     *
     * @param bool                                      $shouldVerifyResult
     *
     * @param \Box\TestScribe\ExecutionResult $executionResult
     *
     * @return string
     */
    public function genResultValidation(
        $shouldVerifyResult,
        ExecutionResult $executionResult
    )
    {
        if ($shouldVerifyResult) {
            $resultValue = $executionResult->getResultValue();
            $resultValidationStatements =
                $this->valueAssertionRenderer->generate(
                    'executionResult',
                    $resultValue
                );
            $result =
                "// Validate the execution result.\n\n$resultValidationStatements";
        } else {
            $result = '';
        }

        return $result;
    }
}
