<?php


namespace Box\TestScribe\Execution;

use Box\TestScribe\ArgumentInfo\Arguments;


/**
 */
class ClassUnderTestMockCreationResultValue 
{
    /** @var  \Box\TestScribe\ArgumentInfo\Arguments */
    private $constructorArgs;

    /** @var  object */
    private $mockObj;

    /**
     * @param \Box\TestScribe\ArgumentInfo\Arguments $constructorArgs
     * @param object    $mockObj
     */
    function __construct(
        Arguments $constructorArgs,
        $mockObj)
    {
        $this->constructorArgs = $constructorArgs;
        $this->mockObj = $mockObj;
    }

    /**
     * @return \Box\TestScribe\ArgumentInfo\Arguments
     */
    public function getConstructorArgs()
    {
        return $this->constructorArgs;
    }

    /**
     * @return object
     */
    public function getMockObj()
    {
        return $this->mockObj;
    }

}
