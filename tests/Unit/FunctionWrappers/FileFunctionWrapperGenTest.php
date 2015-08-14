<?php
namespace Box\TestScribe\FunctionWrappers;

/**
 * Generated by TestScribe.
 */
class FileFunctionWrapperGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers \Box\TestScribe\FunctionWrappers\FileFunctionWrapper::file_exists
     * @covers \Box\TestScribe\FunctionWrappers\FileFunctionWrapper
     */
    public function testFile_exists_negative()
    {
        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\FunctionWrappers\FileFunctionWrapper();

        $executionResult = $objectUnderTest->file_exists('foo');

        // Validate the execution result.

        $expected = false;
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }
}
