<?php

namespace Box\TestScribe;

/**
 * @package Box\TestScribe
 *
 * Responsible for processing output command line parameters.
 */
class CmdLineOutParamHelper
{
    /**
     * @param string       $outClassName
     *      The class name may be a simple name or a fully qualified class name
     * @param PhpClassName $inPhpClassName
     *
     * @return PhpClassName
     */
    public function getOuputClassName(
        $outClassName,
        PhpClassName $inPhpClassName
    )
    {
        if (empty($outClassName)) {
            $outClassName =
                $inPhpClassName->getFullyQualifiedClassName() . 'GenTest';
        }
        $outPhpClassName = new PhpClassName($outClassName);

        return $outPhpClassName;
    }

    /**
     * Get the input history file path.
     *
     * @param string $testFileRoot
     * @param string $simpleInClassName
     * @param string $sourceFilePathRelativeToSourceRoot
     *
     * @return string
     */
    public function getInputHistoryFilePath(
        $testFileRoot,
        $simpleInClassName,
        $sourceFilePathRelativeToSourceRoot
    )
    {
        $historyFilePathRoot = $testFileRoot . DIRECTORY_SEPARATOR . 'test_generator' .
            DIRECTORY_SEPARATOR . 'history';
        $historyFilePath = $this->getPathUnderRoot(
            $historyFilePathRoot,
            $sourceFilePathRelativeToSourceRoot
        );
        $historyFilePath .=
            DIRECTORY_SEPARATOR . $simpleInClassName . '.yaml';

        return $historyFilePath;
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

        throw new \RuntimeException('Failed to determine source root directory name.');
    }
}
