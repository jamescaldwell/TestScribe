<?php

namespace Box\TestScribe;

/**
 * Represent a PHP class.
 */
class PhpClass
{
    /**
     * @var PhpClassName
     */
    private $phpClassName;

    /**
     * @param \Box\TestScribe\PhpClassName $phpClassName
     */
    public function __construct(PhpClassName $phpClassName)
    {
        $this->phpClassName = $phpClassName;
    }

    /**
     * @return \Box\TestScribe\PhpClassName
     */
    public function getPhpClassName()
    {
        return $this->phpClassName;
    }

    /**
     * @return \ReflectionClass
     */
    public function getReflectionClass()
    {
        $reflectionClass = new \ReflectionClass(
            $this->phpClassName->getFullyQualifiedClassName()
        );

        return $reflectionClass;
    }

    /**
     * Return true if the constructor takes no parameters.
     *
     * @return bool
     */
    public function isConstructorParameterless()
    {
        $reflectionClass = $this->getReflectionClass();
        $constructor = $reflectionClass->getConstructor();
        if (!$constructor) {
            // No constructor.
            return true;
        }
        $parameters = $constructor->getParameters();
        if (!count($parameters)) {
            return true;
        }

        return false;
    }
}
