<?php
/**
 *
 */

namespace Box\TestScribe\Utils;

use Box\TestScribe\FunctionWrappers\StackTraceFunctionWrapper;
use Box\TestScribe\TestScribeException;

/**
 * Return information about where the current call
 * takes place.
 */
class CallInformationCollector
{
    /**
     * @var StackTraceFunctionWrapper
     */
    private $stackTraceFunctionWrapper;

    /**
     * @param \Box\TestScribe\FunctionWrappers\StackTraceFunctionWrapper $stackTraceFunctionWrapper
     */
    function __construct(
        StackTraceFunctionWrapper $stackTraceFunctionWrapper
    )
    {
        $this->stackTraceFunctionWrapper = $stackTraceFunctionWrapper;
    }

    /**
     * @param int $distanceFromThisCall
     *   e.g.
     *   bar calls foo, foo calls this method
     *   To get information about foo, specify 1.
     *   To get information about bar, specify 2. 
     *
     * @return \Box\TestScribe\Utils\CallInfo
     * @throws \Box\TestScribe\TestScribeException
     */
    public function getCallerInfoAt($distanceFromThisCall)
    {
        // This call frame and 
        // $this->stackTraceFunctionWrapper->debugBacktrace()
        // add two frames on top.
        // Note that the frameIndex is 0 based. 
        // And the file and line information refer to the caller
        // of the method in the frame.
        // Thus they offset each other.
        $frameIndex = $distanceFromThisCall;
        $stackFrames = $this->stackTraceFunctionWrapper->debugBacktrace();
        $totalFrames = count($stackFrames);
        if ($totalFrames <= $frameIndex) {
            $exceptionMsg = "Requested frame ( $frameIndex ) is out of range." .
                " Total frames ( $totalFrames )";
            throw new TestScribeException($exceptionMsg);
        }

        $targetFrame = $stackFrames[$frameIndex];
        
        $fileName = ArrayUtil::lookupValueByKey('file', $targetFrame, 'unknown');
        $lineNumberString = ArrayUtil::lookupValueByKey('line', $targetFrame, 'unknown');
        
        $callerInfo = new CallInfo(
            $fileName,
            $lineNumberString
        );
        return $callerInfo;
    }
}
