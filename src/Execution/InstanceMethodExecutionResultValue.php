<?php

namespace Box\TestScribe\Execution;

use Box\TestScribe\Arguments;
use Prophecy\Argument;

/**
 */
class InstanceMethodExecutionResultValue
{
    /** @var  mixed */
    private $value;

    /** @var  Arguments */
    private $constructorArguments;

    /** @var  Arguments */
    private $methodArguments;

    /**
     * @param mixed     $value
     * @param Arguments $constructorArguments
     * @param Arguments $methodArguments
     */
    function __construct($value, $constructorArguments, $methodArguments)
    {
        $this->value = $value;
        $this->methodArguments = $methodArguments;
        $this->constructorArguments = $constructorArguments;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return \Box\TestScribe\Arguments
     */
    public function getMethodArguments()
    {
        return $this->methodArguments;
    }

    /**
     * @return \Box\TestScribe\Arguments
     */
    public function getConstructorArguments()
    {
        return $this->constructorArguments;
    }
}
