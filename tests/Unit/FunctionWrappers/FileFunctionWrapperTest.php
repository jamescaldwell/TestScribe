<?php
namespace Box\TestScribe\FunctionWrappers;

/**
 */
class FileFunctionWrapperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $path
     *
     * @return void
     */
    private function removeDirectoryIfExist($path)
    {
        if (is_dir($path)) {
            rmdir($path);
        }
    }

    /**
     * @param string $testDir
     *
     * @return void
     */
    private function removeTestDirectories($testDir)
    {
        $this->removeDirectoryIfExist($testDir);
        $this->removeDirectoryIfExist(dirname($testDir));
    }

    public function test_mkdir_create_directories_recursively()
    {
        $tempDir = sys_get_temp_dir();
        $testDir = "$tempDir/t1/t2";
        $this->removeTestDirectories($testDir);
        $mode = 0755;
        $wrapperObj = new FileFunctionWrapper();
        $wrapperObj->mkdirRecursive($testDir, $mode);
        $this->assertTrue(is_dir($testDir));
        $actualMode = fileperms($testDir);
        $actualModeFiltered = $actualMode & 0777;
        $this->assertSame($mode, $actualModeFiltered, "Mode is not set correctly.");
        $this->removeTestDirectories($testDir);
    }

    /**
     * @return void
     * @throws \Box\TestScribe\Exception\TestScribeException
     */
    public function test_mkdir_throw_exception_when_the_directory_already_exists()
    {
        $tempDir = sys_get_temp_dir();
        $mode = 0755;
        $wrapperObj = new FileFunctionWrapper();
        $this->setExpectedException('Box\\TestScribe\\Exception\\TestScribeException');
        /** @noinspection PhpUsageOfSilenceOperatorInspection */
        @$wrapperObj->mkdirRecursive($tempDir, $mode);
    }

    /**
     * @covers \Box\TestScribe\FunctionWrappers\FileFunctionWrapper::file_put_contents
     * @covers \Box\TestScribe\FunctionWrappers\FileFunctionWrapper
     */
    public function test_file_put_contents_raise_exception_on_error()
    {
        $this->setExpectedException('Box\\TestScribe\\Exception\\TestScribeException');

        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\FunctionWrappers\FileFunctionWrapper();

        /** @noinspection PhpUsageOfSilenceOperatorInspection */
        @$objectUnderTest->file_put_contents('badpath/goodfile', 'a');
    }

    /**
     * @covers \Box\TestScribe\FunctionWrappers\FileFunctionWrapper::file_put_contents
     * @covers \Box\TestScribe\FunctionWrappers\FileFunctionWrapper
     */
    public function test_file_put_contents()
    {
        $tempFilePath = tempnam(sys_get_temp_dir(), 'testScribeTest_');

        file_put_contents($tempFilePath, 'b');

        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\FunctionWrappers\FileFunctionWrapper();

        $content = 'foo';
        $executionResult = $objectUnderTest->file_put_contents($tempFilePath, $content);

        // Validate the execution result.

        $expected = strlen($content);
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );

        // Should overwrite the existing file content.
        $fileContent = file_get_contents($tempFilePath);
        $this->assertSame($content, $fileContent);

        unlink($tempFilePath);
    }

    /**
     * @covers \Box\TestScribe\FunctionWrappers\FileFunctionWrapper
     */
    public function test_file_get_all_contents()
    {
        $tempFilePath = tempnam(sys_get_temp_dir(), 'testScribeTest_');

        $content = "some \n content";
        file_put_contents($tempFilePath, $content);

        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\FunctionWrappers\FileFunctionWrapper();

        $executionResult = $objectUnderTest->file_get_all_contents($tempFilePath);

        // Validate the execution result.

        $expected = $content;
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );

        unlink($tempFilePath);
    }

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

        $this->setExpectedException("Box\\TestScribe\\Exception\\TestScribeException");
        $objectUnderTest->realpath('foo');
    }
}
