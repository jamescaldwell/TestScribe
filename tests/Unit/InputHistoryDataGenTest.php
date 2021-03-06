<?php
namespace Box\TestScribe;

/**
 * Generated by TestScribe.
 */
class InputHistoryDataGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers Box\TestScribe\InputHistory\InputHistoryData::jsonSerialize
     */
    public function testJsonSerialize()
    {

        // Execute the method under test.

        $objectUnderTest = new InputHistory\InputHistoryData();
        $executionResult = $objectUnderTest->jsonSerialize();

        // Validate the execution result.

        $this->assertInternalType('array', $executionResult);
        $this->assertCount(0, $executionResult);
    }

    /**
     * @covers Box\TestScribe\InputHistory\InputHistoryData::getInputStringFromHistory
     */
    public function testGetInputStringFromHistoryNonExistingItem()
    {

        // Execute the method under test.

        $objectUnderTest = new InputHistory\InputHistoryData();
        $executionResult = $objectUnderTest->getInputStringFromHistory('section', 'item');

        // Validate the execution result.

        $expected = '';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }
}
