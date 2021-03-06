<?php

namespace Box\TestScribe\Config;

use Box\TestScribe\CLI\CmdOption;
use Box\TestScribe\FunctionWrappers\FileFunctionWrapper;
use Box\TestScribe\FunctionWrappers\FunctionWrapper;
use Box\TestScribe\Exception\TestScribeException;
use Symfony\Component\Console\Input\InputInterface;


/**
 * @var FileFunctionWrapper|FunctionWrapper
 */
class ConfigHelper
{
    const DEFAULT_CONFIG_FILE_NAME = 'test_scribe_config.yaml';

    /** @var FileFunctionWrapper */
    private $fileFunctionWrapper;

    /** @var FunctionWrapper */
    private $functionWrapper;

    /**
     * @param \Box\TestScribe\FunctionWrappers\FileFunctionWrapper $fileFunctionWrapper
     * @param \Box\TestScribe\FunctionWrappers\FunctionWrapper $functionWrapper
     */
    function __construct(
        FileFunctionWrapper $fileFunctionWrapper,
        FunctionWrapper $functionWrapper
    )
    {
        $this->fileFunctionWrapper = $fileFunctionWrapper;
        $this->functionWrapper = $functionWrapper;
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     *
     * @return void
     * @throws \Box\TestScribe\Exception\TestScribeException
     */
    public function loadBootstrapFile(InputInterface $input)
    {
        $bootstrapFile = $input->getOption(CmdOption::BOOT_STRAP_FILE_PATH_OPTION);
        if ($bootstrapFile) {
            if (!$this->fileFunctionWrapper->file_exists($bootstrapFile)) {
                $errMsg = "Bootstrap file ( $bootstrapFile ) doesn't exist.";
                throw new TestScribeException($errMsg);
            }

            $this->functionWrapper->includeFile($bootstrapFile);
        }
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     *
     * @return string
     * @throws \Box\TestScribe\Exception\TestScribeException
     */
    public function getTestRootPath(InputInterface $input)
    {
        $origTestFileRoot = (string) $input->getOption(CmdOption::TEST_SOURCE_ROOT_OPTION_NAME);
        $testFileRoot = $this->fileFunctionWrapper->realpath($origTestFileRoot);

        return $testFileRoot;
    }

    /**
     * Get source file root path
     * by finding the common ancestor directory of the test root directory
     * and the directory of the source file under test.
     *
     * @param  string $testFileRoot
     * @param  string $inSourceFilePath
     *
     * @return string
     */
    public function getSourceRoot(
        $testFileRoot,
        $inSourceFilePath
    )
    {
        // Start with test root directory since it is likely to be closer to the
        // source root directory than the source file directory.
        $dir = $testFileRoot;
        while ($dir !== '/') {
            // Check if the parent directory of the current directory
            // is a prefix of the source file path.
            $parentDir = dirname($dir);
            $position = strpos($inSourceFilePath, $parentDir);
            if ($position === 0) {
                return $parentDir;
            }
            $dir = $parentDir;
        }

        throw new TestScribeException('Failed to determine source root directory name.');
    }

    /**
     * @param string $sourceFileRoot
     * @param string $inSourceFilePath
     *
     * @return string
     * empty string if the source file is at the root of the source file root directory.
     * otherwise the relative path to the source root directory, should start with '/'.
     */
    public function getSourceFilePathRelativeToSourceRoot(
        $sourceFileRoot,
        $inSourceFilePath
    )
    {
        $inSourceFileDir = dirname($inSourceFilePath);

        // Get the relative path of the source file relative to the source root directory
        // by removing the source root directory from the source file directory path.
        $sourceFilePathRelativeToSourceRoot = str_replace($sourceFileRoot, '', $inSourceFileDir);

        return $sourceFilePathRelativeToSourceRoot;
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param string $testFileRoot
     * @param string $inSourceFile
     *
     * @return string
     * @throws \Box\TestScribe\Exception\TestScribeException
     */
    public function getSourceFileRoot(
        InputInterface $input,
        $testFileRoot,
        $inSourceFile
    )
    {
        $originalSourceFileRoot = (string) $input->getOption(CmdOption::SOURCE_ROOT_OPTION_NAME);
        if ($originalSourceFileRoot === '') {
            // Infer source file root.
            $sourceFileRoot = $this->getSourceRoot(
                $testFileRoot,
                $inSourceFile
            );
        } else {
            $sourceFileRoot = $this->fileFunctionWrapper->realpath($originalSourceFileRoot);
        }

        return $sourceFileRoot;
    }

    /**
     * @param InputInterface $input
     * @return string
     */
    public function getConfigFilePath(InputInterface $input)
    {
        $configFilePath = $input->getOption(CmdOption::CONFIG_FILE_PATH);

        if (!$configFilePath) {
            // If the option is not given in the command line,
            // null will be returned from the getOption call.
            $configFilePath = '';
            $pathPrefixToSearch = ['tests/', 'test/', ''];
            foreach ($pathPrefixToSearch as $prefix) {
                $pathCandidate = $prefix . self::DEFAULT_CONFIG_FILE_NAME;
                if ($this->fileFunctionWrapper->file_exists($pathCandidate)) {
                    $configFilePath = $pathCandidate;
                    break;
                }
            }
        }

        return $configFilePath;
    }
}
