<?php

namespace Box\TestScribe\Utils;

/**
 * Misc utility methods
 */
class Util
{
    /**
     * Prepend the additional text if the text is not empty.
     * Otherwise return emtpy string.
     *
     * @param string $textToPrepend
     * @param string $text
     *
     * @return string
     */
    public static function appendStringIfNotEmpty(
        $textToPrepend,
        $text
    )
    {
        if ($text) {
            $result = $textToPrepend . $text;
        } else {
            $result = '';
        }

        return $result;
    }

    /**
     * Recursively check if the $value contains any object.
     * Return true if it does.
     *
     * @param mixed $value
     *
     * @return bool
     */
    public function isObjectIncluded($value)
    {
        if (is_object($value)) {

            return true;
        }

        if (is_array($value)) {
            foreach ($value as $element) {
                if ($this->isObjectIncluded($element)) {

                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Joins the values from several arrays into one array.
     *
     * Faster than array_merge() in the case of numeric array indices (eg: lists)
     * This method has a similar memory profile to array_merge,
     * use nested inline foreach loops if you need best performance in both time & memory
     *
     * Note that the resulting list of values is not uniquified.
     * Use array_unique_join_values if you need unique values.
     *
     * Usage:
     *   $out_array = Box_Helper_Array::array_join_values($arr1, $arr2, ...)
     * or
     *   $out_array = Box:Helper::array_join_values(array($arr1, $arr2, ...))
     *
     * @param *array $parameter arrays to merge together
     *
     * @return array
     */
    public static function array_join_values()
    {
        $output = [];
        $numargs = func_num_args();
        $arrays_to_join = func_get_args();
        if ($numargs == 1) {
            $arrays_to_join = $arrays_to_join[0];
        }
        foreach ($arrays_to_join as $arr) {
            if (!$output) {
                $output = array_values($arr);
                continue;
            }
            foreach ($arr as $value) {
                $output[] = $value;
            }
        }

        return $output;
    }
}
