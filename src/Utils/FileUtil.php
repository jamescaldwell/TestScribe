<?php
/**
 *
 */

namespace Box\TestScribe\Utils;

use Box\TestScribe\FunctionWrappers\FileFunctionWrapper;

/**
 * Class FileUtil
 * @package Box\TestScribe\Utils
 *
 * @var FileFunctionWrapper
 */
class FileUtil
{
    /** @var FileFunctionWrapper */
    private $fileFunctionWrapper;

    /**
     * @param \Box\TestScribe\FunctionWrappers\FileFunctionWrapper $fileFunctionWrapper
     */
    function __construct(
        FileFunctionWrapper $fileFunctionWrapper
    )
    {
        $this->fileFunctionWrapper = $fileFunctionWrapper;
    }

    /**
     * Given a directory path, check if the directory exists.
     * If not, create the directory recursively.
     *
     * @param string $directoryPath
     *
     * @return bool true if the directory doesn't exist and is created
     */
    public function createDirectoriesWhenNeeded($directoryPath)
    {
        $isCreated = false;

        if (!$this->fileFunctionWrapper->is_dir($directoryPath)) {
            // Recursively create the directory.
            // Set the mode to drwxr-xr-x
            $this->fileFunctionWrapper->mkdirRecursive(
                $directoryPath,
                0755
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

    /**
     * Write the data string to the file.
     * Create the directory in the path recursively if it doesn't exist.
     *
     * @param string $filename
     * @param string $data
     *
     * @return void
     * @exception TestScribeException
     */
    public function putContent($filename, $data)
    {
        $this->createDirectoriesWhenNeededForFile($filename);
        $this->fileFunctionWrapper->file_put_contents($filename, $data);
    }
}

