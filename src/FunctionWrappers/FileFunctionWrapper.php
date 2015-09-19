<?php
/**
 *
 */

namespace Box\TestScribe\FunctionWrappers;

use Box\TestScribe\Exception\TestScribeException;

/**
 * File and directory global function wrappers
 *
 * Since file and directory functions are typically used together
 * they are grouped into the same class.
 */
class FileFunctionWrapper
{
    /**
     * Read the entire file content
     *
     * @param string $filename
     * @return string
     */
    public function file_get_all_contents($filename)
    {
        $content = file_get_contents($filename);

        return $content;
    }

    /**
     * (PHP 5)<br/>
     * Write a string to a file.
     *
     * Overwrite the existing content if it exists.
     * This method does NOT create directories if
     * they don't exist. It will throw an exception in that case.
     *
     * @link http://php.net/manual/en/function.file-put-contents.php
     * @param string $filename <p>
     * Path to the file where to write the data.
     * </p>
     * @param string $data <p>
     * The data to write.
     * </p>
     * data is written in text mode. If unicode
     * semantics are enabled, the default encoding is UTF-8.
     * </td>
     * </tr>
     * </p>
     * @return int The function returns the number of bytes that were written to the file
     * @exception TestScribeException
     */
    function file_put_contents($filename, $data)
    {
        // Suppress the PHP warning since we
        // handle the failure explicitly.
        $rc = file_put_contents($filename, $data);

        if ($rc === false) {
            $msg = "Failed to write to the file ( $filename ).";
            throw new TestScribeException($msg);
        }

        return $rc;
    }

    /**
     * (PHP 4, PHP 5)<br/>
     * Returns canonicalized absolute pathname
     * @link http://php.net/manual/en/function.realpath.php
     *
     * @param string $path <p>
     * The path being checked.
     * </p>
     *
     * @return string the canonicalized absolute pathname on success. The resulting path
     * will have no symbolic link, '/./' or '/../' components.
     * </p>
     * <p>
     * realpath throw an exception on failure, e.g. if
     * the file does not exist.
     */
    function realpath($path)
    {
        $result = realpath($path);
        if ($result === false) {
            $errMsg = "Called realpath with invalid path ( $path ).";
            throw new TestScribeException($errMsg);
        }

        return $result;
    }

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
     * @param string $pathname <p>
     * The directory path.
     * </p>
     * @param int $mode [optional] <p>
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
     * @param bool $recursive [optional] <p>
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
