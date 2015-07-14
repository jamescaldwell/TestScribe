<?php

namespace Box\TestScribe\CLI;
use Box\TestScribe\Method;
use Box\TestScribe\PhpClass;
use Box\TestScribe\PhpClassName;

/**
 * Represents input parameters
 * Class InputParams
 * @package Box\TestScribe\CLI
 */
class InputParams {

    /**
     * @var string $inSourceFile
     */
    private $sourceFile;

    /**
     * @var PhpClassName $inPhpClassName
     */
    private $phpClassName;

    /**
     * @var PhpClass $inClass
     */
    private $phpClass;

    /**
     * @var Method $method
     */
    private $method;

    /**
     * @var Method|null $inConstructor
     */
    private $constructor;


    /**
     * @param string $sourceFile
     * @param PhpClassName $phpClassName
     * @param PhpClass $phpClass
     * @param Method $method
     * @param Method|null $constructor
     */
    protected function __construct(
        $sourceFile,
        $phpClassName,
        $phpClass,
        $method,
        $constructor
    )
    {
        $this->sourceFile = $sourceFile;
        $this->phpClassName = $phpClassName;
        $this->phpClass = $phpClass;
        $this->method = $method;
        $this->constructor = $constructor;
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

    /**
     * @return PhpClass
     */
    public function getPhpClass()
    {
        return $this->phpClass;
    }

    /**
     * @return Method
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return Method|null
     */
    public function getConstructor()
    {
        return $this->constructor;
    }
} 
