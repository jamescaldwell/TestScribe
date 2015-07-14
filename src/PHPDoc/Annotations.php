<?php

namespace Box\TestScribe\PHPDoc;

/**
 * Represents a PHPDoc annotation
 */
class Annotations
{
    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $value
     */
    private $value;

    /**
     * @var string $param
     */
    private $param = null;

    /**
    * @param string $name   name of the annotation
    * @param string $value  value of the annotation
    */
    public function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    public function setParamName($param)
    {
        $this->param = $param;
    }

    public function getParamName()
    {
        return $this->param;
    }
}
