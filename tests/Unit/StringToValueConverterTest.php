<?php
namespace Box\TestScribe;

use Box\TestScribe\_fixture\_input\User;

/**
 * Class StringToValueConverterTest
 * @package Box\TestScribe
 */
class StringToValueConverterTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Box\TestScribe\StringToValueConverter::convert
     */
    public function testConvertFloat()
    {
        $objectUnderTest = new \Box\TestScribe\StringToValueConverter();
        $executionResult = $objectUnderTest->convert('1.1', []);
        $this->assertSame(
            1.1,
            $executionResult,
            "The execution result doesn't match the expectation."
        );
    }
    
    /**
     * @covers \Box\TestScribe\StringToValueConverter::convert
     * 
     * Convert statements that reference existing objects.
     */
    public function testConvertExistingObjects()
    {
        $user0 = new User('Bob');
        $statementStr = '$user0';
        $objectUnderTest = new \Box\TestScribe\StringToValueConverter();
        $executionResult = $objectUnderTest->convert($statementStr, ['user0' => $user0]);
        $this->assertEquals(
            $user0,
            $executionResult,
            "The execution result doesn't match the expectation."
        );
    }
    
    /**
     * @covers \Box\TestScribe\StringToValueConverter::convert
     * 
     * Convert statements that reference existing objects.
     */
    public function testConvertExistingObjectsInAnArray()
    {
        $mockUser0 = new User('Bob');
        $statementStr = '["user" => $mockUser0]';
        $objectUnderTest = new \Box\TestScribe\StringToValueConverter();
        $executionResult = $objectUnderTest->convert($statementStr, ['mockUser0' => $mockUser0]);
        $this->assertEquals(
            $mockUser0,
            $executionResult['user'],
            "The execution result doesn't match the expectation."
        );
    }
    
}
