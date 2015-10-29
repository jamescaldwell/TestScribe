<?php
namespace Box\TestScribe\Renderers;

use Box\TestScribe\Exception\TestScribeException;
use Box\TestScribe\Utils\VarExporter;

/**
 * Modified from generated tests.
 */
class ExceptionRendererTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers \Box\TestScribe\Renderers\ExceptionRenderer::genExceptionExpectation
     * @covers \Box\TestScribe\Renderers\ExceptionRenderer
     */
    public function test_genExceptionExpectation_no_msg()
    {
        // Setup mocks for parameters to the method under test.

        /** @var \Box\TestScribe\Execution\ExecutionResult $mockExecutionResult1 */
        $mockExecutionResult1 = $this->shmock(
            '\\Box\\TestScribe\\Execution\\ExecutionResult',
            function (
                /** @var \Box\TestScribe\Execution\ExecutionResult|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getException();
                $mock->return_value(new TestScribeException());
            }
        );

        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\Renderers\ExceptionRenderer(new VarExporter());

        $executionResult = $objectUnderTest->genExceptionExpectation($mockExecutionResult1);

        // Validate the execution result.

        $expected = '$this->setExpectedException(\'Box\\\\TestScribe\\\\Exception\\\\TestScribeException\', \'\');';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

    /**
     * @covers \Box\TestScribe\Renderers\ExceptionRenderer::genExceptionExpectation
     * @covers \Box\TestScribe\Renderers\ExceptionRenderer
     */
    public function test_genExceptionExpectation_with_msg()
    {
        // Setup mocks for parameters to the method under test.

        /** @var \Box\TestScribe\Execution\ExecutionResult $mockExecutionResult1 */
        $mockExecutionResult1 = $this->shmock(
            '\\Box\\TestScribe\\Execution\\ExecutionResult',
            function (
                /** @var \Box\TestScribe\Execution\ExecutionResult|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getException();
                $mock->return_value(new TestScribeException("Bad!\nStop."));
            }
        );

        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\Renderers\ExceptionRenderer(new VarExporter());

        $executionResult = $objectUnderTest->genExceptionExpectation($mockExecutionResult1);

        // Validate the execution result.

        $expected = '$this->setExpectedException(\'Box\\\\TestScribe\\\\Exception\\\\TestScribeException\','
            . ' \'Bad!\' . "\\n" .'
            . "\n"
            . '\'Stop.\');';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

}
