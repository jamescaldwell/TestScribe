<?php

namespace Box\TestScribe\Config;

use Box\TestScribe\PhpClassName;
use JsonSerializable;

/**
 * Represents input or output parameters
 */
class ConfigParams implements JsonSerializable
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
     * @param string                       $sourceFile
     * @param \Box\TestScribe\PhpClassName $phpClassName
     * @param string                       $methodName
     */
    function __construct(
        $sourceFile,
        PhpClassName $phpClassName,
        $methodName
    )
    {
        $this->sourceFile = $sourceFile;
        $this->phpClassName = $phpClassName;
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

    /**
     * @return \Box\TestScribe\PhpClassName
     */
    public function getPhpClassName()
    {
        return $this->phpClassName;
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    function jsonSerialize()
    {
        $data = [
            'file path' => $this->sourceFile,
            'class name' => $this->phpClassName->getFullyQualifiedClassName(),
            'method name' => $this->methodName
        ];

        return $data;
    }
}
