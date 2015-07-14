<?php
namespace Box\TestScribe\_fixture\_input;

use Box\TestScribe\_fixture\StaticServiceLocator;

/**
 *
 */
class StaticCalculatorViaLocator
{
    /**
     * Used for testing service locator usage using a service locator for static invocations.
     *
     * @param int $value1
     * @param int $value2
     *
     * @return int
     */
    public function calculateWithACalculator($value1, $value2)
    {
        $calc = StaticServiceLocator::resolve('\Box\TestScribe\_fixture\_input\StaticCalculator');
        $rc = $calc::add($value1, $value2);

        return $rc;
    }
}
