<?php
namespace Box\TestScribe\Utils;

/**
 * Test the integration of ValueFormatter class with its dependencies.
 */
class ExceptionUtilTest extends \PHPUnit_Framework_TestCase
{
    public function test_rethrowSameException()
    {
        $objectUnderTest = new ExceptionUtil();
        $ex = new \Exception('test');
        $this->setExpectedException('Box\\TestScribe\\TestScribeException', 'test');
        $objectUnderTest->rethrowSameException($ex);
    }
}
