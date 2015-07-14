<?php
namespace Box\TestScribe\Utils;

/**
 * Generated by PHPUnit_test_Generator.
 */
class ValueFormatterHelperGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers Box\TestScribe\Utils\ValueFormatterHelper::getReadableFormatFromSimpleValue
     */
    public function testGetReadableFormatFromSimpleValue_string()
    {

        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\Utils\ValueFormatterHelper();
        $executionResult = $objectUnderTest->getReadableFormatFromSimpleValue('string');

        // Validate the execution result.

        $expected = 'string';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

    /**
     * @covers Box\TestScribe\Utils\ValueFormatterHelper::getReadableFormatFromSimpleValue
     */
    public function testGetReadableFormatFromSimpleValue_int()
    {

        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\Utils\ValueFormatterHelper();
        $executionResult = $objectUnderTest->getReadableFormatFromSimpleValue(12);

        // Validate the execution result.

        $expected = 12;
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }


    /**
     * @covers Box\TestScribe\Utils\ValueFormatterHelper::getReadableFormatFromSimpleValue
     */
    public function testGetReadableFormatFromSimpleValue_bool()
    {

        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\Utils\ValueFormatterHelper();
        $executionResult = $objectUnderTest->getReadableFormatFromSimpleValue(false);

        // Validate the execution result.

        $expected = 'false';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }


    /**
     * @covers Box\TestScribe\Utils\ValueFormatterHelper::getReadableFormatFromSimpleValue
     */
    public function testGetReadableFormatFromSimpleValue_null()
    {

        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\Utils\ValueFormatterHelper();
        $executionResult = $objectUnderTest->getReadableFormatFromSimpleValue(null);

        // Validate the execution result.

        $expected = 'NULL';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }


    /**
     * @covers Box\TestScribe\Utils\ValueFormatterHelper
     */
    public function testGetReadableFormatFromSimpleValue_array()
    {

        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\Utils\ValueFormatterHelper();
        $executionResult = $objectUnderTest->getReadableFormatFromSimpleValue([1]);

        // Validate the execution result.

        $expected = '[1]';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }


    /**
     * @covers Box\TestScribe\Utils\ValueFormatterHelper::getReadableFormatFromSimpleValue
     */
    public function testGetReadableFormatFromSimpleValue_array_with_multiple_elements()
    {

        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\Utils\ValueFormatterHelper();
        $executionResult = $objectUnderTest->getReadableFormatFromSimpleValue(['a', 1]);

        // Validate the execution result.

        $expected = '[a, 1]';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }


    /**
     * @covers Box\TestScribe\Utils\ValueFormatterHelper::getReadableFormatFromSimpleValue
     * @covers Box\TestScribe\Utils\ValueFormatterHelper
     */
    public function testGetReadableFormatFromSimpleValue_multi_level_array()
    {

        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\Utils\ValueFormatterHelper();
        $executionResult = $objectUnderTest->getReadableFormatFromSimpleValue(['level 1' => ['level 2' => 1]]);

        // Validate the execution result.

        $expected = '[level 1 => [level 2 => 1]]';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }


    /**
     * @covers Box\TestScribe\Utils\ValueFormatterHelper::getReadableFormatFromSimpleValue
     */
    public function testGetReadableFormatFromSimpleValue_float()
    {

        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\Utils\ValueFormatterHelper();
        $executionResult = $objectUnderTest->getReadableFormatFromSimpleValue(1.1);

        // Validate the execution result.

        $expected = 1.1;
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }


    /**
     * @covers Box\TestScribe\Utils\ValueFormatterHelper::getReadableFormatFromSimpleValue
     */
    public function testGetReadableFormatFromSimpleValue_mixed_associative_sequential_array()
    {

        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\Utils\ValueFormatterHelper();
        $executionResult = $objectUnderTest->getReadableFormatFromSimpleValue(['a' => [1, 2]]);

        // Validate the execution result.

        $expected = '[a => [1, 2]]';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }


    /**
     * @covers Box\TestScribe\Utils\ValueFormatterHelper::getReadableFormatFromSimpleValue
     */
    public function testGetReadableFormatFromSimpleValue_null_in_array()
    {

        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\Utils\ValueFormatterHelper();
        $executionResult = $objectUnderTest->getReadableFormatFromSimpleValue(['a' => null]);

        // Validate the execution result.

        $expected = '[a => NULL]';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

}
