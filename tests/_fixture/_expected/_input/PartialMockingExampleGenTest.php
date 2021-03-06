<?php
namespace Box\TestScribe\_fixture\_input;

/**
 * Generated by TestScribe.
 */
class PartialMockingExampleGenTest extends \Box\TestScribe\_fixture\TestCase
{
    /**
     * @covers \Box\TestScribe\_fixture\_input\PartialMockingExample::calc
     * @covers \Box\TestScribe\_fixture\_input\PartialMockingExample
     */
    public function test_calc()
    {
        // Setup mocks injected by the dependency management system.

        /** @var \Box\TestScribe\_fixture\_input\Logger $mockLogger */
        $mockLogger = $this->shmock(
            '\\Box\\TestScribe\\_fixture\\_input\\Logger',
            function (
                /** @var \Box\TestScribe\_fixture\_input\Logger|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                $shmock->log('internal calc called');
            }
        );
        \Box\TestScribe\_fixture\ServiceLocator::overwrite('\\Box\\TestScribe\\_fixture\\_input\\Logger', $mockLogger);

        // Execute the method under test.

        /** @var \Box\TestScribe\_fixture\_input\PartialMockingExample $mockPartialMockingExample */
        $mockPartialMockingExample = $this->shmock(
            '\\Box\\TestScribe\\_fixture\\_input\\PartialMockingExample',
            function (
                /** @var \Box\TestScribe\_fixture\_input\PartialMockingExample|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();

                // Setup mocks for parameters to the constructor.

                /** @var \Box\TestScribe\_fixture\_input\CalculatorFactory $mockCalculatorFactory */
                $mockCalculatorFactory = $this->shmock(
                    '\\Box\\TestScribe\\_fixture\\_input\\CalculatorFactory',
                    function (
                        /** @var \Box\TestScribe\_fixture\_input\CalculatorFactory|\Shmock\PHPUnitMockInstance $shmock */
                        $shmock
                    ) {
                        $shmock->order_matters();
                        $shmock->disable_original_constructor();
                    }
                );

                $shmock->set_constructor_arguments($mockCalculatorFactory);

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->internalCalc();
                $mock->return_value(3);
            }
        );

        $executionResult = $mockPartialMockingExample->calc();

        // Validate the execution result.

        $expected = 4;
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }
}
