<?php
/**
 *
 */

namespace Box\TestScribe\_fixture\_input;

/**
 * Class MagicMethodUsage
 * @package Box\TestScribe\_fixture\_input
 *
 * Used for testing magic methods support.
 */
class MagicMethodUsage
{
    /**
     * @param \Box\TestScribe\_fixture\_input\MagicMethodTest $magicTest
     *
     * @return string
     */
    public function callMagicMethod(
        MagicMethodTest $magicTest
    )
    {
        $rc = $magicTest->foo();
        
        return $rc;
    }
}
