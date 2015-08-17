<?php
namespace Box\TestScribe;

/**
 * Generated by TestScribe.
 */
class ResultDisplayGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers \Box\TestScribe\Execution\ResultDisplay::showExecutionResult
     * @covers \Box\TestScribe\Execution\ResultDisplay
     */
    public function testShowExecutionResult_no_exception()
    {
        // Setup mocks for parameters to the method under test.

        /** @var \Box\TestScribe\Execution\ExecutionResult $mockExecutionResult2 */
        $mockExecutionResult2 = $this->shmock(
            '\\Box\\TestScribe\\Execution\\ExecutionResult',
            function (
                /** @var \Box\TestScribe\Execution\ExecutionResult|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getException();
                $mock->return_value(null);

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getResultValue();
                $mock->return_value('value');
            }
        );

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Output $mockOutput0 */
        $mockOutput0 = $this->shmock(
            '\\Box\\TestScribe\\Output',
            function (
                /** @var \Box\TestScribe\Output|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                $shmock->writeln(
                    'Result from this method execution is :' . "\n" .
                    'formatted_value' . "\n" .
                    'End of the result.' . "\n" .
                    '' . "\n" .
                    'Please verify this result and the interactions with the mocks are what you expect.'
                );
            }
        );

        /** @var \Box\TestScribe\Utils\ValueFormatter $mockValueFormatter1 */
        $mockValueFormatter1 = $this->shmock(
            '\\Box\\TestScribe\\Utils\\ValueFormatter',
            function (
                /** @var \Box\TestScribe\Utils\ValueFormatter|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getReadableFormat('value');
                $mock->return_value('formatted_value');
            }
        );

        $objectUnderTest = new Execution\ResultDisplay($mockOutput0, $mockValueFormatter1);
        $objectUnderTest->showExecutionResult($mockExecutionResult2);
    }
}
