<?php
namespace Box\TestScribe;

/**
 * Generated by TestScribe.
 */
class MockClassTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers Box\TestScribe\MockClass::jsonSerialize
     * @covers Box\TestScribe\MockClass::__toString
     * @covers Box\TestScribe\MockClass::isStaticMock
     * @covers Box\TestScribe\MockClass::getPhpClass
     */
    public function testJsonSerialize()
    {

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Mock\MockClassService $mockMockClassService0 */
        $mockMockClassService0 = $this->shmock(
            '\\Box\\TestScribe\\Mock\\MockClassService',
            function (
                /** @var \Box\TestScribe\Mock\MockClassService|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );
        /** @var \Box\TestScribe\ClassInfo\PhpClass $mockPhpClass1 */
        $mockPhpClass1 = $this->shmock(
            '\\Box\\TestScribe\\ClassInfo\\PhpClass',
            function (
                /** @var \Box\TestScribe\ClassInfo\PhpClass|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );
        $objectUnderTest = new Mock\MockClass(
            $mockMockClassService0, $mockPhpClass1, false, 'passThroughMethod', 'mockObjName'
        );
        $expected = 'mock object ( mockObjName )';

        $executionResult = $objectUnderTest->jsonSerialize();

        // Validate the execution result.

        $this->assertSame(
            $expected,
            $executionResult
        );

        $executionResult = $objectUnderTest->__toString();

        // Validate the execution result.

        $this->assertSame(
            $expected,
            $executionResult
        );

        $isStaticMock = $objectUnderTest->isStaticMock();

        $this->assertFalse($isStaticMock);

        $phpClass = $objectUnderTest->getPhpClass();

        $this->assertSame($mockPhpClass1, $phpClass);
    }
}
