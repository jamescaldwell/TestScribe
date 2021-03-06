<?php
namespace Box\TestScribe\Config;

/**
 * Generated by TestScribe.
 */
class OptionsConfigGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers \Box\TestScribe\Config\OptionsConfig::getOptions
     * @covers \Box\TestScribe\Config\OptionsConfig
     */
    public function test_getOptions()
    {
        // Setup mocks for parameters to the method under test.

        /** @var \Symfony\Component\Console\Input\InputInterface $mockInputInterface */
        $mockInputInterface = $this->shmock(
            '\\Symfony\\Component\\Console\\Input\\InputInterface',
            function (
                /** @var \Symfony\Component\Console\Input\InputInterface|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
                $shmock->dont_preserve_original_methods();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getOption('overwrite-dest-file');
                $mock->return_value('config_file_path');
            }
        );

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Config\ConfigHelper $mockConfigHelper */
        $mockConfigHelper = $this->shmock(
            '\\Box\\TestScribe\\Config\\ConfigHelper',
            function (
                /** @var \Box\TestScribe\Config\ConfigHelper|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getConfigFilePath();
                $mock->return_value('config_path');

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getTestRootPath();
                $mock->return_value('test_root');

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getSourceFileRoot();
                $mock->return_value('soure_root');

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getSourceFilePathRelativeToSourceRoot('soure_root', 'input_source_file');
                $mock->return_value('/source_relative_path');
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
                $mock = $shmock->loadYamlFile('config_path');
                $mock->return_value(['generate_spec' => true]);
            }
        );

        $objectUnderTest = new \Box\TestScribe\Config\OptionsConfig($mockConfigHelper, $mockYamlUtil);

        $executionResult = $objectUnderTest->getOptions($mockInputInterface, 'input_source_file');

        // Validate the execution result.

        $this->assertInstanceOf(
            'Box\\TestScribe\\Config\\Options',
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
     * @covers \Box\TestScribe\Config\OptionsConfig::getOptions
     * @covers \Box\TestScribe\Config\OptionsConfig
     */
    public function test_getOptions_without_config_path()
    {
        // Setup mocks for parameters to the method under test.

        /** @var \Symfony\Component\Console\Input\InputInterface $mockInputInterface */
        $mockInputInterface = $this->shmock(
            '\\Symfony\\Component\\Console\\Input\\InputInterface',
            function (
                /** @var \Symfony\Component\Console\Input\InputInterface|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
                $shmock->dont_preserve_original_methods();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getOption('overwrite-dest-file');
                $mock->return_value('config_file_path');
            }
        );

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Config\ConfigHelper $mockConfigHelper */
        $mockConfigHelper = $this->shmock(
            '\\Box\\TestScribe\\Config\\ConfigHelper',
            function (
                /** @var \Box\TestScribe\Config\ConfigHelper|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getConfigFilePath();
                $mock->return_value('');

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getTestRootPath();
                $mock->return_value('test_root');

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getSourceFileRoot();
                $mock->return_value('soure_root');

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getSourceFilePathRelativeToSourceRoot('soure_root', 'input_source_file');
                $mock->return_value('/source_relative_path');
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

        $objectUnderTest = new \Box\TestScribe\Config\OptionsConfig($mockConfigHelper, $mockYamlUtil);

        $executionResult = $objectUnderTest->getOptions($mockInputInterface, 'input_source_file');

        // Validate the execution result.

        $this->assertInstanceOf(
            'Box\\TestScribe\\Config\\Options',
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
