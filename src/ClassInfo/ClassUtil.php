<?php


namespace Box\TestScribe\ClassInfo;


/**
 */
class ClassUtil
{
    /**
     * @param string $fullClassName
     *
     * @return array
     */
    public function getMethodNames($fullClassName)
    {
        $reflectionClass = new \ReflectionClass($fullClassName);
        $methods = $reflectionClass->getMethods();
        $methodNames = [];
        foreach ($methods as $m) {
            $n = $m->getName();
            $methodNames[] = $n;
        }

        return $methodNames;
    }
}
