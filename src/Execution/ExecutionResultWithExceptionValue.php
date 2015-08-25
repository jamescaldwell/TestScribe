<?php


namespace Box\TestScribe\Execution;


/**
 */
class ExecutionResultWithExceptionValue
{
    /** @var  mixed */
    private $result;

    /** @var  \Exception|null */
    private $exception;

    /**
     * ExecutionResultWithExceptionValue constructor.
     *
     * @param mixed $result
     * @param \Exception|null $exception
     */
    public function __construct($result, $exception)
    {
        $this->result = $result;
        $this->exception = $exception;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return \Exception|null
     */
    public function getException()
    {
        return $this->exception;
    }
}
