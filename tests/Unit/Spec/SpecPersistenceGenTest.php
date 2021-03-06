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

        /** @var \Box\TestScribe\Spec\SpecsPerClass $mockSpecsPerClass */
        $mockSpecsPerClass = $this->shmock(
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

        /** @var \Box\TestScribe\FunctionWrappers\FileFunctionWrapper $mockFileFunctionWrapper */
        $mockFileFunctionWrapper = $this->shmock(
            '\\Box\\TestScribe\\FunctionWrappers\\FileFunctionWrapper',
            function (
                /** @var \Box\TestScribe\FunctionWrappers\FileFunctionWrapper|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );

        /** @var \Box\TestScribe\Spec\SpecsPerClassPersistence $mockSpecsPerClassPersistence */
        $mockSpecsPerClassPersistence = $this->shmock(
            '\\Box\\TestScribe\\Spec\\SpecsPerClassPersistence',
            function (
                /** @var \Box\TestScribe\Spec\SpecsPerClassPersistence|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->encodeSpecsPerClass();
                $mock->return_value(['spec' => 'name']);
            }
        );

        /** @var \Box\TestScribe\Utils\FileUtil $mockFileUtil */
        $mockFileUtil = $this->shmock(
            '\\Box\\TestScribe\\Utils\\FileUtil',
            function (
                /** @var \Box\TestScribe\Utils\FileUtil|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                $shmock->putContent('spec_file', 'yamlString');
            }
        );

        /** @var \Box\TestScribe\Utils\YamlUtil $mockYamlUtil */
        $mockYamlUtil = $this->shmock(
            '\\Box\\TestScribe\\Utils\\YamlUtil',
            function (
                /** @var \Box\TestScribe\Utils\YamlUtil|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->dumpToString(array (
                  'spec' => 'name',
                ));
                $mock->return_value('yamlString');
            }
        );

        $objectUnderTest = new \Box\TestScribe\Spec\SpecPersistence( $mockFileFunctionWrapper, $mockSpecsPerClassPersistence, $mockFileUtil, $mockYamlUtil);

        $objectUnderTest->writeSpec($mockSpecsPerClass, 'spec_file');
    }

    /**
     * @covers \Box\TestScribe\Spec\SpecPersistence::loadSpec
     * @covers \Box\TestScribe\Spec\SpecPersistence
     */
    public function test_loadSpec()
    {
        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\FunctionWrappers\FileFunctionWrapper $mockFileFunctionWrapper */
        $mockFileFunctionWrapper = $this->shmock(
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
            }
        );

        /** @var \Box\TestScribe\Spec\SpecsPerClassPersistence $mockSpecsPerClassPersistence */
        $mockSpecsPerClassPersistence = $this->shmock(
            '\\Box\\TestScribe\\Spec\\SpecsPerClassPersistence',
            function (
                /** @var \Box\TestScribe\Spec\SpecsPerClassPersistence|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                // Set up mocks of return values.

                /** @var \Box\TestScribe\Spec\SpecsPerClass $mockSpecsPerClass */
                $mockSpecsPerClass = $this->shmock(
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
                $mock = $shmock->loadSpecsPerClass(array (
                  'spec' => 'data',
                ));
                $mock->return_value($mockSpecsPerClass);
            }
        );

        /** @var \Box\TestScribe\Utils\FileUtil $mockFileUtil */
        $mockFileUtil = $this->shmock(
            '\\Box\\TestScribe\\Utils\\FileUtil',
            function (
                /** @var \Box\TestScribe\Utils\FileUtil|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );

        /** @var \Box\TestScribe\Utils\YamlUtil $mockYamlUtil */
        $mockYamlUtil = $this->shmock(
            '\\Box\\TestScribe\\Utils\\YamlUtil',
            function (
                /** @var \Box\TestScribe\Utils\YamlUtil|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->loadYamlFile('spec_file');
                $mock->return_value(['spec'=>'data']);
            }
        );

        $objectUnderTest = new \Box\TestScribe\Spec\SpecPersistence($mockFileFunctionWrapper, $mockSpecsPerClassPersistence, $mockFileUtil, $mockYamlUtil);

        $executionResult = $objectUnderTest->loadSpec("spec_file", 'full_class_name');

        // Validate the execution result.

        $this->assertInstanceOf(
            'Box\\TestScribe\\Spec\\SpecsPerClass',
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected type.'
        );
    }

    /**
     * @covers \Box\TestScribe\Spec\SpecPersistence::loadSpec
     * @covers \Box\TestScribe\Spec\SpecPersistence
     */
    public function test_load_non_existing_spec_file()
    {
        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\FunctionWrappers\FileFunctionWrapper $mockFileFunctionWrapper */
        $mockFileFunctionWrapper = $this->shmock(
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

        /** @var \Box\TestScribe\Spec\SpecsPerClassPersistence $mockSpecsPerClassPersistence */
        $mockSpecsPerClassPersistence = $this->shmock(
            '\\Box\\TestScribe\\Spec\\SpecsPerClassPersistence',
            function (
                /** @var \Box\TestScribe\Spec\SpecsPerClassPersistence|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );

        /** @var \Box\TestScribe\Utils\FileUtil $mockFileUtil */
        $mockFileUtil = $this->shmock(
            '\\Box\\TestScribe\\Utils\\FileUtil',
            function (
                /** @var \Box\TestScribe\Utils\FileUtil|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );

        /** @var \Box\TestScribe\Utils\YamlUtil $mockYamlUtil */
        $mockYamlUtil = $this->shmock(
            '\\Box\\TestScribe\\Utils\\YamlUtil',
            function (
                /** @var \Box\TestScribe\Utils\YamlUtil|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );

        $objectUnderTest = new \Box\TestScribe\Spec\SpecPersistence($mockFileFunctionWrapper, $mockSpecsPerClassPersistence, $mockFileUtil, $mockYamlUtil);

        $executionResult = $objectUnderTest->loadSpec("spec_file", 'full_class_name');

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
}
