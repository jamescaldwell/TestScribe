<?php
namespace Box\TestScribe;

/**
 * Generated by PHPUnit_test_Generator.
 */
class InputHistoryDataTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers Box\TestScribe\InputHistoryData::jsonSerialize
     */
    public function testJsonSerialize()
    {
        $objectUnderTest = new InputHistory\InputHistoryData();
        $objectUnderTest->setInputStringToHistory('s', 'i', 'a');
        $executionResult = $objectUnderTest->jsonSerialize();

        // Validate the execution result.

        $this->assertSame(['s' => ['i' => 'a']], $executionResult);
    }

    /**
     * @covers Box\TestScribe\InputHistoryData::getData
     */
    public function testGetData()
    {
        $objectUnderTest = new InputHistory\InputHistoryData();
        $objectUnderTest->setInputStringToHistory('s', 'i', 'a');
        $executionResult = $objectUnderTest->getData();

        // Validate the execution result.

        $this->assertSame(['s' => ['i' => 'a']], $executionResult);
    }
    
    /**
     * @covers Box\TestScribe\InputHistoryData::setInputStringToHistory
     * @covers Box\TestScribe\InputHistoryData::getInputStringFromHistory
     */
    public function testGetInputStringFromHistory()
    {

        // Execute the method under test.

        $objectUnderTest = new InputHistory\InputHistoryData();
        $objectUnderTest->setInputStringToHistory('s', 'i', 'a');

        // Validate the execution result.
        $value = $objectUnderTest->getInputStringFromHistory('s', 'i');
        $this->assertSame('a', $value);

        // return '' for non existing items
        $value = $objectUnderTest->getInputStringFromHistory('none', 'i');
        $this->assertSame('', $value);

        $value = $objectUnderTest->getInputStringFromHistory('s', 'none');
        $this->assertSame('', $value);
    }
    
    /**
     * @covers Box\TestScribe\InputHistoryData::setData
     */
    public function testSetData()
    {

        // Execute the method under test.

        $objectUnderTest = new InputHistory\InputHistoryData();
        $expected = ['a' => 'foo'];
        $objectUnderTest->setData($expected);

        // Validate the execution result.
        $executionResult = $objectUnderTest->getData();
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }
    
}
