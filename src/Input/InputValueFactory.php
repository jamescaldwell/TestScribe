<?php
/**
 *
 */

namespace Box\TestScribe\Input;

/**
 * Class InputValueFactory
 * @package Box\TestScribe
 */
class InputValueFactory
{
    /**
     * Create an instance of a void input value.
     *
     * @return \Box\TestScribe\Input\InputValue
     */
    public function createVoid()
    {
        $emptyExpressionWithMocks = new ExpressionWithMocks('', []);
        $voidInputValue = new InputValue(true, null, $emptyExpressionWithMocks);

        return $voidInputValue;
    }

    /**
     * Create an instance of an input value which holds a real value.
     *
     * @param string $value
     * @param \Box\TestScribe\Input\ExpressionWithMocks $expressionWithMocks
     *
     * @return \Box\TestScribe\Input\InputValue
     */
    public function createValue($value, ExpressionWithMocks $expressionWithMocks)
    {
        $inputValue = new InputValue(false, $value, $expressionWithMocks);

        return $inputValue;
    }

    /**
     * Create an input value from a simple value such as string,
     * int, bool.
     *
     * @param mixed $value
     *
     * @return \Box\TestScribe\Input\InputValue
     */
    public function createPrimitiveValue($value)
    {
        $valueInCode = var_export($value, true);
        $expressionWithMocks = new ExpressionWithMocks(
            $valueInCode, []
        );
        $inputValue = new InputValue(false, $value, $expressionWithMocks);

        return $inputValue;
    }


}
