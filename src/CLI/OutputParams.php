<?php

namespace Box\TestScribe\CLI;

use Box\TestScribe\PhpClassName;

/**
 * Immutable object representing the output params
 * Class OutputParams
 * @package Box\TestScribe\CLI
 */
class OutputParams {
    /**
     * @var PhpClassName $phpClassName
     */
    private $phpClassName;

    /**
     * @var string sourceFile
     */
    private $sourceFile;

    /**
     * @param string $sourceFile
     * @param PhpClassName $phpClassName
     */
    protected function __construct(
        $sourceFile,
        $phpClassName
    )
    {
        $this->sourceFile = $sourceFile;
        $this->phpClassName = $phpClassName;
    }

    /**
     * @return string
     */
    public function getSourceFile()
    {
        return $this->sourceFile;
    }

    /**
     * @return PhpClassName
     */
    public function getPhpClassName()
    {
        return $this->phpClassName;
    }
} 
