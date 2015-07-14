<?php
namespace Box\TestScribe\_fixture\_input;

/**
 */
class CalculatorFactory
{
    /**
     * @param int $initialState
     *
     * @return \Box\TestScribe\_fixture\_input\CalculatorWithState
     */
    public function getCalculator($initialState)
    {
        $calc = new CalculatorWithState($initialState);

        return $calc;
    }
}
