<?php
/**
 *
 */

namespace Box\TestScribe;

/**
 * Class AllArguments
 * @package Box\TestScribe
 * 
 * Arguments to both the method under test and the 
 * constructor of the class under test
 */
class AllArguments 
{
    /**
     * @var Arguments
     */
    private $argumentsToTheConstructor;

    /**
     * @var Arguments
     */
    private $argumentsToTheMethod;

    /**
     * @param \Box\TestScribe\Arguments $argumentsToTheConstructor
     * @param \Box\TestScribe\Arguments $argumentsToTheMethod
     */
    function __construct(Arguments $argumentsToTheConstructor, Arguments $argumentsToTheMethod)
    {
        $this->argumentsToTheConstructor = $argumentsToTheConstructor;
        $this->argumentsToTheMethod = $argumentsToTheMethod;
    }

    /**
     * @return \Box\TestScribe\Arguments
     */
    public function getArgumentsToTheConstructor()
    {
        return $this->argumentsToTheConstructor;
    }

    /**
     * @return \Box\TestScribe\Arguments
     */
    public function getArgumentsToTheMethod()
    {
        return $this->argumentsToTheMethod;
    }
}
