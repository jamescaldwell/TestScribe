<?php
namespace Box\TestScribe\Renderers;

/**
 * Generated by TestScribe.
 */
class InjectedMockClassesRendererGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers \Box\TestScribe\Renderers\InjectedMockClassesRenderer::genMockedClassesStatements
     * @covers \Box\TestScribe\Renderers\InjectedMockClassesRenderer
     */
    public function testGenMockedClassesStatements_no_mock()
    {
        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Renderers\MultipleInjectedMocksRenderer $mockMultipleInjectedMocksRenderer0 */
        $mockMultipleInjectedMocksRenderer0 = $this->shmock(
            '\\Box\\TestScribe\\Renderers\\MultipleInjectedMocksRenderer',
            function (
                /** @var \Box\TestScribe\Renderers\MultipleInjectedMocksRenderer|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );

        /** @var \Box\TestScribe\Mock\InjectedMockClassMgr $mockInjectedMockClassMgr1 */
        $mockInjectedMockClassMgr1 = $this->shmock(
            '\\Box\\TestScribe\\Mock\\InjectedMockClassMgr',
            function (
                /** @var \Box\TestScribe\Mock\InjectedMockClassMgr|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getInjectedMockedClass();
                $mock->return_value([]);
            }
        );

        /** @var \Box\TestScribe\Config\GlobalComputedConfig $mockGlobalComputedConfig2 */
        $mockGlobalComputedConfig2 = $this->shmock(
            '\\Box\\TestScribe\\Config\\GlobalComputedConfig',
            function (
                /** @var \Box\TestScribe\Config\GlobalComputedConfig|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );

        $objectUnderTest = new \Box\TestScribe\Renderers\InjectedMockClassesRenderer(
            $mockMultipleInjectedMocksRenderer0, $mockInjectedMockClassMgr1, $mockGlobalComputedConfig2
        );
        $executionResult = $objectUnderTest->genMockedClassesStatements();

        // Validate the execution result.

        $expected = '';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

    /**
     * @covers \Box\TestScribe\Renderers\InjectedMockClassesRenderer::genMockedClassesStatements
     * @covers \Box\TestScribe\Renderers\InjectedMockClassesRenderer
     */
    public function testGenMockedClassesStatements()
    {
        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Renderers\MultipleInjectedMocksRenderer $mockMultipleInjectedMocksRenderer0 */
        $mockMultipleInjectedMocksRenderer0 = $this->shmock(
            '\\Box\\TestScribe\\Renderers\\MultipleInjectedMocksRenderer',
            function (
                /** @var \Box\TestScribe\Renderers\MultipleInjectedMocksRenderer|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->genInjectionStatements(
                    array(
                        0 => 'mocks',
                    ),
                    'inject_class_method_name'
                );
                $mock->return_value('inject mock classes statements');
            }
        );

        /** @var \Box\TestScribe\Mock\InjectedMockClassMgr $mockInjectedMockClassMgr1 */
        $mockInjectedMockClassMgr1 = $this->shmock(
            '\\Box\\TestScribe\\Mock\\InjectedMockClassMgr',
            function (
                /** @var \Box\TestScribe\Mock\InjectedMockClassMgr|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getInjectedMockedClass();
                $mock->return_value(['mocks']);
            }
        );

        /** @var \Box\TestScribe\Config\GlobalComputedConfig $mockGlobalComputedConfig2 */
        $mockGlobalComputedConfig2 = $this->shmock(
            '\\Box\\TestScribe\\Config\\GlobalComputedConfig',
            function (
                /** @var \Box\TestScribe\Config\GlobalComputedConfig|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getInjectMockedClassMethodName();
                $mock->return_value('inject_class_method_name');
            }
        );

        $objectUnderTest = new \Box\TestScribe\Renderers\InjectedMockClassesRenderer(
            $mockMultipleInjectedMocksRenderer0, $mockInjectedMockClassMgr1, $mockGlobalComputedConfig2
        );
        $executionResult = $objectUnderTest->genMockedClassesStatements();

        // Validate the execution result.

        $expected = 'inject mock classes statements';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

    /**
     * @covers \Box\TestScribe\Renderers\InjectedMockClassesRenderer::genMockedClassesStatements
     * @covers \Box\TestScribe\Renderers\InjectedMockClassesRenderer
     */
    public function testGenMockedClassesStatements_throw_exception_when_no_injection_method_specified()
    {
        $this->setExpectedException('Box\\TestScribe\\Exception\\TestScribeException');

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Renderers\MultipleInjectedMocksRenderer $mockMultipleInjectedMocksRenderer0 */
        $mockMultipleInjectedMocksRenderer0 = $this->shmock(
            '\\Box\\TestScribe\\Renderers\\MultipleInjectedMocksRenderer',
            function (
                /** @var \Box\TestScribe\Renderers\MultipleInjectedMocksRenderer|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );

        /** @var \Box\TestScribe\Mock\InjectedMockClassMgr $mockInjectedMockClassMgr1 */
        $mockInjectedMockClassMgr1 = $this->shmock(
            '\\Box\\TestScribe\\Mock\\InjectedMockClassMgr',
            function (
                /** @var \Box\TestScribe\Mock\InjectedMockClassMgr|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getInjectedMockedClass();
                $mock->return_value(['mocks']);
            }
        );

        /** @var \Box\TestScribe\Config\GlobalComputedConfig $mockGlobalComputedConfig2 */
        $mockGlobalComputedConfig2 = $this->shmock(
            '\\Box\\TestScribe\\Config\\GlobalComputedConfig',
            function (
                /** @var \Box\TestScribe\Config\GlobalComputedConfig|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getInjectMockedClassMethodName();
                $mock->return_value('');
            }
        );

        $objectUnderTest = new \Box\TestScribe\Renderers\InjectedMockClassesRenderer($mockMultipleInjectedMocksRenderer0, $mockInjectedMockClassMgr1, $mockGlobalComputedConfig2);
        $objectUnderTest->genMockedClassesStatements();
    }
}
