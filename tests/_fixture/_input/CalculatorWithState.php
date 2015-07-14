<?php
namespace Box\TestScribe\_fixture\_input;

/**
 * Class CalculatorWithState
 */
class CalculatorWithState
{
    /**
     * @var int
     */
    private $state;

    /**
     * @param int $initialValue
     */
    public function __construct($initialValue)
    {
        $this->state = $initialValue;
    }

    /**
     * Create a new copy with the initial state
     * set to the current state.
     *
     * @return \Box\TestScribe\_fixture\_input\CalculatorWithState
     */
    public function cloneMe()
    {
        $newCalc = new CalculatorWithState($this->state);

        return $newCalc;
    }

    /**
     * @param int $num
     * @return int
     */
    public function add($num)
    {
        $this->state += $num;
        return $this->state;
    }

    /**
     * Return the total of an array of integers plus the initial value.
     *
     * @param array $input
     * @return int
     */
    public function addArray($input)
    {
        $total = 0;
        foreach ($input as $value) {
            $total += $value;
        }
        $this->state += $total;

        return $this->state;
    }

    /**
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }
}
