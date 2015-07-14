<?php
namespace Box\TestScribe\_fixture\_input;

/**
 * For testing throwing an exception from a static method.
 */
class ExceptionStatic
{
    /**
     * @return void
     */
    static public function throwException()
    {
        throw new \InvalidArgumentException("should not get here");
    }
}
