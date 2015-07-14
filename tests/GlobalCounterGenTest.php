<?php
namespace Box\TestScribe;

/**
 * Generated by PHPUnit_test_Generator.
 */
class GlobalCounterGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers Box\TestScribe\GlobalCounter::getNextCounter
     */
    public function testGetNextCounter()
    {

        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\GlobalCounter();
        $executionResult = $objectUnderTest->getNextCounter();

        // Validate the execution result.

        $expected = 0;
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }
}
