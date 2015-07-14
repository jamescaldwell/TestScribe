<?php

namespace Box\TestScribe;

/**
 * Utility class related to mocking.
 */
class MockUtil
{
    /**
     * If the given value is an instance of MockClass,
     * return the instance of the dynamic mock class associated with this mock object.
     * Otherwise, return the same value.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    public function checkAndConvertMockClassInstance($value)
    {
        if ($value instanceof MockClass) {
            /**
             * @var MockClass $mock
             */
            $mock = $value;
            $value = $mock->getMockedDynamicClassObj();
        }

        return $value;
    }

    /**
     * Check each value in the given array,
     * return a new array with the instance of the dynamic mock class
     * replaced with the associated with this mock object.
     *
     * @param array $values
     *
     * @return mixed
     */
    public function checkAndConvertMockClassInstanceMultiple($values)
    {
        $newValues = [];
        foreach ($values as $value) {
            $newValue = $this->checkAndConvertMockClassInstance($value);
            $newValues[] = $newValue;
        }

        return $newValues;
    }
}
