<?php
namespace Box\TestScribe;

use Box\TestScribe\_fixture\InputValueFactoryForTest;
use Box\TestScribe\_fixture\MockObjectFactoryForTest;
use Box\TestScribe\ArgumentInfo\Arguments;
use Box\TestScribe\Execution\ExecutionResult;

/**
 */
class ExecutionResultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Box\TestScribe\Execution\ExecutionResult::jsonSerialize
     * @covers Box\TestScribe\Execution\ExecutionResult
     */
    public function testJsonSerialize_mockclass_exception()
    {

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        $mockClass = MockObjectFactoryForTest::getInputHistoryDataMockClass();
        $constructorArgs = new Arguments([]);
        $inputValue = InputValueFactoryForTest::createValue('2');
        $methodArgs = new Arguments([$inputValue]);

        $objectUnderTest = new ExecutionResult(
            $constructorArgs,
            $methodArgs,
            $mockClass,
            1,
            new \Exception('test exception')
        );
        $executionResult = $objectUnderTest->jsonSerialize();

        // Validate the execution result.

        $expected = [
            'constructorArguments' => "[]",
            'methodArguments' => '["2"]',
            'mockClassUnderTest' => '"mock object ( mockInputHistoryData )"',
            'resultValue' => 1,
            'exception' => "Exception (Exception) Msg ( test exception )"
        ];

        $this->assertSame($expected, $executionResult);
    }
}
