<?php


namespace Box\TestScribe\FunctionWrappers;


/**
 * Other function wrappers
 */
class FunctionWrapper 
{
    /**
     * @param string $filePath
     *
     * @return void
     */
    public function includeFile($filePath)
    {
        /** @noinspection PhpIncludeInspection */
        include_once($filePath);
    }
}
