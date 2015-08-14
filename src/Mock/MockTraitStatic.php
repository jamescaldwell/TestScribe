<?php

namespace Box\TestScribe\Mock;

use Box\TestScribe\Mock\MockClass;

/**
 * The trait to be used by the dynamically generated mock classes
 * for static invocation only.
 */
Trait MockTraitStatic
{
    /**
     * The generic mock class instance used by the test generator to
     * gather method invocation information of this mocked class instance.
     * It has to be static to support invocation of the mocked static
     * method calls.
     * @var MockClass
     */
    private static $generatorMock;

    /**
     * @param string $methodName
     * @param array  $arguments
     *
     * @return mixed
     */
    public static function __callStatic($methodName, $arguments)
    {
        $rc = self::$generatorMock->invokeInterceptedCall($methodName, $arguments);

        return $rc;
    }

    /**
     * @param MockClass $mock
     *
     * @return void
     */
    public static function setMockInstance($mock)
    {
        self::$generatorMock = $mock;
    }
}
