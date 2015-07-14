<?php


namespace Box\TestScribe\Utils;

use Box\TestScribe\GeneratorException;

/**
 */
class ExceptionUtil
{
    /**
     * @param \Exception $ex
     *
     * @return void
     * @throws \Box\TestScribe\GeneratorException
     */
    static public function rethrowSameException(\Exception $ex)
    {
        $msg = $ex->getMessage();
        $code = $ex->getCode();
        // Chain the original exception to provide details on the original exception.
        $newException = new GeneratorException(
            $msg,
            $code,
            $ex
        );

        throw $newException;
    }
}
