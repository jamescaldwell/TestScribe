<?php


namespace Box\TestScribe\_fixture\_input;


/**
 * This class is used to demonstrate how to test methods that have side effects.
 * See the generated test in tests/_fixture/_expected/_input directory.
 */
class SideEffectExample 
{
    /**
     * @param \Box\TestScribe\_fixture\_input\Logger $logger
     *
     * @return void
     */
    public function methodThatHasSideEffect(Logger $logger)
    {
        $logger->log('methodThatHasSideEffect is called.');
    }
}
