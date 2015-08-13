<?php


namespace Box\TestScribe\Config;

use Box\TestScribe\CLI\CmdOption;
use Symfony\Component\Console\Input\InputInterface;


/**
 * Get other input options and calculate some additional options.
 */
class OptionsConfig
{
    /** @var ConfigHelper */
    private $configHelper;

    /**
     * @param \Box\TestScribe\Config\ConfigHelper $configHelper
     */
    function __construct(
        ConfigHelper $configHelper
    )
    {
        $this->configHelper = $configHelper;
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
            $sourceFilePathRelativeToSourceRoot
        );

        return $inputOptions;
    }
}
