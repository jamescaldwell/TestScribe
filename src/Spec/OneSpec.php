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

    /** @var  array parameters to the method under test*/
    private $methodParameters;

    /**
     * @param string $testName
     * @param mixed $result
     * @param array $methodParameters
     */
    function __construct(
        $testName,
        $result,
        $methodParameters
    )
    {
        $this->testName = $testName;
        $this->result = $result;
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

}
