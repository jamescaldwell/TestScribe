<?php

namespace Box\TestScribe\Config;

use Box\TestScribe\CmdOption;
use Box\TestScribe\FunctionWrappers\FileFunctionWrapper;
use Box\TestScribe\FunctionWrappers\FunctionWrapper;
use Box\TestScribe\GeneratedTestFile;
use Box\TestScribe\GeneratorException;
use Symfony\Component\Console\Input\InputInterface;


/**
 * @var FileFunctionWrapper|FunctionWrapper
 */
class ConfigHelper
{
    /** @var FileFunctionWrapper */
    private $fileFunctionWrapper;

    /** @var FunctionWrapper */
    private $functionWrapper;

    /**
     * @param \Box\TestScribe\FunctionWrappers\FileFunctionWrapper $fileFunctionWrapper
     * @param \Box\TestScribe\FunctionWrappers\FunctionWrapper     $functionWrapper
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
     * @throws \Box\TestScribe\GeneratorException
     */
    public function loadBootstrapFile(InputInterface $input)
    {
        $bootstrapFile = $input->getOption(CmdOption::BOOT_STRAP_FILE_PATH_OPTION);
        if ($bootstrapFile) {
            if (!$this->fileFunctionWrapper->file_exists($bootstrapFile)) {
                $errMsg = "Bootstrap file ( $bootstrapFile ) doesn't exist.";
                throw new GeneratorException($errMsg);
            }

            $this->functionWrapper->includeFile($bootstrapFile);
        }
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     *
     * @return string
     * @throws \Box\TestScribe\GeneratorException
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

        throw new GeneratorException('Failed to determine source root directory name.');
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
     * Get the complete path under the given root directory.
     *
     * @param string $rootDir
     * @param string $sourceFilePathRelativeToSourceRoot
     *
     * @return string
     *   the path should not end with '/'.
     */
    public function getPathUnderRoot(
        $rootDir,
        $sourceFilePathRelativeToSourceRoot
    )
    {
        if ($sourceFilePathRelativeToSourceRoot) {
            // In this case the relative path should start with a DIRECTORY_SEPARATOR.
            $outPath = $rootDir . $sourceFilePathRelativeToSourceRoot;
        } else {
            $outPath = $rootDir;
        }

        return $outPath;
    }

    /**
     * @param \Box\TestScribe\Config\ConfigParams $inputParams
     * @param bool                                $overwriteExistingDestinationFile
     *
     * @return string
     */
    public function getOutputTestMethodName(
        ConfigParams $inputParams,
        $overwriteExistingDestinationFile
    )
    {
        $inClassName = $inputParams->getClassName();
        $methodName = $inputParams->getMethodName();
        $outTestMethodName = GeneratedTestFile::getTestName(
            $inClassName,
            $methodName,
            $overwriteExistingDestinationFile
        );

        return $outTestMethodName;
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param string                                          $testFileRoot
     * @param string                                          $inSourceFile
     *
     * @return string
     * @throws \Box\TestScribe\GeneratorException
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
}
