<?php


namespace Box\TestScribe\Config;

use Box\TestScribe\CLI\CmdOption;
use Box\TestScribe\Utils\ArrayUtil;
use Box\TestScribe\Utils\YamlUtil;
use Symfony\Component\Console\Input\InputInterface;


/**
 * Get other input options and calculate some additional options.
 * @var ConfigHelper|YamlUtil
 */
class OptionsConfig
{
    const GENERATE_SPEC_KEY = 'generate_spec';
    const TEST_BASE_CLASS_NAME_KEY = 'test_base_class_name';
    const DEFAULT_TEST_BASE_CLASS_NAME = '\\PHPUnit_Framework_TestCase';

    /** @var ConfigHelper */
    private $configHelper;

    /** @var YamlUtil */
    private $yamlUtil;

    /**
     * @param \Box\TestScribe\Config\ConfigHelper $configHelper
     * @param \Box\TestScribe\Utils\YamlUtil $yamlUtil
     */
    function __construct(
        ConfigHelper $configHelper,
        YamlUtil $yamlUtil
    )
    {
        $this->configHelper = $configHelper;
        $this->yamlUtil = $yamlUtil;
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param string                                          $inSourceFile
     *
     * @return \Box\TestScribe\Config\Options
     */
    public function getOptions(
        InputInterface $input,
        $inSourceFile
    )
    {
        $configFilePath = $this->configHelper->getConfigFilePath($input);

        $generateSpec = false;
        $testBaseClassName = self::DEFAULT_TEST_BASE_CLASS_NAME;
        if ($configFilePath) {
            $data = $this->yamlUtil->loadYamlFile($configFilePath);
            $generateSpec = ArrayUtil::lookupBoolValue(self::GENERATE_SPEC_KEY, $data, false);
            $testBaseClassName = ArrayUtil::lookupStringValue(self::TEST_BASE_CLASS_NAME_KEY, $data, self::DEFAULT_TEST_BASE_CLASS_NAME);
        }

        $overwriteExistingDestinationFile =
            $input->getOption(CmdOption::OVERWRITE_EXISTING_DESTINATION_FILE_OPTION);

        $testFileRoot = $this->configHelper->getTestRootPath($input);

        $sourceFileRoot = $this->configHelper->getSourceFileRoot(
            $input,
            $testFileRoot,
            $inSourceFile
        );

        $sourceFilePathRelativeToSourceRoot = $this->configHelper->getSourceFilePathRelativeToSourceRoot(
            $sourceFileRoot,
            $inSourceFile
        );

        $outSourceFileDir = PathUtil::getPathUnderRoot(
            $testFileRoot,
            $sourceFilePathRelativeToSourceRoot
        );

        $inputOptions = new Options(
            $overwriteExistingDestinationFile,
            $testFileRoot,
            $sourceFileRoot,
            $outSourceFileDir,
            $sourceFilePathRelativeToSourceRoot,
            $generateSpec,
            $testBaseClassName
        );

        return $inputOptions;
    }
}
