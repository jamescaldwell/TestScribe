<?php


namespace Box\TestScribe\_fixture\_input;


/**
 * This class is used to demonstrate how to test methods that have side effects.
 * See the generated test in tests/_fixture/_expected/_input directory.
 *
 * @var Logger
 */
class SideEffectExample 
{
    /** @var Logger */
    private $logger;

    /**
     * logger is a dependency.
     *
     * @param \Box\TestScribe\_fixture\_input\Logger $logger
     */
    function __construct(
        Logger $logger
    )
    {
        $this->logger = $logger;
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
        $this->logger->log("LogAMessage logged : $message");
    }
}
