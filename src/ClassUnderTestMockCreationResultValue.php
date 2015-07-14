<?php


namespace Box\TestScribe;


/**
 */
class ClassUnderTestMockCreationResultValue 
{
    /** @var  Arguments */
    private $constructorArgs;

    /** @var  object */
    private $mockObj;

    /**
     * @param \Box\TestScribe\Arguments $constructorArgs
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
     * @return \Box\TestScribe\Arguments
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
