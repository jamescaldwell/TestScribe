<?php


namespace Box\TestScribe\_fixture\_input;


/**
 * This class is used to demonstrate how to test methods that have side effects.
 * See the generated test in tests/_fixture/_expected/_input directory.
 *
 * @var ILog
 */
class SideEffectExample 
{
    /** @var ILog */
    private $iLog;

    /**
     * @param \Box\TestScribe\_fixture\_input\ILog $iLog
     */
    function __construct(
        ILog $iLog
    )
    {
        $this->iLog = $iLog;
    }

    /**
     * Log the given message prefixed with a fixed string.
     *
     * @param string $message
     *
     * @return void
     */
    public function LogAMessage($message)
    {
        $this->iLog->log("LogAMessage logged : $message");
    }
}
