<?php
namespace Box\TestScribe\Config;

/**
 * Generated by TestScribe.
 */
class GlobalComputedConfigGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers \Box\TestScribe\Config\GlobalComputedConfig::getHistoryFile
     * @covers \Box\TestScribe\Config\GlobalComputedConfig
     */
    public function testGetHistoryFile()
    {
        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Config\ConfigParams $mockConfigParams1 */
        $mockConfigParams1 = $this->shmock(
            '\\Box\\TestScribe\\Config\\ConfigParams',
            function (
                /** @var \Box\TestScribe\Config\ConfigParams|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                // Set up mocks of return values.

                /** @var \Box\TestScribe\ClassInfo\PhpClassName $mockPhpClassName5 */
                $mockPhpClassName5 = $this->shmock(
                    '\\Box\\TestScribe\\ClassInfo\\PhpClassName',
                    function (
                        /** @var \Box\TestScribe\ClassInfo\PhpClassName|\Shmock\PHPUnitMockInstance $shmock */
                        $shmock
                    ) {
                        $shmock->order_matters();
                        $shmock->disable_original_constructor();

                        /** @var $mock \Shmock\Spec */
                        $mock = $shmock->getClassName();
                        $mock->return_value('in_class_name');
                    }
                );

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getPhpClassName();
                $mock->return_value($mockPhpClassName5);

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getSourceFile();
                $mock->return_value('in_source');
            }
        );

        /** @var \Box\TestScribe\MethodInfo\Method $mockMethod2 */
        $mockMethod2 = $this->shmock(
            '\\Box\\TestScribe\\MethodInfo\\Method',
            function (
                /** @var \Box\TestScribe\MethodInfo\Method|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );

        /** @var \Box\TestScribe\Config\Options $mockOptions3 */
        $mockOptions3 = $this->shmock(
            '\\Box\\TestScribe\\Config\\Options',
            function (
                /** @var \Box\TestScribe\Config\Options|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->isOverwriteExistingDestinationFile();
                $mock->return_value(false);

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getTestRootPath();
                $mock->return_value('test_root_path');

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getSourceFilePathRelativeToSourceRoot();
                $mock->return_value('/relative/to/root');
            }
        );

        /** @var \Box\TestScribe\Config\ConfigParams $mockConfigParams4 */
        $mockConfigParams4 = $this->shmock(
            '\\Box\\TestScribe\\Config\\ConfigParams',
            function (
                /** @var \Box\TestScribe\Config\ConfigParams|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                // Set up mocks of return values.

                /** @var \Box\TestScribe\ClassInfo\PhpClassName $mockPhpClassName6 */
                $mockPhpClassName6 = $this->shmock(
                    '\\Box\\TestScribe\\ClassInfo\\PhpClassName',
                    function (
                        /** @var \Box\TestScribe\ClassInfo\PhpClassName|\Shmock\PHPUnitMockInstance $shmock */
                        $shmock
                    ) {
                        $shmock->order_matters();
                        $shmock->disable_original_constructor();
                    }
                );

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getPhpClassName();
                $mock->return_value($mockPhpClassName6);

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getSourceFile();
                $mock->return_value('out_source');

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getMethodName();
                $mock->return_value('out_method_name');
            }
        );

        $objectUnderTest = new \Box\TestScribe\Config\GlobalComputedConfig($mockConfigParams1, $mockMethod2, $mockOptions3, $mockConfigParams4);

        $executionResult = $objectUnderTest->getHistoryFile();

        // Validate the execution result.

        $expected = 'test_root_path/test_generator/history/relative/to/root/in_class_name.yaml';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }
}
