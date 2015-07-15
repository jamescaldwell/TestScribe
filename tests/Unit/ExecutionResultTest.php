<?php
namespace Box\TestScribe;

use Box\TestScribe\_fixture\InputValueFactoryForTest;
use Box\TestScribe\_fixture\MockObjectFactoryForTest;

/**
 */
class ExecutionResultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Box\TestScribe\ExecutionResult::jsonSerialize
     * @covers Box\TestScribe\ExecutionResult
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
            'mockClassUnderTest' => '"mock object ( mockInputHistoryData0 )"',
            'resultValue' => 1,
            'exception' => "Exception (Exception) Msg ( test exception )"
        ];

        $this->assertSame($expected, $executionResult);
    }
}
