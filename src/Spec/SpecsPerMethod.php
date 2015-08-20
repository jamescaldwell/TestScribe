<?php


namespace Box\TestScribe\Spec;


/**
 * All the specs associated with a method.
 */
class SpecsPerMethod
{
    /** @var  string */
    private $methodName;

    /** @var array testName => OneSpec */
    private $specs;

    /**
     * @param string $methodName
     * @param array  $specs
     */
    function __construct(
        $methodName,
        array $specs
    )
    {
        $this->methodName = $methodName;
        $this->specs = $specs;
    }

    /**
     * @return string
     */
    public function getMethodName()
    {
        return $this->methodName;
    }

    /**
     * @return array
     */
    public function getSpecs()
    {
        return $this->specs;
    }
}
