<?php

namespace Box\TestScribe\CLI;

use Box\TestScribe\PhpClassName;

/**
 * Builder for OutputParams
 * Class OutputParamsBuilder
 * @package Box\TestScribe\CLI
 */
class OutputParamsBuilder extends OutputParams{
    /**
     * @var string $outSourceFile
     */
    private $outSourceFile;

    /**
     * @var PhpClassName $outPhpClassName
     */
    private $outPhpClassName;

    /**
     * Empty constructor to instantiate new instance
     */
    public function __construct()
    {

    }

    /**
     * @return InputParams
     */
    public function build()
    {
        return new OutputParams(
            $this->outSourceFile,
            $this->outPhpClassName
        );
    }

    /**
     * @param string $outSourceFile
     * @return void
     */
    public function setOutSourceFile($outSourceFile)
    {
        $this->outSourceFile = $outSourceFile;
    }

    /**
     * @param PhpClassName $outPhpClassName
     * @return void
     */
    public function setOutPhpClassName($outPhpClassName)
    {
        $this->outPhpClassName = $outPhpClassName;
    }
} 
