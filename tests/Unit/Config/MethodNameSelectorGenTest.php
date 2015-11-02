<?php
namespace Box\TestScribe\Config;

/**
 * Generated by TestScribe.
 */
class MethodNameSelectorGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers \Box\TestScribe\Config\MethodNameSelector::selectTestMethodName
     * @covers \Box\TestScribe\Config\MethodNameSelector
     */
    public function test_exception_when_no_method_defined()
    {
        $this->setExpectedException('Box\\TestScribe\\Exception\\TestScribeException');

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\ClassInfo\ClassUtil $mockClassUtil */
        $mockClassUtil = $this->shmock(
            '\\Box\\TestScribe\\ClassInfo\\ClassUtil',
            function (
                /** @var \Box\TestScribe\ClassInfo\ClassUtil|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getMethodNames('full_class_name');
                $mock->return_value([]);
            }
        );

        /** @var \Box\TestScribe\Input\MenuSelector $mockMenuSelector */
        $mockMenuSelector = $this->shmock(
            '\\Box\\TestScribe\\Input\\MenuSelector',
            function (
                /** @var \Box\TestScribe\Input\MenuSelector|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );

        $objectUnderTest = new \Box\TestScribe\Config\MethodNameSelector($mockClassUtil, $mockMenuSelector);

        $objectUnderTest->selectTestMethodName('full_class_name');
    }

    /**
     * @covers \Box\TestScribe\Config\MethodNameSelector::selectTestMethodName
     * @covers \Box\TestScribe\Config\MethodNameSelector
     */
    public function test_select_from_methods()
    {
        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\ClassInfo\ClassUtil $mockClassUtil */
        $mockClassUtil = $this->shmock(
            '\\Box\\TestScribe\\ClassInfo\\ClassUtil',
            function (
                /** @var \Box\TestScribe\ClassInfo\ClassUtil|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getMethodNames('full_class_name');
                $mock->return_value(['t1', 't2']);
            }
        );

        /** @var \Box\TestScribe\Input\MenuSelector $mockMenuSelector */
        $mockMenuSelector = $this->shmock(
            '\\Box\\TestScribe\\Input\\MenuSelector',
            function (
                /** @var \Box\TestScribe\Input\MenuSelector|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->selectFromMenu(array (
                  0 => 't1',
                  1 => 't2',
                ));
                $mock->return_value(1);
            }
        );

        $objectUnderTest = new \Box\TestScribe\Config\MethodNameSelector($mockClassUtil, $mockMenuSelector);

        $executionResult = $objectUnderTest->selectTestMethodName('full_class_name');

        // Validate the execution result.

        $expected = 't2';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }
}