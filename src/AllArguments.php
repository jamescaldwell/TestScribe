<?php
/**
 *
 */

namespace Box\TestScribe;

use Box\TestScribe\ArgumentInfo\Arguments;

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
     * @param \Box\TestScribe\ArgumentInfo\Arguments $argumentsToTheConstructor
     * @param \Box\TestScribe\ArgumentInfo\Arguments $argumentsToTheMethod
     */
    function __construct(Arguments $argumentsToTheConstructor, Arguments $argumentsToTheMethod)
    {
        $this->argumentsToTheConstructor = $argumentsToTheConstructor;
        $this->argumentsToTheMethod = $argumentsToTheMethod;
    }

    /**
     * @return \Box\TestScribe\ArgumentInfo\Arguments
     */
    public function getArgumentsToTheConstructor()
    {
        return $this->argumentsToTheConstructor;
    }

    /**
     * @return \Box\TestScribe\ArgumentInfo\Arguments
     */
    public function getArgumentsToTheMethod()
    {
        return $this->argumentsToTheMethod;
    }
}
