<?php
namespace Box\TestScribe\_fixture\_input;

/**
 * Generated by PHPUnit_test_Generator.
 */
class StaticCalculatorGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers \Box\TestScribe\_fixture\_input\StaticCalculator::add
     * @covers \Box\TestScribe\_fixture\_input\StaticCalculator
     */
    public function testAdd()
    {
        // Execute the method under test.

        $executionResult = \Box\TestScribe\_fixture\_input\StaticCalculator::add(1, 2);

        // Validate the execution result.

        $expected = 3;
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }
}
