<?php
/**
 *
 */

namespace Box\TestScribe\_fixture;

/**
 */
class InputValueFactoryForTest
{
    /**
     * Create an instance of an input value which holds a real value.
     *
     * @param string $stringExpression the input string as typed in the console.
     *   e.g. '1' is integeter value 1
     *   '"1"' is string '1'
     *
     * @return \Box\TestScribe\InputValue
     */
    static public function createValue($stringExpression)
    {
        $objectFactoryObj = new ObjectFactory();
        $converterObj = $objectFactoryObj->getStringToInputValueConverter();
        $inputValue = $converterObj->getValue($stringExpression);

        return $inputValue;
    }
}
