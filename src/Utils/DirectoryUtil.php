<?php
/**
 *
 */

namespace Box\TestScribe\Utils;

use Box\TestScribe\FunctionWrappers\GlobalFunction;

/**
 * Class DirectoryUtil
 * @package Box\TestScribe\Utils
 */
class DirectoryUtil
{
    /** @var  \Box\TestScribe\FunctionWrappers\GlobalFunction */
    private $globalFunction;

    /**
     * @param \Box\TestScribe\FunctionWrappers\GlobalFunction $globalFunction
     */
    function __construct(
        GlobalFunction $globalFunction
    )
    {
        $this->globalFunction = $globalFunction;
    }

    /**
     * Given a directory path, check if the directory exists.
     * If not, create the directory.
     *
     * @param string $directoryPath
     *
     * @return bool true if the directory is created
     */
    public function createDirectoriesWhenNeeded($directoryPath)
    {
        $isCreated = false;

        if (!$this->globalFunction->is_dir($directoryPath)) {
            // Recursively create the directory.
            // Set the mode to drwxr-xr-x
            $this->globalFunction->mkdir(
                $directoryPath,
                0755,
                true
            );
            $isCreated = true;
        }

        return $isCreated;
    }

    /**
     * Given a path to a file, check if the directory exists.
     * If not, create the directory.
     *
     * @param string $filePath
     *
     * @return bool
     */
    public function createDirectoriesWhenNeededForFile($filePath)
    {
        $dirPath = pathinfo($filePath, PATHINFO_DIRNAME);
        $isCreated = $this->createDirectoriesWhenNeeded($dirPath);

        return $isCreated;
    }
}

