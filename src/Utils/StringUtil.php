<?php
/**
 *
 */

namespace Box\TestScribe\Utils;

/**
 * Utilities related to Strings.
 * 
 * Class StringUtil
 * @package Box\TestScribe\Utils
 */
class StringUtil 
{
    /**
     * @param string $subject
     * @param string $prefix
     *
     * @return bool
     * 
     * Since the method is so simple, it doesn't make sense to 
     * make unit test more complex by mocking out this class.
     * Thus we don't expect this class to be injected by the 
     * dependency injection framework.
     * 
     * Make this method static to make it easier for the clients
     * to use. 
     */
    static public function isStringStartWith($subject, $prefix)
    {
        $length = strlen($prefix);
        $subStr = substr($subject, 0, $length);
        $hasPrefix = ($subStr === $prefix);
        
        return $hasPrefix;
    }
}
