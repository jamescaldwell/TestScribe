<?php
namespace Box\TestScribe\_fixture\_input;

/**
 * Generated by PHPUnit_test_Generator.
 */
class SideEffectExampleGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers \Box\TestScribe\_fixture\_input\SideEffectExample::LogAMessage
     * @covers \Box\TestScribe\_fixture\_input\SideEffectExample
     */
    public function testLogAMessage()
    {
        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\_fixture\_input\Logger $mockLogger1 */
        $mockLogger1 = $this->shmock(
            '\\Box\\TestScribe\\_fixture\\_input\\Logger',
            function (
                /** @var \Box\TestScribe\_fixture\_input\Logger|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                $shmock->log('A message is logged.');
            }
        );

        $objectUnderTest = new \Box\TestScribe\_fixture\_input\SideEffectExample($mockLogger1);

        $objectUnderTest->LogAMessage();
    }
}
