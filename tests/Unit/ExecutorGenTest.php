<?php
namespace Box\TestScribe;

/**
 * Generated by TestScribe.
 */
class ExecutorGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers \Box\TestScribe\Executor::runMethod
     * @covers \Box\TestScribe\Executor
     */
    public function testRunMethod_static()
    {
        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Mock\MockClassLoader $mockMockClassLoader1 */
        $mockMockClassLoader1 = $this->shmock(
            '\\Box\\TestScribe\\Mock\\MockClassLoader',
            function (
                /** @var \Box\TestScribe\Mock\MockClassLoader|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );

        /** @var \Box\TestScribe\Config\GlobalComputedConfig $mockGlobalComputedConfig2 */
        $mockGlobalComputedConfig2 = $this->shmock(
            '\\Box\\TestScribe\\Config\\GlobalComputedConfig',
            function (
                /** @var \Box\TestScribe\Config\GlobalComputedConfig|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getMethodName();
                $mock->return_value('method_name');

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->isMethodStatic();
                $mock->return_value(true);
            }
        );

        /** @var \Box\TestScribe\Execution\StaticMethodExecutor $mockStaticMethodExecutor3 */
        $mockStaticMethodExecutor3 = $this->shmock(
            '\\Box\\TestScribe\\Execution\\StaticMethodExecutor',
            function (
                /** @var \Box\TestScribe\Execution\StaticMethodExecutor|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                // Set up mocks of return values.

                /** @var \Box\TestScribe\StaticExecutionResultValue $mockStaticExecutionResultValue5 */
                $mockStaticExecutionResultValue5 = $this->shmock(
                    '\\Box\\TestScribe\\StaticExecutionResultValue',
                    function (
                        /** @var \Box\TestScribe\StaticExecutionResultValue|\Shmock\PHPUnitMockInstance $shmock */
                        $shmock
                    ) {
                        $shmock->order_matters();
                        $shmock->disable_original_constructor();

                        // Set up mocks of return values.

                        /** @var \Box\TestScribe\Arguments $mockArguments6 */
                        $mockArguments6 = $this->shmock(
                            '\\Box\\TestScribe\\Arguments',
                            function (
                                /** @var \Box\TestScribe\Arguments|\Shmock\PHPUnitMockInstance $shmock */
                                $shmock
                            ) {
                                $shmock->order_matters();
                                $shmock->disable_original_constructor();

                                /** @var $mock \Shmock\Spec */
                                $mock = $shmock->jsonSerialize();
                                $mock->return_value('method arguments json encoded');
                            }
                        );

                        /** @var $mock \Shmock\Spec */
                        $mock = $shmock->getValue();
                        $mock->return_value('return_value');

                        /** @var $mock \Shmock\Spec */
                        $mock = $shmock->getArguments();
                        $mock->return_value($mockArguments6);
                    }
                );

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->runStaticMethod();
                $mock->return_value($mockStaticExecutionResultValue5);
            }
        );

        /** @var \Box\TestScribe\InstanceMethodExecutor $mockInstanceMethodExecutor4 */
        $mockInstanceMethodExecutor4 = $this->shmock(
            '\\Box\\TestScribe\\InstanceMethodExecutor',
            function (
                /** @var \Box\TestScribe\InstanceMethodExecutor|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );

        $objectUnderTest = new Execution\Executor($mockMockClassLoader1, $mockGlobalComputedConfig2, $mockStaticMethodExecutor3, $mockInstanceMethodExecutor4);
        $executionResult = $objectUnderTest->runMethod();

        // Validate the execution result.

        $this->assertInstanceOf(
            'Box\\TestScribe\\Execution\\ExecutionResult',
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected type.'
        );

        $this->assertSame(
            '{"constructorArguments":"[]","methodArguments":"\\"method arguments json encoded\\"","mockClassUnderTest":"null","resultValue":"return_value","exception":"null"}',
            json_encode($executionResult),
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );

    }

    /**
     * @covers \Box\TestScribe\Executor::runMethod
     * @covers \Box\TestScribe\Executor
     */
    public function testRunMethod_instance()
    {
        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Mock\MockClassLoader $mockMockClassLoader1 */
        $mockMockClassLoader1 = $this->shmock(
            '\\Box\\TestScribe\\Mock\\MockClassLoader',
            function (
                /** @var \Box\TestScribe\Mock\MockClassLoader|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                // Set up mocks of return values.

                /** @var \Box\TestScribe\Mock\MockClass $mockMockClass5 */
                $mockMockClass5 = $this->shmock(
                    '\\Box\\TestScribe\\Mock\\MockClass',
                    function (
                        /** @var \Box\TestScribe\Mock\MockClass|\Shmock\PHPUnitMockInstance $shmock */
                        $shmock
                    ) {
                        $shmock->order_matters();
                        $shmock->disable_original_constructor();

                        /** @var $mock \Shmock\Spec */
                        $mock = $shmock->jsonSerialize();
                        $mock->return_value('json serialized mock class');
                    }
                );

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->createAndLoadMockClass('class_name', 'method_name');
                $mock->return_value($mockMockClass5);
            }
        );

        /** @var \Box\TestScribe\Config\GlobalComputedConfig $mockGlobalComputedConfig2 */
        $mockGlobalComputedConfig2 = $this->shmock(
            '\\Box\\TestScribe\\Config\\GlobalComputedConfig',
            function (
                /** @var \Box\TestScribe\Config\GlobalComputedConfig|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                // Set up mocks of return values.

                /** @var \Box\TestScribe\Method $mockMethod6 */
                $mockMethod6 = $this->shmock(
                    '\\Box\\TestScribe\\Method',
                    function (
                        /** @var \Box\TestScribe\Method|\Shmock\PHPUnitMockInstance $shmock */
                        $shmock
                    ) {
                        $shmock->order_matters();
                        $shmock->disable_original_constructor();
                    }
                );

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getMethodName();
                $mock->return_value('method_name');

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->isMethodStatic();
                $mock->return_value(false);

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getFullClassName();
                $mock->return_value('class_name');

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getInMethod();
                $mock->return_value($mockMethod6);
            }
        );

        /** @var \Box\TestScribe\Execution\StaticMethodExecutor $mockStaticMethodExecutor3 */
        $mockStaticMethodExecutor3 = $this->shmock(
            '\\Box\\TestScribe\\Execution\\StaticMethodExecutor',
            function (
                /** @var \Box\TestScribe\Execution\StaticMethodExecutor|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );

        /** @var \Box\TestScribe\InstanceMethodExecutor $mockInstanceMethodExecutor4 */
        $mockInstanceMethodExecutor4 = $this->shmock(
            '\\Box\\TestScribe\\InstanceMethodExecutor',
            function (
                /** @var \Box\TestScribe\InstanceMethodExecutor|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                // Set up mocks of return values.

                /** @var \Box\TestScribe\InstanceMethodExecutionResultValue $mockInstanceMethodExecutionResultValue7 */
                $mockInstanceMethodExecutionResultValue7 = $this->shmock(
                    '\\Box\\TestScribe\\InstanceMethodExecutionResultValue',
                    function (
                        /** @var \Box\TestScribe\InstanceMethodExecutionResultValue|\Shmock\PHPUnitMockInstance $shmock */
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

                                /** @var $mock \Shmock\Spec */
                                $mock = $shmock->jsonSerialize();
                                $mock->return_value('method arguments json encoded');
                            }
                        );

                        /** @var \Box\TestScribe\Arguments $mockArguments9 */
                        $mockArguments9 = $this->shmock(
                            '\\Box\\TestScribe\\Arguments',
                            function (
                                /** @var \Box\TestScribe\Arguments|\Shmock\PHPUnitMockInstance $shmock */
                                $shmock
                            ) {
                                $shmock->order_matters();
                                $shmock->disable_original_constructor();

                                /** @var $mock \Shmock\Spec */
                                $mock = $shmock->jsonSerialize();
                                $mock->return_value('constructor arguments json encoded');
                            }
                        );

                        /** @var $mock \Shmock\Spec */
                        $mock = $shmock->getValue();
                        $mock->return_value('return_value');

                        /** @var $mock \Shmock\Spec */
                        $mock = $shmock->getMethodArguments();
                        $mock->return_value($mockArguments8);

                        /** @var $mock \Shmock\Spec */
                        $mock = $shmock->getConstructorArguments();
                        $mock->return_value($mockArguments9);
                    }
                );

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->runInstanceMethod();
                $mock->return_value($mockInstanceMethodExecutionResultValue7);
            }
        );

        $objectUnderTest = new Execution\Executor($mockMockClassLoader1, $mockGlobalComputedConfig2, $mockStaticMethodExecutor3, $mockInstanceMethodExecutor4);
        $executionResult = $objectUnderTest->runMethod();

        // Validate the execution result.

        $this->assertInstanceOf(
            'Box\\TestScribe\\Execution\\ExecutionResult',
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected type.'
        );

        $this->assertSame(
            '{"constructorArguments":"\\"constructor arguments json encoded\\"","methodArguments":"\\"method arguments json encoded\\"","mockClassUnderTest":"\\"json serialized mock class\\"","resultValue":"return_value","exception":"null"}',
            json_encode($executionResult),
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );

    }
}
