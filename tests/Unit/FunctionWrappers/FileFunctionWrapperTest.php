<?php
namespace Box\TestScribe\FunctionWrappers;

/**
 */
class FileFunctionWrapperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Box\TestScribe\FunctionWrappers\FileFunctionWrapper::file_exists
     * @covers \Box\TestScribe\FunctionWrappers\FileFunctionWrapper
     */
    public function testFile_exists_positive()
    {
        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\FunctionWrappers\FileFunctionWrapper();

        $executionResult = $objectUnderTest->file_exists(__FILE__);

        // Validate the execution result.

        $expected = true;
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

    /**
     * @covers \Box\TestScribe\FunctionWrappers\FileFunctionWrapper::realpath
     * @covers \Box\TestScribe\FunctionWrappers\FileFunctionWrapper
     */
    public function testRealpath_regular_file()
    {
        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\FunctionWrappers\FileFunctionWrapper();

        $currentFilePath = __FILE__;

        $executionResult = $objectUnderTest->realpath($currentFilePath);

        // Validate the execution result.

        $expected = $currentFilePath;
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

    /**
     * @covers \Box\TestScribe\FunctionWrappers\FileFunctionWrapper::realpath
     * @covers \Box\TestScribe\FunctionWrappers\FileFunctionWrapper
     */
    public function testRealpath_regular_directory()
    {
        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\FunctionWrappers\FileFunctionWrapper();

        $currentDir = __DIR__;

        $executionResult = $objectUnderTest->realpath($currentDir);

        // Validate the execution result.

        $expected = $currentDir;
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

    /**
     * @covers \Box\TestScribe\FunctionWrappers\FileFunctionWrapper::realpath
     * @covers \Box\TestScribe\FunctionWrappers\FileFunctionWrapper
     *
     * The normalized form doesn't contain the trailing slash.
     */
    public function testRealpath_remove_trailing_slash_directory()
    {
        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\FunctionWrappers\FileFunctionWrapper();

        $currentDir = __DIR__;

        $dirWithSlash = $currentDir . '/';

        $executionResult = $objectUnderTest->realpath($dirWithSlash);

        // Validate the execution result.

        $expected = $currentDir;
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

    /**
     * @covers \Box\TestScribe\FunctionWrappers\FileFunctionWrapper::realpath
     * @covers \Box\TestScribe\FunctionWrappers\FileFunctionWrapper
     */
    public function testRealpath_resolve_relative_path()
    {
        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\FunctionWrappers\FileFunctionWrapper();

        $currentDir = __DIR__;

        $relativePath = $currentDir . '/..';

        $executionResult = $objectUnderTest->realpath($relativePath);

        // Validate the execution result.

        $parentDir = dirname($currentDir);
        $expected = $parentDir;
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

    /**
     * @covers \Box\TestScribe\FunctionWrappers\FileFunctionWrapper::realpath
     * @covers \Box\TestScribe\FunctionWrappers\FileFunctionWrapper
     */
    public function testRealpath_non_existing_path_throw_exception()
    {
        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\FunctionWrappers\FileFunctionWrapper();

        $this->setExpectedException("Box\\TestScribe\\TestScribeException");
        $objectUnderTest->realpath('foo');
    }
}
