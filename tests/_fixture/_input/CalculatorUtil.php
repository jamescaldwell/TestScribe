<?php
namespace Box\TestScribe\_fixture\_input;

/**
 * Class CalculatorUtil
 *
 * Exercise calculator functionalites for testing.
 */
class CalculatorUtil
{
    /**
     * Takes the given calculator,
     * clone it, add one to it and
     * return the new state.
     *
     * @param CalculatorWithState $calcObj
     *
     * @return int
     */
    public function cloneAndPlusOne($calcObj)
    {
        $newCalcObj = $calcObj->cloneMe();
        $newCalcObj->add(1);
        $rc = $newCalcObj->getState();

        return $rc;
    }

    /**
     * @param \Box\TestScribe\_fixture\_input\Calculator $calculator
     *
     * @return int
     */
    public function calc(Calculator $calculator)
    {
        $rc = $calculator->add(1,2);

        return $rc;
    }
    
    /**
     * For testing calling the same mocked method twice. 
     * 
     * @param \Box\TestScribe\_fixture\_input\Calculator $calculator
     *
     * @return int
     */
    public function AddTwice(Calculator $calculator)
    {
        $rc1 = $calculator->add(1, 2);

        $rc = $rc1 + $calculator->add(0, 1);

        return $rc;
    }
    
    /**
     * @param \Box\TestScribe\_fixture\_input\Calculator $calc
     * @return int
     */
    public function calcArray(Calculator $calc)
    {
        $rc = $calc->addArray([1,2,3]);
        
        return $rc;
    }
}
