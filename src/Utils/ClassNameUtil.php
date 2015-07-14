<?php

namespace Box\TestScribe\Utils;

/**
 * Utilities related to class names
 *
 * Class ClassNameUtil
 * @package Box\TestScribe\Utils
 */
class ClassNameUtil
{
    /**
     * Add '\' if the class name doesn't start with it.
     *
     * @param string $className fully qualified class name
     *
     * @return string
     *
     * Since the method is so simple, it doesn't make sense to
     * make unit test more complex by mocking out this class.
     * Thus we don't expect this class to be injected by the
     * dependency injection framework.
     *
     * Make this method static to make it easier for the clients
     * to use.

     */
    static public function getNormalizedFullyQualifiedClassName($className)
    {
        $isPrefixedWithBackSlash =
            StringUtil::isStringStartWith($className, '\\');

        if (!$isPrefixedWithBackSlash) {
            $normalizedClassName = "\\$className";
        } else {
            $normalizedClassName = $className;
        }

        return $normalizedClassName;
    }
}
