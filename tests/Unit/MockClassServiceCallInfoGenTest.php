<?php
namespace Box\TestScribe;

/**
 * Generated by TestScribe.
 */
class MockClassServiceCallInfoGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;


    /**
     * @covers \Box\TestScribe\MockClassServiceCallInfo::showCallInfo
     * @covers \Box\TestScribe\MockClassServiceCallInfo
     */
    public function testShowCallInfo()
    {
        // Setup mocks for parameters to the method under test.

        /** @var \Box\TestScribe\Method $mockMethod4 */
        $mockMethod4 = $this->shmock(
            '\\Box\\TestScribe\\Method',
            function (
                /** @var \Box\TestScribe\Method|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                // Set up mocks of return values.

                /** @var \Box\TestScribe\ClassInfo\PhpClass $mockPhpClass5 */
                $mockPhpClass5 = $this->shmock(
                    '\\Box\\TestScribe\\ClassInfo\\PhpClass',
                    function (
                        /** @var \Box\TestScribe\ClassInfo\PhpClass|\Shmock\PHPUnitMockInstance $shmock */
                        $shmock
                    ) {
                        $shmock->order_matters();
                        $shmock->disable_original_constructor();

                        // Set up mocks of return values.

                        /** @var \Box\TestScribe\PhpClassName $mockPhpClassName6 */
                        $mockPhpClassName6 = $this->shmock(
                            '\\Box\\TestScribe\\PhpClassName',
                            function (
                                /** @var \Box\TestScribe\PhpClassName|\Shmock\PHPUnitMockInstance $shmock */
                                $shmock
                            ) {
                                $shmock->order_matters();
                                $shmock->disable_original_constructor();

                                /** @var $mock \Shmock\Spec */
                                $mock = $shmock->getFullyQualifiedClassName();
                                $mock->return_value('fullName');
                            }
                        );

                        /** @var $mock \Shmock\Spec */
                        $mock = $shmock->getPhpClassName();
                        $mock->return_value($mockPhpClassName6);
                    }
                );

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getClass();
                $mock->return_value($mockPhpClass5);

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getName();
                $mock->return_value('methodFoo');
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
                'line ( line number ) Calling fullName::methodFoo( ');

                $shmock->writeln('parm info');
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

                /** @var \Box\TestScribe\Utils\CallInfo $mockCallInfo7 */
                $mockCallInfo7 = $this->shmock(
                    '\\Box\\TestScribe\\Utils\\CallInfo',
                    function (
                        /** @var \Box\TestScribe\Utils\CallInfo|\Shmock\PHPUnitMockInstance $shmock */
                        $shmock
                    ) {
                        $shmock->order_matters();
                        $shmock->disable_original_constructor();

                        /** @var $mock \Shmock\Spec */
                        $mock = $shmock->getLineNumberString();
                        $mock->return_value('line number');
                    }
                );

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getCallerInfoAt(7);
                $mock->return_value($mockCallInfo7);
            }
        );

        /** @var \Box\TestScribe\MethodCallInfo $mockMethodCallInfo3 */
        $mockMethodCallInfo3 = $this->shmock(
            '\\Box\\TestScribe\\MethodCallInfo',
            function (
                /** @var \Box\TestScribe\MethodCallInfo|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getCallParamInfo();
                $mock->return_value('parm info');
            }
        );

        $objectUnderTest = new Mock\MockClassServiceCallInfo($mockOutput1, $mockCallInformationCollector2, $mockMethodCallInfo3);

        $objectUnderTest->showCallInfo($mockMethod4, ['arg']);
    }
}
