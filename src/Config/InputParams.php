<?php

namespace Box\TestScribe\Config;

/**
 * Represents input parameters
 */
class InputParams
{

    /**
     * @var string
     */
    private $sourceFile;

    /**
     * @var string
     */
    private $className;

    /**
     * @var string
     */
    private $methodName;

    /**
     * @param string $sourceFile
     * @param string $className
     * @param string $methodName
     */
    function __construct($sourceFile, $className, $methodName)
    {
        $this->sourceFile = $sourceFile;
        $this->className = $className;
        $this->methodName = $methodName;
    }

    /**
     * @return string
     */
    public function getSourceFile()
    {
        return $this->sourceFile;
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @return string
     */
    public function getMethodName()
    {
        return $this->methodName;
    }
}
