<?php
/**
 *
 */

namespace Box\TestScribe\Utils;

use Box\TestScribe\Exception\TestScribeException;

/**
 * Class ArrayUtil
 * @package Box\TestScribe\Utils
 */
class ArrayUtil
{
    /**
     * Look up a key's value of a given type.
     *
     * The default value is returned if the key does not exist or the value
     * has the unexpected type.
     *
     * @param mixed $key
     * @param string $type
     * @param array $array
     * @param mixed $defaultValue
     *
     * @return mixed
     */
    static private function lookupValueCheckType(
        $key,
        $type,
        array $array,
        $defaultValue
    )
    {
        if (gettype($defaultValue) !== $type) {
            $msg = "Default value ( $defaultValue ) doesn't have the expected type ( $type )";
            throw new TestScribeException($msg);
        }

        $value = $defaultValue;

        $keyExists = array_key_exists($key, $array);
        if ($keyExists) {
            $actualValue = $array[$key];
            $actualType = gettype($actualValue);
            if ($actualType === $type) {
                $value = $actualValue;
            }
        }

        return $value;
    }

    /**
      * Look up a key's value of a boolean type.
      *
      * The default value is returned if the key does not exist or the value
      * is not a boolean type.
      *
      * @param mixed $key
      * @param array $array
      * @param bool $defaultValue
      *
      * @return bool
      */
    static public function lookupBoolValue(
        $key,
        array $array,
        $defaultValue
    )
    {
        $value = self::lookupValueCheckType(
            $key,
            'boolean',
            $array,
            $defaultValue
        );

        return $value;
    }

    /**
      * Look up a key's value of a string type.
      *
      * The default value is returned if the key does not exist or the value
      * is not a string type.
      *
      * @param mixed $key
      * @param array $array
      * @param string $defaultValue
      *
      * @return string
      */
    static public function lookupStringValue(
        $key,
        array $array,
        $defaultValue
    )
    {
        $value = self::lookupValueCheckType(
            $key,
            'string',
            $array,
            $defaultValue
        );

        return $value;
    }

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
     * @param int $numOfNewLines
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
