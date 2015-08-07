<?php
/**
 *
 */

namespace Box\TestScribe\FunctionWrappers;

/**
 * File and directory global function wrappers
 *
 * Since file and directory functions are typically used together
 * they are grouped into the same class.
 */
class FileFunctionWrapper
{
    /**
     * (PHP 4, PHP 5)<br/>
     * Checks whether a file or directory exists
     * @link http://php.net/manual/en/function.file-exists.php
     *
     * @param string $filename <p>
     * Path to the file or directory.
     * </p>
     * <p>
     * On windows, use //computername/share/filename or
     * \\computername\share\filename to check files on
     * network shares.
     * </p>
     *
     * @return bool true if the file or directory specified by
     * filename exists; false otherwise.
     * </p>
     * <p>
     * This function will return false for symlinks pointing to non-existing
     * files.
     * </p>
     * <p>
     * This function returns false for files inaccessible due to safe mode restrictions. However these
     * files still can be included if
     * they are located in safe_mode_include_dir.
     * </p>
     * <p>
     * The check is done using the real UID/GID instead of the effective one.
     */
    function file_exists($filename)
    {
        $result = file_exists($filename);

        return $result;
    }

    /**
     * (PHP 4, PHP 5)<br/>
     * Tells whether the filename is a directory
     * @link http://php.net/manual/en/function.is-dir.php
     *
     * @param string $filename <p>
     * Path to the file. If filename is a relative
     * filename, it will be checked relative to the current working
     * directory. If filename is a symbolic or hard link
     * then the link will be resolved and checked.
     * </p>
     *
     * @return bool true if the filename exists and is a directory, false
     * otherwise.
     */
    function is_dir($filename)
    {
        return is_dir($filename);
    }

    /**
     * (PHP 4, PHP 5)<br/>
     * Attempts to create the directory specified by pathname.
     * @link http://php.net/manual/en/function.mkdir.php
     *
     * @param string   $pathname <p>
     * The directory path.
     * </p>
     * @param int      $mode [optional] <p>
     * The mode is 0777 by default, which means the widest possible
     * access. For more information on modes, read the details
     * on the chmod page.
     * </p>
     * <p>
     * mode is ignored on Windows.
     * </p>
     * <p>
     * Note that you probably want to specify the mode as an octal number,
     * which means it should have a leading zero. The mode is also modified
     * by the current umask, which you can change using
     * umask().
     * </p>
     * @param bool     $recursive [optional] <p>
     * Allows the creation of nested directories specified in the pathname. Default to false.
     * </p>
     * @param resource $context [optional] &note.context-support;
     *
     * @return bool true on success or false on failure.
     */
    function mkdir($pathname, $mode = 0777, $recursive = false, $context = null)
    {
        return mkdir($pathname, $mode, $recursive, $context);
    }
}
