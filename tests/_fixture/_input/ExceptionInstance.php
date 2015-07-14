<?php
namespace Box\TestScribe\_fixture\_input;

/**
 * For testing throwing an exception from a method.
 */
class ExceptionInstance
{
    /**
     * @return void
     */
    public function throwException()
    {
        throw new \InvalidArgumentException("should not get here");
    }
}
