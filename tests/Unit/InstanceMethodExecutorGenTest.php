<?php
namespace Box\TestScribe;

/**
 * Generated by PHPUnit_test_Generator.
 */
class InstanceMethodExecutorGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers \Box\TestScribe\InstanceMethodExecutor::runInstanceMethod
     * @covers \Box\TestScribe\InstanceMethodExecutor
     */
    public function testRunInstanceMethod()
    {
        // Setup mocks for parameters to the method under test.

        /** @var \Box\TestScribe\Mock\MockClass $mockMockClass4 */
        $mockMockClass4 = $this->shmock(
            '\\Box\\TestScribe\\Mock\\MockClass',
            function (
                /** @var \Box\TestScribe\Mock\MockClass|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );

        /** @var \Box\TestScribe\Method $mockMethod5 */
        $mockMethod5 = $this->shmock(
            '\\Box\\TestScribe\\Method',
            function (
                /** @var \Box\TestScribe\Method|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Utils\ReflectionUtil $mockReflectionUtil1 */
        $mockReflectionUtil1 = $this->shmock(
            '\\Box\\TestScribe\\Utils\\ReflectionUtil',
            function (
                /** @var \Box\TestScribe\Utils\ReflectionUtil|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->invokeMethodRegardlessOfProtectionLevel();
                $mock->return_value(null);
            }
        );

        /** @var \Box\TestScribe\ArgumentsCollector $mockArgumentsCollector2 */
        $mockArgumentsCollector2 = $this->shmock(
            '\\Box\\TestScribe\\ArgumentsCollector',
            function (
                /** @var \Box\TestScribe\ArgumentsCollector|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                // Set up mocks of return values.

                /** @var \Box\TestScribe\Arguments $mockArguments8 */
                $mockArguments8 = $this->shmock(
                    '\\Box\\TestScribe\\Arguments',
                    function (
                        /** @var \Box\TestScribe\Arguments|\Shmock\PHPUnitMockInstance $shmock */
                        $shmock
                    ) {
                        $shmock->order_matters();
                        $shmock->disable_original_constructor();
                    }
                );

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->collect();
                $mock->return_value($mockArguments8);
            }
        );

        /** @var \Box\TestScribe\ClassUnderTestMockCreator $mockClassUnderTestMockCreator3 */
        $mockClassUnderTestMockCreator3 = $this->shmock(
            '\\Box\\TestScribe\\ClassUnderTestMockCreator',
            function (
                /** @var \Box\TestScribe\ClassUnderTestMockCreator|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                // Set up mocks of return values.

                /** @var \Box\TestScribe\ClassUnderTestMockCreationResultValue $mockClassUnderTestMockCreationResultValue6 */
                $mockClassUnderTestMockCreationResultValue6 = $this->shmock(
                    '\\Box\\TestScribe\\ClassUnderTestMockCreationResultValue',
                    function (
                        /** @var \Box\TestScribe\ClassUnderTestMockCreationResultValue|\Shmock\PHPUnitMockInstance $shmock */
                        $shmock
                    ) {
                        $shmock->order_matters();
                        $shmock->disable_original_constructor();

                        // Set up mocks of return values.

                        /** @var \Box\TestScribe\Arguments $mockArguments7 */
                        $mockArguments7 = $this->shmock(
                            '\\Box\\TestScribe\\Arguments',
                            function (
                                /** @var \Box\TestScribe\Arguments|\Shmock\PHPUnitMockInstance $shmock */
                                $shmock
                            ) {
                                $shmock->order_matters();
                                $shmock->disable_original_constructor();
                            }
                        );

                        /** @var $mock \Shmock\Spec */
                        $mock = $shmock->getConstructorArgs();
                        $mock->return_value($mockArguments7);

                        /** @var $mock \Shmock\Spec */
                        $mock = $shmock->getMockObj();
                        $mock->return_value(null);
                    }
                );

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->createMockObjectForTheClassUnderTest();
                $mock->return_value($mockClassUnderTestMockCreationResultValue6);
            }
        );

        $objectUnderTest = new \Box\TestScribe\InstanceMethodExecutor($mockReflectionUtil1, $mockArgumentsCollector2, $mockClassUnderTestMockCreator3);

        $executionResult = $objectUnderTest->runInstanceMethod($mockMockClass4, $mockMethod5);

        // Validate the execution result.

        $this->assertInstanceOf(
            'Box\\TestScribe\\InstanceMethodExecutionResultValue',
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected type.'
        );

        $this->assertSame(
            '{}',
            json_encode($executionResult),
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );

    }
}
