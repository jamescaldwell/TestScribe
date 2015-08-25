<?php
namespace Box\TestScribe\_fixture\_input;

/**
 * For testing throwing an exception from a method.
 */
class ExceptionInstance
{
    /**
     * @param int $arg
     *
     * @return int
     */
    public function throwExceptionWhenTheInputIsNotPositive($arg)
    {
        if ($arg <= 0) {
            throw new \InvalidArgumentException("Input should be a positive number");
        } else {
            return $arg;
        }
    }
}
