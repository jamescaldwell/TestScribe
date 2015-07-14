<?php
/**
 *
 */

namespace Box\TestScribe\Utils;

/**
 * Class ArrayUtil
 * @package Box\TestScribe\Utils
 */
class ArrayUtil
{
    /**
     * @param mixed $key
     * @param array $array
     * @param mixed $defaultValue
     *
     * @return mixed
     */
    static public function lookupValueByKey(
        $key,
        array $array,
        $defaultValue
    )
    {
        $keyExists = array_key_exists($key, $array);
        if ($keyExists) {
            $value = $array[$key];
        } else {
            $value = $defaultValue;
        }

        return $value;
    }

    /**
     * @param string[] $stringArray
     *
     * @param int      $numOfNewLines
     *
     * @return string
     */
    static public function joinNonEmptyStringsWithNewLine(
        array $stringArray,
        $numOfNewLines
    )
    {
        $filteredArray = array_filter($stringArray);
        $newLines = str_repeat("\n", $numOfNewLines);
        $result = join($newLines, $filteredArray);

        return $result;
    }
}
