<?php
/**
 *
 */

namespace Box\TestScribe\_fixture\_input;

/**
 * Demonstrate the technique for testing early
 * before dependencies are ready.
 *
 * Class TestEarlyDemo
 * @package Box\TestScribe\_fixture\_input
 */
class TestEarlyDemo
{
    /**
     * @var ComplexComputation
     */
    private $complexComputation;

    /**
     * @param \Box\TestScribe\_fixture\_input\ComplexComputation $complexComputation
     */
    function __construct(ComplexComputation $complexComputation)
    {
        $this->complexComputation = $complexComputation;
    }

    /**
     * Return the result of a complex computation.
     *
     * If the input is less than 0, return a message that this input is not supported.
     *
     * Otherwise, run the complex computation with the given input.
     * Return a message with the input value and integer result.
     *
     * @param int $input
     *
     * @return string
     */
    public function computeAndGetResultMsg($input)
    {
        if ($input < 0) {
            $msg = "Negative input ( $input ) is provided. Only non negative input is supported.";
        } else {
            $resultObj = $this->complexComputation->calculate($input);
            $intResult = $resultObj->getIntResult();
            $msg = "After computing with the input ( $input ), ( $intResult ) is returned. ";
        }

        return $msg;
    }
}
