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

    /** @var  MockSpec[] */
    private $mockSpecs;

    /**
     * OneSpec constructor.
     * @param string $testName
     * @param mixed $result
     * @param array $methodParameters
     * @param array $constructorParameters
     * @param \Box\TestScribe\Spec\MockSpec[] $mockSpecs
     */
    public function __construct(
        $testName,
        $result,
        array $methodParameters,
        array $constructorParameters,
        array $mockSpecs
    )
    {
        $this->testName = $testName;
        $this->result = $result;
        $this->methodParameters = $methodParameters;
        $this->constructorParameters = $constructorParameters;
        $this->mockSpecs = $mockSpecs;
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

    /**
     * @return \Box\TestScribe\Spec\MockSpec[]
     */
    public function getMockSpecs()
    {
        return $this->mockSpecs;
    }
}
