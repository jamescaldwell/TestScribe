<?php

namespace Box\TestScribe\_fixture;

use Box\TestScribe\InputHistoryData;
use Box\TestScribe\MockClass;

/**
 */
class MockObjectFactoryForTest
{
    private static $inputHistoryDataMockClass = null;

    /**
     * @param string $className
     *
     * @return MockClass
     *
     * Create a mock class mocking the fully qualified class name.
     */
    private static function getMockClass($className)
    {
        $objectFactoryObj = new ObjectFactory();
        $mockFactoryObj = $objectFactoryObj->getFullMockObjectFactory();
        $mockClass = $mockFactoryObj->createMockObject($className);

        return $mockClass;
    }

    /**
     * @return MockClass
     *
     * Return a mock class instance singleton for testing.
     *
     * Because multiple tests by default run in the same process,
     * if multiple mocks of the same class are created, name collision may
     * happen due to the global counter being reset.
     *
     * e.g. error:
     * Cannot redeclare class _GEN_MOCK_mockInputHistoryData0
     */
    public static function getInputHistoryDataMockClass()
    {
        if (self::$inputHistoryDataMockClass === null) {
            self::$inputHistoryDataMockClass = self::getMockClass('Box\TestScribe\InputHistoryData');
        }

        return self::$inputHistoryDataMockClass;
    }

    /**
     * @return InputHistoryData
     */
    public static function getInputHistoryDataMockInstance()
    {
        $mockClass = self::getInputHistoryDataMockClass();
        $mockInstance = $mockClass->getMockedDynamicClassObj();

        return $mockInstance;
    }

}
