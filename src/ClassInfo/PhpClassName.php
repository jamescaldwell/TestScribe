<?php

namespace Box\TestScribe\ClassInfo;

use JsonSerializable;

/**
 * Represent a PHP class name.
 *
 * Supports parsing fully qualified class name.
 */
class PhpClassName implements JsonSerializable
{
    /**
     * @var string
     */
    private $nameSpace;

    /**
     * Simple class name
     *
     * @var string
     */
    private $className;

    /**
     * @var string
     */
    private $fullyQualifiedClassName;

    /**
     * @param string $className
     */
    public function __construct($className)
    {
        $this->parseFullyQualifiedClassName($className);
    }

    /**
     * @param  string $className Simple or fully qualified class name
     *
     * @return void
     */
    private function parseFullyQualifiedClassName($className)
    {
        $this->nameSpace = '';
        $this->className = $className;
        $this->fullyQualifiedClassName = $className;

        if (strpos($className, '\\') !== false) {
            $tmp = explode('\\', $className);
            $this->className = $tmp[count($tmp) - 1];
            $this->nameSpace = $this->constructNamespaceFromNameParts($tmp);
        }
    }

    /**
     * Construct name space string from an array of class name parts.
     *
     * @param  array $parts
     *
     * @return string
     */
    private function constructNamespaceFromNameParts(array $parts)
    {
        $result = '';
        $numberOfParts = count($parts);

        if ($numberOfParts > 2) {
            // When the class name is fully qualified, there will be at least one leading
            // '\' character, the parts array will contain empty string as the first part
            // and the simple class name as the last part.
            // We want the returned name space not to conatin a leading '\'
            // so that it can be used directly in namespace statement.
            $namespaceParts = array_slice($parts, 1, $numberOfParts - 2);

            $result = join('\\', $namespaceParts);
        }

        return $result;
    }

    /**
     * Return a simple class name string.
     *
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @return string
     */
    public function getFullyQualifiedClassName()
    {
        return $this->fullyQualifiedClassName;
    }

    /**
     * Return the namespace the class belongs to.
     *
     * Return empty string for classes in the top level name space.
     * The returned name space does not conatin a leading '\'
     * so that it can be used directly in namespace statement.
     *
     * @return string
     */
    public function getNameSpace()
    {
        return $this->nameSpace;
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
        return $this->fullyQualifiedClassName;
    }
}
