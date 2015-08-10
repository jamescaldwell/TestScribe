<?php


namespace Box\TestScribe\_fixture\_input;


/**
 * Logging interface
 */
interface ILog
{
    /**
     * @param string $msg
     *
     * @return void
     */
    public function log($msg);
}
