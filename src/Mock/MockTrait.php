<?php

namespace Box\TestScribe\Mock;

use Box\TestScribe\MockClass;

/**
 * The trait to be used by the dynamically generated mock classes.
 */
Trait MockTrait
{
    /**
     * The generic mock class instance used by the test generator to
     * gather method invocation information of this mocked class instance.
     * @var MockClass
     */
    private $unitTestGeneratorMockObj;

    /**
     * The name is intentionally long to reduce conflict
     * with the method names defined by the classes being mocked.
     * 
     * It is called by the generated mock code to route method
     * calls.
     *
     * @param string $methodName
     * @param array  $arguments
     *
     * @return mixed
     */
    // @TODO (ryang 3/2/15) : find the name of @noinspection tag
    // to silence the warning. 
    private function __routeAllCallsToTestGeneratorMockObjects($methodName, $arguments)
    {
        $rc = $this->unitTestGeneratorMockObj->invokeInterceptedCall(
            $methodName,
            $arguments
        );

        return $rc;
    }

    /**
     * The getter method is intentionally prefixed with __
     * to reduce the chance of collision with methods defined in the class
     * being mocked.
     *
     * @return MockClass
     */
    public function __getUnitTestGeneratorMockInstance()
    {
        return $this->unitTestGeneratorMockObj;
    }
}
