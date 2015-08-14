<?php
namespace Box\TestScribe;

/**
 * Generated by TestScribe.
 */
class EngineGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers \Box\TestScribe\Engine::start
     * @covers \Box\TestScribe\Engine
     */
    public function testStart()
    {
        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Execution\Runner $mockRunner1 */
        $mockRunner1 = $this->shmock(
            '\\Box\\TestScribe\\Execution\\Runner',
            function (
                /** @var \Box\TestScribe\Execution\Runner|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                // Set up mocks of return values.

                /** @var \Box\TestScribe\Execution\ExecutionResult $mockExecutionResult4 */
                $mockExecutionResult4 = $this->shmock(
                    '\\Box\\TestScribe\\Execution\\ExecutionResult',
                    function (
                        /** @var \Box\TestScribe\Execution\ExecutionResult|\Shmock\PHPUnitMockInstance $shmock */
                        $shmock
                    ) {
                        $shmock->order_matters();
                        $shmock->disable_original_constructor();
                    }
                );

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->run();
                $mock->return_value($mockExecutionResult4);
            }
        );

        /** @var \Box\TestScribe\Renderers\RendererService $mockRendererService2 */
        $mockRendererService2 = $this->shmock(
            '\\Box\\TestScribe\\Renderers\\RendererService',
            function (
                /** @var \Box\TestScribe\Renderers\RendererService|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                $shmock->render();
            }
        );

        /** @var \Box\TestScribe\InputHistory\InputHistory $mockInputHistory3 */
        $mockInputHistory3 = $this->shmock(
            '\\Box\\TestScribe\\InputHistory\\InputHistory',
            function (
                /** @var \Box\TestScribe\InputHistory\InputHistory|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                $shmock->saveHistoryToFile();
            }
        );

        $objectUnderTest = new \Box\TestScribe\Engine($mockRunner1, $mockRendererService2, $mockInputHistory3);
        $objectUnderTest->start();
    }
}
