<?php
/**
 *
 */

namespace Box\TestScribe\Utils;

use Box\TestScribe\GeneratorException;

/**
 */
class ValueFormatterHelper
{
    /**
     * @param mixed $value can't contain objects or resources
     *
     * @return mixed|string
     * @throws \Box\TestScribe\GeneratorException
     */
    public function getReadableFormatFromSimpleValue($value)
    {
        if (is_null($value)) {
            // print(null) will print nothing.
            // Need to make the output more explict.

            return 'NULL';
        }

        if (is_bool($value)) {
            // print(true) will print 1.
            // print(false) will print nothing.
            // Need to make the output more explict.

            $result = var_export($value, true);

            return $result;
        }

        if (is_scalar($value)) {
            // print('a') will print 'a'
            // print(1) will print 1 as expected

            return $value;
        }

        if (is_array($value)) {
            // print([1] will print array, which is not what we want.

            // @TODO (ryang 5/27/15) : detect sequential array and use the [ a, b ] syntax.
            $result = $this->formatArrayValue($value);

            return $result;
        }

        $type = gettype($value);
        $exceptionMsg = "Formatting the variable of the type ( $type ) is not supported.";
        throw new GeneratorException($exceptionMsg);
    }

    /**
     * @param array $value
     *
     * @return string
     * @throws \Box\TestScribe\GeneratorException
     */
    private function formatArrayValue(
        array $value
    )
    {
        if ($this->isAssociativeArray($value)) {
            $elementStrArray = $this->getReadableElementsForAssociativeArray($value);
        } else {
            $elementStrArray = $this->getReadableElementsForSequentialArray($value);
        }
        $elements = join(', ', $elementStrArray);
        $result = "[$elements]";

        return $result;
    }

    /**
     * @param array $value
     *
     * @return array
     * @throws \Box\TestScribe\GeneratorException
     */
    private function getReadableElementsForSequentialArray(
        array $value
    )
    {
        $elementStrArray = [];

        foreach ($value as $elementValue) {
             $readableElementValue = $this->getReadableFormatFromSimpleValue($elementValue);
             $elementStrArray[] = $readableElementValue;
         }

        return $elementStrArray;
    }

    /**
     * @param array $value
     *
     * @return array
     * @throws \Box\TestScribe\GeneratorException
     */
    private function getReadableElementsForAssociativeArray(
        array $value
    )
    {
        $elementStrArray = [];

        foreach ($value as $index => $elementValue) {
            $readableIndexValue = $this->getReadableFormatFromSimpleValue($index);
            $readableElementValue = $this->getReadableFormatFromSimpleValue($elementValue);
            $elementStr = "$readableIndexValue => $readableElementValue";
            $elementStrArray[] = $elementStr;
        }

        return $elementStrArray;
    }
    /**
     * @param array $arrayValue
     *
     * @return bool
     */
    private function isAssociativeArray(
        array $arrayValue
    )
    {
        $keys = array_keys($arrayValue);
        $keysForSequentialArray = range(0, count($arrayValue) - 1);
        $isAssociative = ($keys !== $keysForSequentialArray);

        return $isAssociative;
    }
}
