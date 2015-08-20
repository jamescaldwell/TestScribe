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

    /**
     * @param string $testName
     * @param mixed  $result
     */
    function __construct($testName, $result)
    {
        $this->testName = $testName;
        $this->result = $result;
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
}
