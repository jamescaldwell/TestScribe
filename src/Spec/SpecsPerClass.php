<?php


namespace Box\TestScribe\Spec;

use Box\TestScribe\Utils\ArrayUtil;


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

    /**
     * Return the specsPerMethod for the given method.
     *
     * If the method key doesn't exist, an empty spec set
     * will be returned.
     *
     * @param $methodName
     *
     * @return \Box\TestScribe\Spec\SpecsPerMethod
     */
    public function getSpecsPerMethodByName($methodName)
    {
        $default = new SpecsPerMethod($methodName, []);

        /** @var SpecsPerMethod $specsPerMethod */
        $specsPerMethod = ArrayUtil::lookupValueByKey(
            $methodName,
            $this->specs,
            $default
        );

        return $specsPerMethod;
    }
}
