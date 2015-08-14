<?php
/**
 *
 */

namespace Box\TestScribe\Input;

/**
 * Class RawInput
 * Get raw string from an input source.
 *
 * @package Box\TestScribe
 */
class RawInput
{
    /**
     * Get a string.
     *
     * @return string
     */
    public function getString()
    {
        $str = readline();

        return $str;
    }
}
