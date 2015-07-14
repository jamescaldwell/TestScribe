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
     * @var \ReflectionClass
     */
    private $reflectionClass;

    /**
     * @param \Box\TestScribe\PhpClassName $phpClassName
     */
    public function __construct(PhpClassName $phpClassName)
    {
        $this->phpClassName = $phpClassName;
        $this->reflectionClass = new \ReflectionClass(
            $phpClassName->getFullyQualifiedClassName()
        );
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
        return $this->reflectionClass;
    }

    /**
     * Return true if the constructor takes no parameters.
     *
     * @return bool
     */
    public function isConstructorParameterless()
    {
        $constructor = $this->reflectionClass->getConstructor();
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
