<?php
/**
 *
 */

namespace Box\TestScribe\Utils;

use Box\TestScribe\ClassBuilder;

/**
 * Class MockClassUtil
 * @package Box\TestScribe\Utils
 */
class MockClassUtil
{
    /**
     * Return true if the fully qualified class name represents a mock class.
     *
     * @param string $className
     *
     * @return bool
     */
    public function isMockClass($className)
    {
        $isMock = StringUtil::isStringStartWith(
            $className,
            ClassBuilder::MOCK_CLASS_NAME_PREFIX
        );

        return $isMock;
    }
}
