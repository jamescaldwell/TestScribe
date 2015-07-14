<?php
/**
 *
 */

namespace Box\TestScribe;

/**
 * Class InputValueFactory
 * @package Box\TestScribe
 */
class InputValueFactory
{
    /**
     * Create an instance of a void input value.
     *
     * @return \Box\TestScribe\InputValue
     */
    function createVoid()
    {
        $emptyExpressionWithMocks = new ExpressionWithMocks('', []);
        $voidInputValue = new InputValue(true, null, $emptyExpressionWithMocks);

        return $voidInputValue;
    }

    /**
     * Create an instance of an input value which holds a real value.
     *
     * @param string                                        $value
     * @param \Box\TestScribe\ExpressionWithMocks $expressionWithMocks
     *
     * @return \Box\TestScribe\InputValue
     */
    function createValue($value, ExpressionWithMocks $expressionWithMocks)
    {
        $voidInputValue = new InputValue(false, $value, $expressionWithMocks);

        return $voidInputValue;
    }
}
