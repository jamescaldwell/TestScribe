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
     *
     * Since a copy of the array is returned and the OneSpec
     * objects are themselves immutable, the client
     * can't use the return value to modify the instance's
     * internal state.
     */
    public function getSpecs()
    {
        return $this->specs;
    }
}
