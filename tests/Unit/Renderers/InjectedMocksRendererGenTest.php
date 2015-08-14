<?php
namespace Box\TestScribe\Renderers;

/**
 * Generated by TestScribe.
 */
class InjectedMocksRendererGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers \Box\TestScribe\Renderers\InjectedMocksRenderer::renderObjectInjectionStatements
     * @covers \Box\TestScribe\Renderers\InjectedMocksRenderer
     */
    public function testRenderObjectInjectionStatements_has_mocks()
    {
        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Renderers\InjectedMockObjectsRenderer $mockInjectedMockObjectsRenderer0 */
        $mockInjectedMockObjectsRenderer0 = $this->shmock(
            '\\Box\\TestScribe\\Renderers\\InjectedMockObjectsRenderer',
            function (
                /** @var \Box\TestScribe\Renderers\InjectedMockObjectsRenderer|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->genMockedObjectStatements();
                $mock->return_value('mocking code for injected objects');
            }
        );

        /** @var \Box\TestScribe\Renderers\InjectedMockClassesRenderer $mockInjectedMockClassesRenderer1 */
        $mockInjectedMockClassesRenderer1 = $this->shmock(
            '\\Box\\TestScribe\\Renderers\\InjectedMockClassesRenderer',
            function (
                /** @var \Box\TestScribe\Renderers\InjectedMockClassesRenderer|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->genMockedClassesStatements();
                $mock->return_value('mocking code for injected classes');
            }
        );

        $objectUnderTest = new \Box\TestScribe\Renderers\InjectedMocksRenderer(
            $mockInjectedMockObjectsRenderer0, $mockInjectedMockClassesRenderer1
        );
        $executionResult = $objectUnderTest->renderObjectInjectionStatements();

        // Validate the execution result.

        $expected = '// Setup mocks injected by the dependency management system.' . "\n" .
            '' . "\n" .
            'mocking code for injected objects' . "\n" .
            '' . "\n" .
            'mocking code for injected classes';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

    /**
     * @covers \Box\TestScribe\Renderers\InjectedMocksRenderer::renderObjectInjectionStatements
     * @covers \Box\TestScribe\Renderers\InjectedMocksRenderer
     */
    public function testRenderObjectInjectionStatements_no_injected_mocks()
    {
        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Renderers\InjectedMockObjectsRenderer $mockInjectedMockObjectsRenderer0 */
        $mockInjectedMockObjectsRenderer0 = $this->shmock(
            '\\Box\\TestScribe\\Renderers\\InjectedMockObjectsRenderer',
            function (
                /** @var \Box\TestScribe\Renderers\InjectedMockObjectsRenderer|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->genMockedObjectStatements();
                $mock->return_value('');
            }
        );

        /** @var \Box\TestScribe\Renderers\InjectedMockClassesRenderer $mockInjectedMockClassesRenderer1 */
        $mockInjectedMockClassesRenderer1 = $this->shmock(
            '\\Box\\TestScribe\\Renderers\\InjectedMockClassesRenderer',
            function (
                /** @var \Box\TestScribe\Renderers\InjectedMockClassesRenderer|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->genMockedClassesStatements();
                $mock->return_value('');
            }
        );

        $objectUnderTest = new \Box\TestScribe\Renderers\InjectedMocksRenderer(
            $mockInjectedMockObjectsRenderer0, $mockInjectedMockClassesRenderer1
        );
        $executionResult = $objectUnderTest->renderObjectInjectionStatements();

        // Validate the execution result.

        $expected = '';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }
}
