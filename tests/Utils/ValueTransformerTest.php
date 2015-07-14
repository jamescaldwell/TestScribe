<?php
namespace Box\TestScribe\Utils;

use Box\TestScribe\_fixture\MockObjectFactoryForTest;
use Box\TestScribe\InputHistoryData;

/**
 */
class ValueTransformerTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers Box\TestScribe\Utils\ValueTransformer::translateObjectsAndResourceToString
     * @covers Box\TestScribe\Utils\ValueTransformer
     */
    public function test_resource()
    {

        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\Utils\ValueTransformer();
        $file = fopen(__FILE__, "r");
        $executionResult = $objectUnderTest->translateObjectsAndResourceToString($file);
        fclose($file);

        // Validate the execution result.

        $expected = 'resource ( stream )';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

    /**
     * @covers Box\TestScribe\Utils\ValueTransformer
     */
    public function test_object_with_JsonSerializable_support()
    {

        // Execute the method under test.

        $inputHistoryData = new InputHistoryData();
        $inputHistoryData->setData(['key' => 'value']);
        $objectUnderTest = new \Box\TestScribe\Utils\ValueTransformer();
        $executionResult = $objectUnderTest->translateObjectsAndResourceToString($inputHistoryData);

        // Validate the execution result.

        $expected = '( Box\TestScribe\InputHistoryData ) object value ( {"key":"value"} )';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

    /**
     * @covers Box\TestScribe\Utils\ValueTransformer
     */
    public function test_object()
    {

        // Execute the method under test.

        $exceptionObj = new \Exception('Test');
        $objectUnderTest = new \Box\TestScribe\Utils\ValueTransformer();
        $executionResult = $objectUnderTest->translateObjectsAndResourceToString($exceptionObj);

        // Validate the execution result.

        $expected = '( Exception ) object';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }


    /**
     * @covers Box\TestScribe\Utils\ValueTransformer
     */
    public function test_object_in_array()
    {

        // Execute the method under test.

        $exceptionObj = new \Exception('Test');
        $objectUnderTest = new \Box\TestScribe\Utils\ValueTransformer();
        $executionResult = $objectUnderTest->translateObjectsAndResourceToString([$exceptionObj]);

        // Validate the execution result.

        $expected = ['( Exception ) object'];
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

    /**
     * @covers Box\TestScribe\Utils\ValueTransformer::translateObjectsAndResourceToString
     * @covers Box\TestScribe\Utils\ValueTransformer
     */
    public function test_mock_object()
    {

        // Execute the method under test.

        $inputHistoryDataMock = MockObjectFactoryForTest::getInputHistoryDataMockInstance();
        $objectUnderTest = new \Box\TestScribe\Utils\ValueTransformer();
        $executionResult = $objectUnderTest->translateObjectsAndResourceToString($inputHistoryDataMock);

        // Validate the execution result.

        $expected = 'mock object ( mockInputHistoryData0 )';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }
}
