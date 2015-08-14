<?php


namespace Box\TestScribe\Utils;

use Box\TestScribe\TestScribeException;

/**
 */
class ExceptionUtil
{
    /**
     * @param \Exception $ex
     *
     * @return void
     * @throws \Box\TestScribe\TestScribeException
     */
    static public function rethrowSameException(\Exception $ex)
    {
        $msg = $ex->getMessage();
        $code = $ex->getCode();
        // Chain the original exception to provide details on the original exception.
        $newException = new TestScribeException(
            $msg,
            $code,
            $ex
        );

        throw $newException;
    }
}
