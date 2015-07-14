<?php
namespace Box\TestScribe\Utils;

/**
 * Generated by PHPUnit_test_Generator.
 */
class CallInfoGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers Box\TestScribe\Utils\CallInfo::getFileName
     */
    public function testGetFileName()
    {

        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\Utils\CallInfo('file', '10');
        $executionResult = $objectUnderTest->getFileName();

        // Validate the execution result.

        $expected = 'file';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }


    /**
     * @covers Box\TestScribe\Utils\CallInfo::getLineNumberString
     */
    public function testGetLineNumberString()
    {

        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\Utils\CallInfo('file', '10');
        $executionResult = $objectUnderTest->getLineNumberString();

        // Validate the execution result.

        $expected = '10';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }


    /**
     * @covers Box\TestScribe\Utils\CallInfo::jsonSerialize
     */
    public function testJsonSerialize()
    {

        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\Utils\CallInfo('file', '10');
        $executionResult = $objectUnderTest->jsonSerialize();

        // Validate the execution result.

        $expected = 'file';
        $this->assertSame(
            $expected,
            $executionResult['fileName'],
            'Variable ( executionResult[\'fileName\'] ) doesn\'t have the expected value.'
        );
        $expected = '10';
        $this->assertSame(
            $expected,
            $executionResult['lineNumberString'],
            'Variable ( executionResult[\'lineNumberString\'] ) doesn\'t have the expected value.'
        );
    }

}
