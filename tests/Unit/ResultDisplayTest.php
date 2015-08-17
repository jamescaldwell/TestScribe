<?php
namespace Box\TestScribe;

/**
 */
class ResultDisplayTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers \Box\TestScribe\ResultDisplay::showExecutionResult
     * @covers \Box\TestScribe\ResultDisplay
     */
    public function testShowExecutionResult_exception()
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
                $mock->return_value(new \InvalidArgumentException("exception message"));
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
                    'An exception ( InvalidArgumentException ) is thrown.' . "\n" .
                    'Exception message ( exception message ).' . "\n" .
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
            }
        );

        $objectUnderTest = new Execution\ResultDisplay($mockOutput0, $mockValueFormatter1);
        $objectUnderTest->showExecutionResult($mockExecutionResult2);
    }
}
