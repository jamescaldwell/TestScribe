<?php

namespace Box\TestScribe\Config;

use Box\TestScribe\PhpClassName;

/**
 * Represents input or output parameters
 */
class ConfigParams
{

    /**
     * @var string
     */
    private $sourceFile;

    /**
     * @var PhpClassName
     */
    private $phpClassName;

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
        $this->phpClassName = new PhpClassName($className);
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
        $simpleName = $this->phpClassName->getClassName();

        return $simpleName;
    }

    /**
     * @return string
     */
    public function getFullClassName()
    {
        $fullName = $this->phpClassName->getFullyQualifiedClassName();

        return $fullName;
    }

    /**
     * @return string
     */
    public function getMethodName()
    {
        return $this->methodName;
    }
}
