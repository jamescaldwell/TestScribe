<?php
/**
 *
 */

namespace Box\TestScribe\_fixture\_input;

/**
 * Class MagicMethodTest
 * @package Box\TestScribe\_fixture\_input
 *
 * Used for testing magic methods support.
 */
class MagicMethodTest
{
    /**
     * @param string $methodName
     * @param array  $argument
     *
     * @return string
     */
    public function __call($methodName, array $argument)
    {
        return $methodName;
    }
}
