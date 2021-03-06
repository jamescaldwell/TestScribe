<?php
namespace Box\TestScribe\Mock;

/**
 * Generated by TestScribe.
 */
class PartialMockUtilGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers \Box\TestScribe\Mock\PartialMockUtil::isClassUnderTestPartiallyMocked
     * @covers \Box\TestScribe\Mock\PartialMockUtil
     */
    public function test_isClassUnderTestPartiallyMocked_no_mock()
    {
        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Utils\ReflectionUtil $mockReflectionUtil */
        $mockReflectionUtil = $this->shmock(
            '\\Box\\TestScribe\\Utils\\ReflectionUtil',
            function (
                /** @var \Box\TestScribe\Utils\ReflectionUtil|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );

        $objectUnderTest = new \Box\TestScribe\Mock\PartialMockUtil($mockReflectionUtil);

        $executionResult = $objectUnderTest->isClassUnderTestPartiallyMocked(null);

        // Validate the execution result.

        $expected = false;
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

    /**
     * @covers \Box\TestScribe\Mock\PartialMockUtil::isClassUnderTestPartiallyMocked
     * @covers \Box\TestScribe\Mock\PartialMockUtil
     */
    public function test_isClassUnderTestPartiallyMocked_abstract_class()
    {
        // Setup mocks for parameters to the method under test.

        /** @var \Box\TestScribe\Mock\MockClass $mockMockClass */
        $mockMockClass = $this->shmock(
            '\\Box\\TestScribe\\Mock\\MockClass',
            function (
                /** @var \Box\TestScribe\Mock\MockClass|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getClassNameBeingMocked();
                $mock->return_value('class_being_mocked');
            }
        );

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Utils\ReflectionUtil $mockReflectionUtil */
        $mockReflectionUtil = $this->shmock(
            '\\Box\\TestScribe\\Utils\\ReflectionUtil',
            function (
                /** @var \Box\TestScribe\Utils\ReflectionUtil|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->isAbstractClass('class_being_mocked');
                $mock->return_value(true);
            }
        );

        $objectUnderTest = new \Box\TestScribe\Mock\PartialMockUtil($mockReflectionUtil);

        $executionResult = $objectUnderTest->isClassUnderTestPartiallyMocked($mockMockClass);

        // Validate the execution result.

        $expected = true;
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

    /**
     * @covers \Box\TestScribe\Mock\PartialMockUtil::isClassUnderTestPartiallyMocked
     * @covers \Box\TestScribe\Mock\PartialMockUtil
     */
    public function test_isClassUnderTestPartiallyMocked_call_non_public_methods()
    {
        // Setup mocks for parameters to the method under test.

        /** @var \Box\TestScribe\Mock\MockClass $mockMockClass */
        $mockMockClass = $this->shmock(
            '\\Box\\TestScribe\\Mock\\MockClass',
            function (
                /** @var \Box\TestScribe\Mock\MockClass|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getClassNameBeingMocked();
                $mock->return_value('class_being_mocked');

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getMethodInvocations();
                $mock->return_value([1]);
            }
        );

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Utils\ReflectionUtil $mockReflectionUtil */
        $mockReflectionUtil = $this->shmock(
            '\\Box\\TestScribe\\Utils\\ReflectionUtil',
            function (
                /** @var \Box\TestScribe\Utils\ReflectionUtil|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->isAbstractClass('class_being_mocked');
                $mock->return_value(false);
            }
        );

        $objectUnderTest = new \Box\TestScribe\Mock\PartialMockUtil($mockReflectionUtil);

        $executionResult = $objectUnderTest->isClassUnderTestPartiallyMocked($mockMockClass);

        // Validate the execution result.

        $expected = true;
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

    /**
     * @covers \Box\TestScribe\Mock\PartialMockUtil::isClassUnderTestPartiallyMocked
     * @covers \Box\TestScribe\Mock\PartialMockUtil
     */
    public function test_isClassUnderTestPartiallyMocked_no_mocked_method_invocation()
    {
        // Setup mocks for parameters to the method under test.

        /** @var \Box\TestScribe\Mock\MockClass $mockMockClass */
        $mockMockClass = $this->shmock(
            '\\Box\\TestScribe\\Mock\\MockClass',
            function (
                /** @var \Box\TestScribe\Mock\MockClass|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getClassNameBeingMocked();
                $mock->return_value('class_being_mocked');

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getMethodInvocations();
                $mock->return_value([]);
            }
        );

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Utils\ReflectionUtil $mockReflectionUtil */
        $mockReflectionUtil = $this->shmock(
            '\\Box\\TestScribe\\Utils\\ReflectionUtil',
            function (
                /** @var \Box\TestScribe\Utils\ReflectionUtil|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->isAbstractClass('class_being_mocked');
                $mock->return_value(false);
            }
        );

        $objectUnderTest = new \Box\TestScribe\Mock\PartialMockUtil($mockReflectionUtil);

        $executionResult = $objectUnderTest->isClassUnderTestPartiallyMocked($mockMockClass);

        // Validate the execution result.

        $expected = false;
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }
}
