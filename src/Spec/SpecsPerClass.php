<?php


namespace Box\TestScribe\Spec;


/**
 * All specs associated with a class.
 */
class SpecsPerClass 
{
    /** @var  string */
    private $fullClassName;

    /** @var  array methodName => SpecsPerMethod */
    private $specs;

    /**
     * @param string $fullClassName
     * @param array $specs
     */
    function __construct($fullClassName, array $specs)
    {
        $this->fullClassName = $fullClassName;
        $this->specs = $specs;
    }

    /**
     * @return array
     */
    public function getSpecs()
    {
        return $this->specs;
    }

    /**
     * @return string
     */
    public function getFullClassName()
    {
        return $this->fullClassName;
    }
}
