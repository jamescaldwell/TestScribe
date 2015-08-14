<?php
namespace Box\TestScribe\Renderers;

use Box\TestScribe\Exception\TestScribeException;

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
    public function test_genExceptionExpectation()
    {
        // Setup mocks for parameters to the method under test.

        /** @var \Box\TestScribe\ExecutionResult $mockExecutionResult1 */
        $mockExecutionResult1 = $this->shmock(
            '\\Box\\TestScribe\\ExecutionResult',
            function (
                /** @var \Box\TestScribe\ExecutionResult|\Shmock\PHPUnitMockInstance $shmock */
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

        $objectUnderTest = new \Box\TestScribe\Renderers\ExceptionRenderer();

        $executionResult = $objectUnderTest->genExceptionExpectation($mockExecutionResult1);

        // Validate the execution result.

        $expected = '$this->setExpectedException(\'Box\\\\TestScribe\\\\Exception\\\\TestScribeException\');';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }
}
