<?php
namespace Box\TestScribe\Config;

/**
 * Generated by PHPUnit_test_Generator.
 */
class ParamHelperGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers \Box\TestScribe\Config\ParamHelper::getMethodObjFromParamObj
     * @covers \Box\TestScribe\Config\ParamHelper
     */
    public function test_getMethodObjFromParamObj()
    {
        // Setup mocks for parameters to the method under test.

        /** @var \Box\TestScribe\Config\ConfigParams $mockConfigParams2 */
        $mockConfigParams2 = $this->shmock(
            '\\Box\\TestScribe\\Config\\ConfigParams',
            function (
                /** @var \Box\TestScribe\Config\ConfigParams|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                // Set up mocks of return values.

                /** @var \Box\TestScribe\PhpClassName $mockPhpClassName3 */
                $mockPhpClassName3 = $this->shmock(
                    '\\Box\\TestScribe\\PhpClassName',
                    function (
                        /** @var \Box\TestScribe\PhpClassName|\Shmock\PHPUnitMockInstance $shmock */
                        $shmock
                    ) {
                        $shmock->order_matters();
                        $shmock->disable_original_constructor();
                    }
                );

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getPhpClassName();
                $mock->return_value($mockPhpClassName3);

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getMethodName();
                $mock->return_value('method_name');
            }
        );

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\MethodHelper $mockMethodHelper1 */
        $mockMethodHelper1 = $this->shmock(
            '\\Box\\TestScribe\\MethodHelper',
            function (
                /** @var \Box\TestScribe\MethodHelper|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                // Set up mocks of return values.

                /** @var \Box\TestScribe\Method $mockMethod4 */
                $mockMethod4 = $this->shmock(
                    '\\Box\\TestScribe\\Method',
                    function (
                        /** @var \Box\TestScribe\Method|\Shmock\PHPUnitMockInstance $shmock */
                        $shmock
                    ) {
                        $shmock->order_matters();
                        $shmock->disable_original_constructor();
                    }
                );

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->createFromMethodName();
                $mock->return_value($mockMethod4);
            }
        );

        $objectUnderTest = new \Box\TestScribe\Config\ParamHelper($mockMethodHelper1);

        $executionResult = $objectUnderTest->getMethodObjFromParamObj($mockConfigParams2);

        // Validate the execution result.

        $this->assertInstanceOf(
            'Box\\TestScribe\\Method',
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected type.'
        );
    }
}