<?php
namespace Box\TestScribe\_fixture\_input;

/**
 *
 */
class CalculatorFactoryUsage
{
    /**
     * Used for testing returning a mock object from a
     * mocked method call.
     *
     * @param \Box\TestScribe\_fixture\_input\CalculatorFactory $calculatorFactory
     * @param int               $initialValue
     * @param int               $additionalValue
     *
     * @return int
     */
    public function calculateWithACalculator($calculatorFactory, $initialValue, $additionalValue)
    {
        $calc = $calculatorFactory->getCalculator($initialValue);
        $rc = $calc->add($additionalValue);

        return $rc;
    }

    /**
     * Used for testing returning a mock object.
     *
     * @param \Box\TestScribe\_fixture\_input\CalculatorFactory $calculatorFactory
     *
     * @return \Box\TestScribe\_fixture\_input\CalculatorWithState
     */
    public function createCalculator($calculatorFactory)
    {
        $calc = $calculatorFactory->getCalculator(1);

        return $calc;
    }
}
