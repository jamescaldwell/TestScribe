<?php

namespace Box\TestScribe\Execution;

use Box\TestScribe\ArgumentInfo\Arguments;

/**
 */
class StaticExecutionResultValue
{
    /** @var  mixed */
    private $value;

    /** @var  Arguments */
    private $arguments;

    /**
     * @param mixed     $value
     * @param Arguments $arguments
     */
    function __construct($value, $arguments)
    {
        $this->value = $value;
        $this->arguments = $arguments;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return \Box\TestScribe\ArgumentInfo\Arguments
     */
    public function getArguments()
    {
        return $this->arguments;
    }
}
