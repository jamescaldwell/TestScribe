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
}
