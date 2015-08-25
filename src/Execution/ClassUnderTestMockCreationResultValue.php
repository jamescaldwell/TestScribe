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

    /** @var  \Exception|null */
    private $exception;

    /**
     * @param \Box\TestScribe\ArgumentInfo\Arguments $constructorArgs
     * @param object $mockObj
     * @param \Exception|null $exception
     */
    function __construct(
        Arguments $constructorArgs,
        $mockObj,
        $exception
    )
    {
        $this->constructorArgs = $constructorArgs;
        $this->mockObj = $mockObj;
        $this->exception = $exception;
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

    /**
     * @return \Exception|null
     */
    public function getException()
    {
        return $this->exception;
    }
}
