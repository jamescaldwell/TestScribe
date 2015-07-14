<?php
namespace Box\TestScribe\_fixture\_input;

/**
 * Class Calculator
 *
 * Class for testing purposes.
 */
class Calculator
{
    private $init;

    /**
     * @param int $init
     */
    public function __construct($init)
    {
        $this->init = $init;
    }
    
    /**
     * @param int $a
     * @param int $b
     * @return int
     */
    public function add($a, $b)
    {
        return $a + $b + $this->init;
    }

    /**
     * Return the total of an array of integers.
     *
     * @param array $input
     * @return int
     */
    public function addArray(array $input)
    {
        $total = 0;
        foreach ($input as $value) {
            $total += $value;
        }

        return $total;
    }

    /**
     * @return int
     */
    protected function protectedAddOne()
    {
        $total = $this->init + 1;
        
        return $total;
    }

    /**
     * @return int
     */
    public function publicAddOne()
    {
        $total = $this->init + 1;
        
        return $total;
    }
    
    /**
     * @return int
     */
    public function publicAddOneUsingProtectedMethod()
    {
        $total = $this->protectedAddOne();
        
        return $total;
    }
    
    /**
     * @param int $initialValue
     *
     * @return int
     */
    private function privateAddOne($initialValue)
    {
        $total = $this->init + $initialValue;
        
        return $total;
    }
    
    /**
     * @param int $initialValue
     *
     * @return int
     */
    static private function staticPrivateAddOne($initialValue)
    {
        $total = $initialValue + 1;
        
        return $total;
    }
}
