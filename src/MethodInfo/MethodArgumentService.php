<?php
/**
 *
 */

namespace Box\TestScribe\MethodInfo;

/**
 * Class MethodArgumentService
 *
 * @package Box\TestScribe
 */
class MethodArgumentService
{
    /**
     * Return fully qualified class name if the given argument name is
     * an object argument of the given method and type information is
     * available. Otherwise return null.
     *
     * @param \ReflectionMethod $method
     * @param string            $argumentName
     *
     *
     * @return string | null
     */
    public function getFullyQualifiedClassNameIfAvailable(
        \ReflectionMethod $method,
        $argumentName
    )
    {
        $params = $method->getParameters();
        foreach($params as $oneParam) {
            $name = $oneParam->getName();
            if ($name === $argumentName) {
                $class = $oneParam->getClass();
                if ($class) {
                    $classTypeString = $class->getName();
                    // The returned class name doesn't start with '\'
                    // Add it so that the name is correct in more places to make the rest of the code easier.
                    return "\\$classTypeString";
                } else {
                    // When array type annotation is used, getClass also returns null.
                    return null;
                }
            }
        }
        return null;
    }
}
