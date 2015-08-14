<?php
namespace Box\TestScribe\Renderers;

/**
 * Generated by TestScribe.
 */
class MethodRendererGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers \Box\TestScribe\Renderers\MethodRenderer::renderMethod
     * @covers \Box\TestScribe\Renderers\MethodRenderer
     */
    public function testRenderMethod()
    {
        // Setup mocks for parameters to the method under test.

        /** @var \Box\TestScribe\ExecutionResult $mockExecutionResult3 */
        $mockExecutionResult3 = $this->shmock(
            '\\Box\\TestScribe\\ExecutionResult',
            function (
                /** @var \Box\TestScribe\ExecutionResult|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Config\GlobalComputedConfig $mockGlobalComputedConfig1 */
        $mockGlobalComputedConfig1 = $this->shmock(
            '\\Box\\TestScribe\\Config\\GlobalComputedConfig',
            function (
                /** @var \Box\TestScribe\Config\GlobalComputedConfig|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getMethodName();
                $mock->return_value('method_name');

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getFullClassName();
                $mock->return_value('full_class_name');

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getTestMethodName();
                $mock->return_value('test_method_name');
            }
        );

        /** @var \Box\TestScribe\Renderers\MethodBodyRenderer $mockMethodBodyRenderer2 */
        $mockMethodBodyRenderer2 = $this->shmock(
            '\\Box\\TestScribe\\Renderers\\MethodBodyRenderer',
            function (
                /** @var \Box\TestScribe\Renderers\MethodBodyRenderer|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->renderMethodBody();
                $mock->return_value("method body\nsecond line\n");
            }
        );

        $objectUnderTest = new \Box\TestScribe\Renderers\MethodRenderer($mockGlobalComputedConfig1, $mockMethodBodyRenderer2);

        $executionResult = $objectUnderTest->renderMethod($mockExecutionResult3);

        // Validate the execution result.

        $expected = '    /**' . "\n" .
        '     * @covers full_class_name::method_name' . "\n" .
        '     * @covers full_class_name' . "\n" .
        '     */' . "\n" .
        '    public function test_method_name()' . "\n" .
        '    {' . "\n" .
        '        method body' . "\n" .
        '        second line' . "\n" .
        '' . "\n" .
        '    }';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }
}
