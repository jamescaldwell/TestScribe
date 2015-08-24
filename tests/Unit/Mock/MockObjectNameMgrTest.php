<?php
namespace Box\TestScribe\Mock;

/**
 */
class MockObjectNameMgrTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers \Box\TestScribe\Mock\MockObjectNameMgr::getMockObjectName
     * @covers \Box\TestScribe\Mock\MockObjectNameMgr
     */
    public function test_getMockObjectName_get_new_name_the_second_call()
    {
        // Execute the method under test.

        $objectUnderTest = new \Box\TestScribe\Mock\MockObjectNameMgr();

        $executionResult = $objectUnderTest->getMockObjectName('ClassName');

        // Validate the execution result.

        $expected = 'mockClassName';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );

        $executionResult = $objectUnderTest->getMockObjectName('ClassName');

        // Validate the execution result.

        $expected = 'mockClassName1';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );

        // Get mock object name for a class that hasn't been seen before
        // will return the base name without count.
        $executionResult = $objectUnderTest->getMockObjectName('AnotherClass');

        // Validate the execution result.

        $expected = 'mockAnotherClass';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );

    }
}
