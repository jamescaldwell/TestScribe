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
     * @param \Box\TestScribe\_fixture\_input\Logger $logger
     */
    function __construct(
        Logger $logger
    )
    {
        $this->logger = $logger;
    }

    /**
     * @return void
     */
    public function LogAMessage()
    {
        $this->logger->log('A message is logged.');
    }
}
