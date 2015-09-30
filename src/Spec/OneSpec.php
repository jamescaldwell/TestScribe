<?php


namespace Box\TestScribe\Spec;

/**
 * One spec i.e. one test.
 */
class OneSpec
{
    /** @var  string */
    private $testName;

    /** @var  mixed */
    private $result;

    /** @var  array parameters to the method under test */
    private $methodParameters;

    /** @var  array parameters to the constructor */
    private $constructorParameters;

    /**
     * @param string $testName
     * @param mixed $result
     * @param array $constructorParameters
     * @param array $methodParameters
     */
    function __construct(
        $testName,
        $result,
        $constructorParameters,
        $methodParameters
    )
    {
        $this->testName = $testName;
        $this->result = $result;
        $this->constructorParameters = $constructorParameters;
        $this->methodParameters = $methodParameters;
    }

    /**
     * @return string
     */
    public function getTestName()
    {
        return $this->testName;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return array
     */
    public function getMethodParameters()
    {
        return $this->methodParameters;
    }

    /**
     * @return array
     */
    public function getConstructorParameters()
    {
        return $this->constructorParameters;
    }
}
