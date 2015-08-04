<?php
namespace Box\TestScribe\_fixture\_input;

/**
 * Generated by PHPUnit_test_Generator.
 */
class TestEarlyDemoGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers \Box\TestScribe\_fixture\_input\TestEarlyDemo::computeAndGetResultMsg
     * @covers \Box\TestScribe\_fixture\_input\TestEarlyDemo
     */
    public function testComputeAndGetResultMsg()
    {
        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\_fixture\_input\ComplexComputation $mockComplexComputation1 */
        $mockComplexComputation1 = $this->shmock(
            '\\Box\\TestScribe\\_fixture\\_input\\ComplexComputation',
            function (
                /** @var \Box\TestScribe\_fixture\_input\ComplexComputation|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                // Set up mocks of return values.

                /** @var \Box\TestScribe\_fixture\_input\ComplexComputationResult $mockComplexComputationResult2 */
                $mockComplexComputationResult2 = $this->shmock(
                    '\\Box\\TestScribe\\_fixture\\_input\\ComplexComputationResult',
                    function (
                        /** @var \Box\TestScribe\_fixture\_input\ComplexComputationResult|\Shmock\PHPUnitMockInstance $shmock */
                        $shmock
                    ) {
                        $shmock->order_matters();
                        $shmock->disable_original_constructor();

                        /** @var $mock \Shmock\Spec */
                        $mock = $shmock->getIntResult();
                        $mock->return_value(2);
                    }
                );

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->calculate(1);
                $mock->return_value($mockComplexComputationResult2);
            }
        );

        $objectUnderTest = new \Box\TestScribe\_fixture\_input\TestEarlyDemo($mockComplexComputation1);

        $executionResult = $objectUnderTest->computeAndGetResultMsg(1);

        // Validate the execution result.

        $expected = 'After computing with the input ( 1 ), ( 2 ) is returned. ';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }
}
