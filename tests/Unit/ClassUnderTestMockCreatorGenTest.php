<?php
namespace Box\TestScribe;

/**
 * Generated by TestScribe.
 */
class ClassUnderTestMockCreatorGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers \Box\TestScribe\Execution\ClassUnderTestMockCreator::createMockObjectForTheClassUnderTest
     * @covers \Box\TestScribe\Execution\ClassUnderTestMockCreator
     */
    public function testCreateMockObjectForTheClassUnderTest_no_constructor()
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

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getConstructorOfTheMockedClass();
                $mock->return_value(null);
            }
        );

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Mock\MockObjectFactory $mockMockObjectFactory1 */
        $mockMockObjectFactory1 = $this->shmock(
            '\\Box\\TestScribe\\Mock\\MockObjectFactory',
            function (
                /** @var \Box\TestScribe\Mock\MockObjectFactory|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->createMockObjectFromMockClass();
                $mock->return_value(null);
            }
        );

        /** @var \Box\TestScribe\ArgumentInfo\ArgumentsCollector $mockArgumentsCollector2 */
        $mockArgumentsCollector2 = $this->shmock(
            '\\Box\\TestScribe\\ArgumentInfo\\ArgumentsCollector',
            function (
                /** @var \Box\TestScribe\ArgumentInfo\ArgumentsCollector|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );

        /** @var \Box\TestScribe\Output $mockOutput3 */
        $mockOutput3 = $this->shmock(
            '\\Box\\TestScribe\\Output',
            function (
                /** @var \Box\TestScribe\Output|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );

        $objectUnderTest = new Execution\ClassUnderTestMockCreator($mockMockObjectFactory1, $mockArgumentsCollector2, $mockOutput3);

        $executionResult = $objectUnderTest->createMockObjectForTheClassUnderTest($mockMockClass4);

        // Validate the execution result.

        $this->assertInstanceOf(
            'Box\\TestScribe\\Execution\\ClassUnderTestMockCreationResultValue',
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected type.'
        );

        $this->assertSame(
            '{}',
            json_encode($executionResult),
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );

    }

    /**
     * @covers \Box\TestScribe\Execution\ClassUnderTestMockCreator::createMockObjectForTheClassUnderTest
     * @covers \Box\TestScribe\Execution\ClassUnderTestMockCreator
     */
    public function testCreateMockObjectForTheClassUnderTest_with_constructor()
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

                // Set up mocks of return values.

                /** @var \Box\TestScribe\MethodInfo\Method $mockMethod5 */
                $mockMethod5 = $this->shmock(
                    '\\Box\\TestScribe\\MethodInfo\\Method',
                    function (
                        /** @var \Box\TestScribe\MethodInfo\Method|\Shmock\PHPUnitMockInstance $shmock */
                        $shmock
                    ) {
                        $shmock->order_matters();
                        $shmock->disable_original_constructor();
                    }
                );

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getConstructorOfTheMockedClass();
                $mock->return_value($mockMethod5);
            }
        );

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Mock\MockObjectFactory $mockMockObjectFactory1 */
        $mockMockObjectFactory1 = $this->shmock(
            '\\Box\\TestScribe\\Mock\\MockObjectFactory',
            function (
                /** @var \Box\TestScribe\Mock\MockObjectFactory|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->createMockObjectFromMockClass();
                $mock->return_value(null);
            }
        );

        /** @var \Box\TestScribe\ArgumentInfo\ArgumentsCollector $mockArgumentsCollector2 */
        $mockArgumentsCollector2 = $this->shmock(
            '\\Box\\TestScribe\\ArgumentInfo\\ArgumentsCollector',
            function (
                /** @var \Box\TestScribe\ArgumentInfo\ArgumentsCollector|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                // Set up mocks of return values.

                /** @var \Box\TestScribe\ArgumentInfo\Arguments $mockArguments6 */
                $mockArguments6 = $this->shmock(
                    '\\Box\\TestScribe\\ArgumentInfo\\Arguments',
                    function (
                        /** @var \Box\TestScribe\ArgumentInfo\Arguments|\Shmock\PHPUnitMockInstance $shmock */
                        $shmock
                    ) {
                        $shmock->order_matters();
                        $shmock->disable_original_constructor();

                        /** @var $mock \Shmock\Spec */
                        $mock = $shmock->getValues();
                        $mock->return_value(['constructor arg']);
                    }
                );

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->collect();
                $mock->return_value($mockArguments6);
            }
        );

        /** @var \Box\TestScribe\Output $mockOutput3 */
        $mockOutput3 = $this->shmock(
            '\\Box\\TestScribe\\Output',
            function (
                /** @var \Box\TestScribe\Output|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                $shmock->writeln('' . "\n" .
                'Start executing the constructor.' . "\n" .
                '');

                $shmock->writeln('' . "\n" .
                'Finish executing the constructor.' . "\n" .
                '');
            }
        );

        $objectUnderTest = new Execution\ClassUnderTestMockCreator($mockMockObjectFactory1, $mockArgumentsCollector2, $mockOutput3);

        $executionResult = $objectUnderTest->createMockObjectForTheClassUnderTest($mockMockClass4);

        // Validate the execution result.

        $this->assertInstanceOf(
            'Box\\TestScribe\\Execution\\ClassUnderTestMockCreationResultValue',
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
