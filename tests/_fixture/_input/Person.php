<?php
/**
 *
 */

namespace Box\TestScribe\_fixture\_input;

/**
 * Class Person
 * @package Box\TestScribe\_fixture\_input
 *
 * Demo of simple tests
 */
class Person
{
    /**
     * @var string
     */
    private $name;
    
    /**
     * @var int
     */
    private $age;

    /**
     * @var Calculator
     */
    private $calculator;

    /**
     * @param string                                                     $name
     * @param int                                                        $age
     * @param \Box\TestScribe\_fixture\_input\Calculator $calc
     */
    function __construct(
        $name,
        $age,
        Calculator $calc
    )
    {
        $this->name = $name;
        $this->age = $age;
        $this->calculator = $calc;
    }

    /**
     * @param int $numOfYears
     *
     * @return string
     */
    public function showAge($numOfYears)
    {
        $msg = sprintf(
            "%s will be %d years old in %d years.\n",
            $this->name,
            $this->calculator->add($this->age, $numOfYears),
            $numOfYears
        );
        
        return $msg;
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }
}
