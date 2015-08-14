<?php
namespace Box\TestScribe\Renderers;

/**
 * Generated by TestScribe.
 */
class IndentationUtilGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers Box\TestScribe\Renderers\IndentationUtil::indent
     */
    public function testIndent_multi_non_empty_lines()
    {
        $objectUnderTest = new \Box\TestScribe\Renderers\IndentationUtil();
        $executionResult = $objectUnderTest->indent(1, "ab\nc");
        $this->assertSame(
            '    ab
    c',
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value ( \'    ab
    c\' ).'
        );
    }

    /**
     * @covers \Box\TestScribe\Renderers\IndentationUtil::indent
     * @covers \Box\TestScribe\Renderers\IndentationUtil
     */
    public function testIndent_empty_string()
    {
        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\Renderers\IndentationUtil();
        $executionResult = $objectUnderTest->indent(2, '');

        // Validate the execution result.

        $expected = '';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

    /**
     * @covers \Box\TestScribe\Renderers\IndentationUtil::indent
     * @covers \Box\TestScribe\Renderers\IndentationUtil
     */
    public function testIndent_empty_lines()
    {
        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\Renderers\IndentationUtil();
        $executionResult = $objectUnderTest->indent(2, "a\n\nb");

        // Validate the execution result.

        $expected =
            '        a' . "\n" .
            '' . "\n" .
            '        b';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }
}
