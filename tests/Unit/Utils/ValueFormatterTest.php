<?php
namespace Box\TestScribe\Utils;

/**
 * Test the integration of ValueFormatter class with its dependencies.
 */
class ValueFormatterTest extends \PHPUnit_Framework_TestCase
{
    public function testGetReadableFormat_resource()
    {

        // Execute the method under test.

        $objectUnderTest = new ValueFormatter(
            new ValueTransformer(),
            new ValueFormatterHelper()
        );
        $file = fopen(__FILE__, "r");
        $executionResult = $objectUnderTest->getReadableFormat($file);
        fclose($file);

        // Validate the execution result.

        $expected = 'resource ( stream )';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }
}
