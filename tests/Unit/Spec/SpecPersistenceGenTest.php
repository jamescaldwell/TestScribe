<?php
namespace Box\TestScribe\Spec;

/**
 * Generated by TestScribe.
 */
class SpecPersistenceGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers \Box\TestScribe\Spec\SpecPersistence::writeSpec
     * @covers \Box\TestScribe\Spec\SpecPersistence
     */
    public function test_writeSpec()
    {
        // Setup mocks for parameters to the method under test.

        /** @var \Box\TestScribe\Spec\SpecsPerClass $mockSpecsPerClass4 */
        $mockSpecsPerClass4 = $this->shmock(
            '\\Box\\TestScribe\\Spec\\SpecsPerClass',
            function (
                /** @var \Box\TestScribe\Spec\SpecsPerClass|\Shmock\PHPUnitMockInstance $shmock */
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
                $mock = $shmock->getSpecFilePath();
                $mock->return_value('spec_file');
            }
        );

        /** @var \Box\TestScribe\FunctionWrappers\FileFunctionWrapper $mockFileFunctionWrapper2 */
        $mockFileFunctionWrapper2 = $this->shmock(
            '\\Box\\TestScribe\\FunctionWrappers\\FileFunctionWrapper',
            function (
                /** @var \Box\TestScribe\FunctionWrappers\FileFunctionWrapper|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->file_put_contents(
                    'spec_file',
                    'full_class_name: full_class_name' . "\n" .
                    'methods:' . "\n" .
                    '  -' . "\n" .
                    '    name: method1' . "\n" .
                    '    tests:' . "\n" .
                    '      -' . "\n" .
                    '        name: test1' . "\n" .
                    '        result: 1' . "\n" .
                    '  -' . "\n" .
                    '    name: method2' . "\n" .
                    '    tests:' . "\n" .
                    '      -' . "\n" .
                    '        name: test2' . "\n" .
                    '        result: 2' . "\n" .
                    ''
                );
                $mock->return_value(2);
            }
        );

        /** @var \Box\TestScribe\Spec\SpecsPerClassPersistence $mockSpecsPerClassPersistence3 */
        $mockSpecsPerClassPersistence3 = $this->shmock(
            '\\Box\\TestScribe\\Spec\\SpecsPerClassPersistence',
            function (
                /** @var \Box\TestScribe\Spec\SpecsPerClassPersistence|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->encodeSpecsPerClass();
                $mock->return_value(
                    [
                        'full_class_name' => 'full_class_name',
                        'methods' => [
                            ['name' => 'method1', 'tests' => [['name' => 'test1', 'result' => 1]]],
                            ['name' => 'method2', 'tests' => [['name' => 'test2', 'result' => 2]]]
                        ]
                    ]
                );
            }
        );

        $objectUnderTest = new \Box\TestScribe\Spec\SpecPersistence(
            $mockGlobalComputedConfig1,
            $mockFileFunctionWrapper2,
            $mockSpecsPerClassPersistence3
        );

        $objectUnderTest->writeSpec($mockSpecsPerClass4);
    }

    /**
     * @covers \Box\TestScribe\Spec\SpecPersistence::loadSpec
     * @covers \Box\TestScribe\Spec\SpecPersistence
     */
    public function test_loadSpec_no_existing_spec_file()
    {
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
                $mock = $shmock->getSpecFilePath();
                $mock->return_value('spec_file');

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getFullClassName();
                $mock->return_value('full_class_name');
            }
        );

        /** @var \Box\TestScribe\FunctionWrappers\FileFunctionWrapper $mockFileFunctionWrapper2 */
        $mockFileFunctionWrapper2 = $this->shmock(
            '\\Box\\TestScribe\\FunctionWrappers\\FileFunctionWrapper',
            function (
                /** @var \Box\TestScribe\FunctionWrappers\FileFunctionWrapper|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->file_exists('spec_file');
                $mock->return_value(false);
            }
        );

        /** @var \Box\TestScribe\Spec\SpecsPerClassPersistence $mockSpecsPerClassPersistence3 */
        $mockSpecsPerClassPersistence3 = $this->shmock(
            '\\Box\\TestScribe\\Spec\\SpecsPerClassPersistence',
            function (
                /** @var \Box\TestScribe\Spec\SpecsPerClassPersistence|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );

        $objectUnderTest = new \Box\TestScribe\Spec\SpecPersistence($mockGlobalComputedConfig1, $mockFileFunctionWrapper2, $mockSpecsPerClassPersistence3);

        $executionResult = $objectUnderTest->loadSpec();

        // Validate the execution result.

        $this->assertInstanceOf(
            'Box\\TestScribe\\Spec\\SpecsPerClass',
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected type.'
        );

        $this->assertSame(
            '{}',
            json_encode($executionResult),
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );

    }

    /**
     * @covers \Box\TestScribe\Spec\SpecPersistence::loadSpec
     * @covers \Box\TestScribe\Spec\SpecPersistence
     */
    public function test_loadSpec_load_existing_spec_file()
    {
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
                $mock = $shmock->getSpecFilePath();
                $mock->return_value('spec_file');
            }
        );

        /** @var \Box\TestScribe\FunctionWrappers\FileFunctionWrapper $mockFileFunctionWrapper2 */
        $mockFileFunctionWrapper2 = $this->shmock(
            '\\Box\\TestScribe\\FunctionWrappers\\FileFunctionWrapper',
            function (
                /** @var \Box\TestScribe\FunctionWrappers\FileFunctionWrapper|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->file_exists('spec_file');
                $mock->return_value(true);

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->file_get_all_contents('spec_file');
                $mock->return_value("class: c\nmethods: rest");
            }
        );

        /** @var \Box\TestScribe\Spec\SpecsPerClassPersistence $mockSpecsPerClassPersistence3 */
        $mockSpecsPerClassPersistence3 = $this->shmock(
            '\\Box\\TestScribe\\Spec\\SpecsPerClassPersistence',
            function (
                /** @var \Box\TestScribe\Spec\SpecsPerClassPersistence|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                // Set up mocks of return values.

                /** @var \Box\TestScribe\Spec\SpecsPerClass $mockSpecsPerClass4 */
                $mockSpecsPerClass4 = $this->shmock(
                    '\\Box\\TestScribe\\Spec\\SpecsPerClass',
                    function (
                        /** @var \Box\TestScribe\Spec\SpecsPerClass|\Shmock\PHPUnitMockInstance $shmock */
                        $shmock
                    ) {
                        $shmock->order_matters();
                        $shmock->disable_original_constructor();
                    }
                );

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->loadSpecsPerClass(['class' => 'c', 'methods' => 'rest']);
                $mock->return_value($mockSpecsPerClass4);
            }
        );

        $objectUnderTest = new \Box\TestScribe\Spec\SpecPersistence($mockGlobalComputedConfig1, $mockFileFunctionWrapper2, $mockSpecsPerClassPersistence3);

        $executionResult = $objectUnderTest->loadSpec();

        // Validate the execution result.

        $this->assertInstanceOf(
            'Box\\TestScribe\\Spec\\SpecsPerClass',
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected type.'
        );
    }
}
