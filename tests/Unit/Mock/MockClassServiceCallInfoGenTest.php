<?php
namespace Box\TestScribe\Mock;

/**
 * Generated by TestScribe.
 */
class MockClassServiceCallInfoGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers \Box\TestScribe\Mock\MockClassServiceCallInfo::showCallInfo
     * @covers \Box\TestScribe\Mock\MockClassServiceCallInfo
     */
    public function test_showCallInfo()
    {
        // Setup mocks for parameters to the method under test.

        /** @var \Box\TestScribe\MethodInfo\Method $mockMethod4 */
        $mockMethod4 = $this->shmock(
            '\\Box\\TestScribe\\MethodInfo\\Method',
            function (
                /** @var \Box\TestScribe\MethodInfo\Method|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getName();
                $mock->return_value('method_name');
            }
        );

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Output $mockOutput1 */
        $mockOutput1 = $this->shmock(
            '\\Box\\TestScribe\\Output',
            function (
                /** @var \Box\TestScribe\Output|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                $shmock->write('' . "\n" .
                'line ( 11 ) Calling mock_obj_name->method_name( ');

                $shmock->writeln('param_info');
            }
        );

        /** @var \Box\TestScribe\Utils\CallInformationCollector $mockCallInformationCollector2 */
        $mockCallInformationCollector2 = $this->shmock(
            '\\Box\\TestScribe\\Utils\\CallInformationCollector',
            function (
                /** @var \Box\TestScribe\Utils\CallInformationCollector|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                // Set up mocks of return values.

                /** @var \Box\TestScribe\Utils\CallInfo $mockCallInfo5 */
                $mockCallInfo5 = $this->shmock(
                    '\\Box\\TestScribe\\Utils\\CallInfo',
                    function (
                        /** @var \Box\TestScribe\Utils\CallInfo|\Shmock\PHPUnitMockInstance $shmock */
                        $shmock
                    ) {
                        $shmock->order_matters();
                        $shmock->disable_original_constructor();

                        /** @var $mock \Shmock\Spec */
                        $mock = $shmock->getLineNumberString();
                        $mock->return_value('11');
                    }
                );

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getCallerInfoAt(7);
                $mock->return_value($mockCallInfo5);
            }
        );

        /** @var \Box\TestScribe\ArgumentInfo\MethodCallInfo $mockMethodCallInfo3 */
        $mockMethodCallInfo3 = $this->shmock(
            '\\Box\\TestScribe\\ArgumentInfo\\MethodCallInfo',
            function (
                /** @var \Box\TestScribe\ArgumentInfo\MethodCallInfo|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getCallParamInfo();
                $mock->return_value('param_info');
            }
        );

        $objectUnderTest = new \Box\TestScribe\Mock\MockClassServiceCallInfo($mockOutput1, $mockCallInformationCollector2, $mockMethodCallInfo3);

        $objectUnderTest->showCallInfo('mock_obj_name', $mockMethod4, ['arg0']);
    }
}
