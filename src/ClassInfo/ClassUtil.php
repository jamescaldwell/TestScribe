<?php


namespace Box\TestScribe\ClassInfo;


/**
 */
class ClassUtil
{
    /**
     * Get method names excluding the constructor.
     *
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
            if (!$m->isConstructor()) {
                $n = $m->getName();
                $methodNames[] = $n;
            }
        }

        return $methodNames;
    }
}
