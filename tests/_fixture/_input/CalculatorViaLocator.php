<?php
namespace Box\TestScribe\_fixture\_input;

use Box\TestScribe\_fixture\ServiceLocator;

/**
 *
 */
class CalculatorViaLocator
{
    /**
     * Used for testing service locator usage.
     *
     * @param int $additionalValue
     *
     * @return int
     */
    public function calculateWithACalculator($additionalValue)
    {
        $calc = ServiceLocator::resolve('\Box\TestScribe\_fixture\_input\CalculatorWithState', [1]);
        $rc = $calc->add($additionalValue);

        return $rc;
    }
}
