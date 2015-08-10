<?php
/**
 *
 */

namespace Box\TestScribe\_fixture\_input;

/**
 * Class Logger
 * @package Box\TestScribe\_fixture\_input
 * 
 * A generic logger class for testing only.
 */
class Logger implements ILog
{
    /**
     * @param string $msg
     *
     * @return void
     */
    public function log($msg)
    {
        print($msg . "\n");
    }
}
