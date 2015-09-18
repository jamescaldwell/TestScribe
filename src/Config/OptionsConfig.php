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
        if ($input->hasOption(CmdOption::CONFIG_FILE_PATH)) {
            $configFilePath = $input->getOption(CmdOption::CONFIG_FILE_PATH);
        } else {
            $configFilePath = '';
        }

        $generateSpec = false;
        if ($configFilePath) {
            $data = $this->yamlUtil->loadYamlFile($configFilePath);
            $generateSpec = ArrayUtil::lookupBoolValue(self::GENERATE_SPEC_KEY, $data, false);
        }

        $this->configHelper->loadBootstrapFile($input);

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
            $generateSpec
        );

        return $inputOptions;
    }
}
