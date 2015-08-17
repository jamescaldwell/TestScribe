<?php


namespace Box\TestScribe\_fixture;


/**
 */
class DirectoryUtil 
{
    /**
     * Delete a file or a directory.
     *
     * @param string $target
     *
     * @return void
     */
    public static function deleteFileOrDirectory($target)
    {
        if (is_dir($target)) {
            $files = glob($target . '*', GLOB_MARK);

            foreach ($files as $file) {
                self::deleteFileOrDirectory($file);
            }
        } else if(is_file($target)) {
            unlink($target);
        }
    }
}
