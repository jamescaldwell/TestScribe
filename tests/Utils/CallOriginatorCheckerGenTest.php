<?php
namespace Box\TestScribe\Utils;

/**
 * Generated by PHPUnit_test_Generator.
 */
class CallOriginatorCheckerGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers Box\TestScribe\Utils\CallOriginatorChecker::isCallFromTheClassBeingTested
     */
    public function testIsCallFromTheClassBeingTestedTrueCase()
    {
        // Setup mocks for parameters to the constructor.

        $mockGlobalComputedConfig0 = $this->shmock(
            '\\Box\\TestScribe\\GlobalComputedConfig',
            function (
                $shmock
                /** @var \Box\TestScribe\GlobalComputedConfig|\Shmock\PHPUnitMockInstance $shmock */
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                // Mock all methods, return null by default unless overwritten by the expectations below.
                $shmock->dont_preserve_original_methods();
                $shmock->disable_original_constructor();

                $mock = $shmock->getInSourceFile();
                /** @var $mock \Shmock\Spec */
                $mock->return_value('inputFilePath');
            }
        );
        $mockCallInformationCollector1 = $this->shmock(
            '\\Box\\TestScribe\\Utils\\CallInformationCollector',
            function (
                $shmock
                /** @var \Box\TestScribe\Utils\CallInformationCollector|\Shmock\PHPUnitMockInstance $shmock */
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                // Mock all methods, return null by default unless overwritten by the expectations below.
                $shmock->dont_preserve_original_methods();
                $shmock->disable_original_constructor();

                // Set up mocks of return values.

                $mockCallInfo2 = $this->shmock(
                    '\\Box\\TestScribe\\Utils\\CallInfo',
                    function (
                        $shmock
                        /** @var \Box\TestScribe\Utils\CallInfo|\Shmock\PHPUnitMockInstance $shmock */
                    ) {
                        // Keep track of the order of calls made on this mock.
                        $shmock->order_matters();
                        // Mock all methods, return null by default unless overwritten by the expectations below.
                        $shmock->dont_preserve_original_methods();
                        $shmock->disable_original_constructor();

                        $mock = $shmock->getFileName();
                        /** @var $mock \Shmock\Spec */
                        $mock->return_value('inputFilePath');
                    }
                );

                $mock = $shmock->getCallerInfoAt(2);
                /** @var $mock \Shmock\Spec */
                $mock->return_value($mockCallInfo2);
            }
        );

        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\Utils\CallOriginatorChecker($mockGlobalComputedConfig0, $mockCallInformationCollector1);
        $executionResult = $objectUnderTest->isCallFromTheClassBeingTested(1);

        // Validate the execution result.

        $expected = true;
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

    /**
     * @covers Box\TestScribe\Utils\CallOriginatorChecker::isCallFromTheClassBeingTested
     */
    public function testIsCallFromTheClassBeingTestedFalseCase()
    {
        // Setup mocks for parameters to the constructor.

        $mockGlobalComputedConfig0 = $this->shmock(
            '\\Box\\TestScribe\\GlobalComputedConfig',
            function (
                $shmock
                /** @var \Box\TestScribe\GlobalComputedConfig|\Shmock\PHPUnitMockInstance $shmock */
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                // Mock all methods, return null by default unless overwritten by the expectations below.
                $shmock->dont_preserve_original_methods();
                $shmock->disable_original_constructor();

                $mock = $shmock->getInSourceFile();
                /** @var $mock \Shmock\Spec */
                $mock->return_value('inputFilePath');
            }
        );
        $mockCallInformationCollector1 = $this->shmock(
            '\\Box\\TestScribe\\Utils\\CallInformationCollector',
            function (
                $shmock
                /** @var \Box\TestScribe\Utils\CallInformationCollector|\Shmock\PHPUnitMockInstance $shmock */
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                // Mock all methods, return null by default unless overwritten by the expectations below.
                $shmock->dont_preserve_original_methods();
                $shmock->disable_original_constructor();

                // Set up mocks of return values.

                $mockCallInfo2 = $this->shmock(
                    '\\Box\\TestScribe\\Utils\\CallInfo',
                    function (
                        $shmock
                        /** @var \Box\TestScribe\Utils\CallInfo|\Shmock\PHPUnitMockInstance $shmock */
                    ) {
                        // Keep track of the order of calls made on this mock.
                        $shmock->order_matters();
                        // Mock all methods, return null by default unless overwritten by the expectations below.
                        $shmock->dont_preserve_original_methods();
                        $shmock->disable_original_constructor();

                        $mock = $shmock->getFileName();
                        /** @var $mock \Shmock\Spec */
                        $mock->return_value('differentPath');
                    }
                );

                $mock = $shmock->getCallerInfoAt(2);
                /** @var $mock \Shmock\Spec */
                $mock->return_value($mockCallInfo2);
            }
        );

        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\Utils\CallOriginatorChecker($mockGlobalComputedConfig0, $mockCallInformationCollector1);
        $executionResult = $objectUnderTest->isCallFromTheClassBeingTested(1);

        // Validate the execution result.

        $expected = false;
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

}
