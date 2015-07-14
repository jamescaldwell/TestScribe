<?php

namespace Box\TestScribe\FunctionWrappers;

/**
 * Wrapper class for stack trace related functions
 */
class StackTraceFunctionWrapper 
{
    /**
     * @return array
     * 
     * @see http://us3.php.net/manual/en/function.debug-backtrace.php
     */
    public function debugBacktrace()
    {
        // When file and line information are included in a frame
        // they refer to the attributes of the caller of the method in
        // that frame.
        $traceArray = debug_backtrace();
        
        return $traceArray;
    }
}
