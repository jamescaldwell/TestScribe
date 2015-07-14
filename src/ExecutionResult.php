<?php
/**
 *
 */

namespace Box\TestScribe;

/**
 * All information captured during execution phase
 * needed for generating the test file.
 */
class ExecutionResult implements \JsonSerializable
{
    /**
     * @var MockClass|null
     * The mocked object of the class under test.
     * null if partial mocking is not needed.
     */
    private $mockClassUnderTest;

    /**
     * @var Arguments
     */
    private $methodArguments;

    /**
     * @var Arguments
     */
    private $constructorArguments;

    /**
     * @var mixed
     * The value of the execution result.
     */
    private $resultValue;

    /**
     * @var \Exception|null
     */
    private $exception;

    /**
     * @param \Box\TestScribe\MockClass|null $mockClassUnderTest
     * @param \Box\TestScribe\Arguments      $methodArguments
     * @param \Box\TestScribe\Arguments      $constructorArguments
     * @param mixed                                    $resultValue
     * @param \Exception|null                          $exception
     */
    function __construct(
        Arguments $constructorArguments,
        Arguments $methodArguments,
        $mockClassUnderTest,
        $resultValue,
        $exception
    )
    {
        // @TODO (ryang 3/2/15) : consider creating a dummy MockClass to replace null.
        $this->mockClassUnderTest = $mockClassUnderTest;
        $this->constructorArguments = $constructorArguments;
        $this->methodArguments = $methodArguments;
        $this->resultValue = $resultValue;
        $this->exception = $exception;
    }

    /**
     * @return mixed
     */
    public function getResultValue()
    {
        return $this->resultValue;
    }

    /**
     * @return MockClass|null
     */
    public function getMockClassUnderTest()
    {
        return $this->mockClassUnderTest;
    }

    /**
     * @return \Exception|null
     */
    public function getException()
    {
        return $this->exception;
    }

    /**
     * @return \Box\TestScribe\Arguments
     */
    public function getMethodArguments()
    {
        return $this->methodArguments;
    }

    /**
     * @return \Box\TestScribe\Arguments
     */
    public function getConstructorArguments()
    {
        return $this->constructorArguments;
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    function jsonSerialize()
    {
        // @TODO (ryang 6/5/15) : improve the validation strategy.
        $constructorArgStr = json_encode($this->constructorArguments);
        $argStr = json_encode($this->methodArguments);

        // json_encode doesn't recursively call json_encode on member fields automatically
        // Use json_encode instead of __toString because if this member is
        // a mocked instance of the MockClass itself __toString will simply
        // return null.
        $mockClassStr = json_encode($this->mockClassUnderTest);
        if ($this->exception === null) {
            $exceptionStr = 'null';
        } else {
            $msg = $this->exception->getMessage();
            $type = get_class($this->exception);
            $exceptionStr = "Exception ($type) Msg ( $msg )";
        }

        $result = [
            "constructorArguments" => $constructorArgStr,
            "methodArguments" => $argStr,
            "mockClassUnderTest" => $mockClassStr,
            "resultValue" => $this->resultValue,
            "exception" => $exceptionStr
        ];

        return $result;
    }
}
