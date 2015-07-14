<?php

namespace Box\TestScribe\CLI;
use Box\TestScribe\Method;
use Box\TestScribe\PhpClass;
use Box\TestScribe\PhpClassName;

/**
 * InputParams builder
 * Class InputParamsBuilder
 * @package Box\TestScribe\CLI
 */
class InputParamsBuilder extends InputParams{

    /**
     * @var string $inSourceFile
     */
    private $inSourceFile;

    /**
     * @var PhpClassName $inPhpClassName
     */
    private $inPhpClassName;

    /**
     * @var PhpClass $inClass
     */
    private $inClass;

    /**
     * @var Method $method
     */
    private $inMethod;

    /**
     * @var Method|null $inConstructor
     */
    private $inConstructor;

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
        return new InputParams(
            $this->inSourceFile,
            $this->inPhpClassName,
            $this->inClass,
            $this->inMethod,
            $this->inConstructor
        );
    }

    /**
     * @param string $inSourceFile
     * @return void
     */
    public function setInSourceFile($inSourceFile)
    {
        $this->inSourceFile = $inSourceFile;
    }

    /**
     * @param PhpClassName $inPhpClassName
     * @return void
     */
    public function setInPhpClassName($inPhpClassName)
    {
        $this->inPhpClassName = $inPhpClassName;
    }

    /**
     * @param PhpClass $inClass
     * @return void
     */
    public function setInClass($inClass)
    {
        $this->inClass = $inClass;
    }

    /**
     * @param Method $inMethod
     * @return void
     *
     */
    public function setInMethod($inMethod)
    {
        $this->inMethod = $inMethod;
    }

    /**
     * @param Method|null $inConstructor
     * @return void
     */
    public function setInConstructor($inConstructor)
    {
        $this->inConstructor = $inConstructor;
    }
} 
