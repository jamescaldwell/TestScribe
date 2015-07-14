<?php

namespace Box\TestScribe;

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
     * @return \Box\TestScribe\Arguments
     */
    public function getArguments()
    {
        return $this->arguments;
    }
}
