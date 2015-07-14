<?php
namespace Box\TestScribe\FunctionWrappers;

/**
 * Class StackTraceFunctionWrapperTest
 * @package Box\TestScribe\Tests\FunctionWrappers
 */
class StackTraceFunctionWrapperTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers Box\TestScribe\FunctionWrappers\StackTraceFunctionWrapper::debugBacktrace
     * 
     * Manual test because the stack trace is different during test generation.
     */
    public function testDebugBacktrace()
    {
        // Execute the method under test.

        $objectUnderTest = new StackTraceFunctionWrapper();
        $executionResult = $objectUnderTest->debugBacktrace();

        // Validate the execution result.
        
        $expected =  [
                  'line' => 22,
                  'function' => 'debugBacktrace',
                  'class' => 'Box\\TestScribe\\FunctionWrappers\\StackTraceFunctionWrapper',
                  'type' => '->',
                ];
        
        $this->assertArraySubset(
            $expected,
            $executionResult[0],
            'Variable ( executionResult[0] ) doesn\'t have the expected value.'
        );

        $fileNameInFirstFrame = $executionResult[0]['file'];
        $this->assertContains(
            'tests/FunctionWrappers/StackTraceFunctionWrapperTest.php',
            $fileNameInFirstFrame
        );

        $expected2 =  [
                  'function' => 'testDebugBacktrace',
                  'class' => "Box\\TestScribe\\FunctionWrappers\\StackTraceFunctionWrapperTest",
                  'type' => '->',
                ];

        $this->assertArraySubset(
            $expected2,
            $executionResult[1],
            'Variable ( executionResult[1] ) doesn\'t have the expected value.'
        );
    }
}
