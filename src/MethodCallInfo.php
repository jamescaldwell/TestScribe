<?php
/**
 *
 */

namespace Box\TestScribe;

use Box\TestScribe\Utils\ValueFormatter;

/**
 * Class MethodCallInfo
 * @package Box\TestScribe
 *
 * Information about a method call
 * @var ValueFormatter
 */
class MethodCallInfo
{
    /** @var ValueFormatter */
    private $valueFormatter;

    /**
     * @param \Box\TestScribe\Utils\ValueFormatter $valueFormatter
     */
    function __construct(
        ValueFormatter $valueFormatter
    )
    {
        $this->valueFormatter = $valueFormatter;
    }

    /**
     * @param \Box\TestScribe\Method $method
     * @param array                            $arguments
     *
     * @return string
     * @throws \Box\TestScribe\Exception\TestScribeException
     */
    public function getCallParamInfo(
        Method $method,
        array $arguments
    )
    {
        $count = count($arguments);
        if ($count === 0) {
            $msg = ')';
        } else {
            $argumentsAsAString = $this->getDetail(
                $method,
                $arguments
            );
            $msg = "$argumentsAsAString\n)";
        }

        return $msg;
    }

    /**
     * @param \Box\TestScribe\Method $method
     * @param array                            $arguments
     *
     * @return string
     * @throws \Box\TestScribe\Exception\TestScribeException
     */
    private function getDetail(
        Method $method,
        array $arguments
    )
    {
        // @TODO (ryang 5/28/15) : more checking if the actual parameters
        // match the function prototype.
        $expectedParameters = $method->getParameters();
        $maxExpectedCount = count($expectedParameters);
        $resultMsg = '';

        foreach ($arguments as $index => $arg) {
            // convert the scalar value to its string representation.
            $stringRepresentation = $this->valueFormatter->getReadableFormat($arg);

            if ($index < $maxExpectedCount) {
                $expectedArg = $expectedParameters[$index];
                $argumentName = $expectedArg->getName();
                $paramMsg = "  \$$argumentName = $stringRepresentation";
            } else {
                $paramMsg = "This argument of value ( $stringRepresentation ) is unexpected.";
            }
            $resultMsg .= "\n$paramMsg";
        }

        return $resultMsg;
    }
}
