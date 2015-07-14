<?php
namespace Box\TestScribe;

/**
 * Generated by PHPUnit_test_Generator.
 */
class classNameInStringProcessorGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers Box\TestScribe\classNameInStringProcessor::process
     * @covers Box\TestScribe\classNameInStringProcessor
     */
    public function testProcess_simple_string()
    {

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\FullMockObjectFactory $mockFullMockObjectFactory0 */
        $mockFullMockObjectFactory0 = $this->shmock(
            '\\Box\\TestScribe\\FullMockObjectFactory',
            function (
                /** @var \Box\TestScribe\FullMockObjectFactory|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

            }
        );
        $objectUnderTest = new \Box\TestScribe\classNameInStringProcessor($mockFullMockObjectFactory0);
        $executionResult = $objectUnderTest->process('simple string');

        // Validate the execution result.

        $this->assertInstanceOf(
            'Box\\TestScribe\\ExpressionWithMocks',
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected type.'
        );
        $this->assertSame(
            '{"expression":"simple string","mocks":[]}',
            json_encode($executionResult),
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }


    /**
     * @covers Box\TestScribe\classNameInStringProcessor::process
     * @covers Box\TestScribe\classNameInStringProcessor
     */
    public function testProcess_simple_class()
    {

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\FullMockObjectFactory $mockFullMockObjectFactory0 */
        $mockFullMockObjectFactory0 = $this->shmock(
            '\\Box\\TestScribe\\FullMockObjectFactory',
            function (
                /** @var \Box\TestScribe\FullMockObjectFactory|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                // Set up mocks of return values.

                /** @var \Box\TestScribe\MockClass $mockMockClass2 */
                $mockMockClass2 = $this->shmock(
                    '\\Box\\TestScribe\\MockClass',
                    function (
                        /** @var \Box\TestScribe\MockClass|\Shmock\PHPUnitMockInstance $shmock */
                        $shmock
                    ) {
                        $shmock->order_matters();
                        $shmock->disable_original_constructor();

                        /** @var $mock \Shmock\Spec */
                        $mock = $shmock->getMockObjectName();
                        $mock->return_value('mock object name');
                        /** @var $mock \Shmock\Spec */
                        $mock = $shmock->__toString();
                        $mock->return_value('mock object identify');
                    }
                );

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->createMockObject('\\Foo');
                $mock->return_value($mockMockClass2);
            }
        );
        $objectUnderTest = new \Box\TestScribe\classNameInStringProcessor($mockFullMockObjectFactory0);
        $executionResult = $objectUnderTest->process('\Foo');

        // Validate the execution result.

        $this->assertInstanceOf(
            'Box\\TestScribe\\ExpressionWithMocks',
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected type.'
        );
        $this->assertSame(
            '{"expression":"$mock object name","mocks":["mock object identify"]}',
            json_encode($executionResult),
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

    /**
     * @covers Box\TestScribe\classNameInStringProcessor::process
     * @covers Box\TestScribe\classNameInStringProcessor
     */
    public function testProcess_class_in_array()
    {

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\FullMockObjectFactory $mockFullMockObjectFactory0 */
        $mockFullMockObjectFactory0 = $this->shmock(
            '\\Box\\TestScribe\\FullMockObjectFactory',
            function (
                /** @var \Box\TestScribe\FullMockObjectFactory|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                // Set up mocks of return values.

                /** @var \Box\TestScribe\MockClass $mockMockClass2 */
                $mockMockClass2 = $this->shmock(
                    '\\Box\\TestScribe\\MockClass',
                    function (
                        /** @var \Box\TestScribe\MockClass|\Shmock\PHPUnitMockInstance $shmock */
                        $shmock
                    ) {
                        $shmock->order_matters();
                        $shmock->disable_original_constructor();

                        /** @var $mock \Shmock\Spec */
                        $mock = $shmock->getMockObjectName();
                        $mock->return_value('mock obj name');
                        /** @var $mock \Shmock\Spec */
                        $mock = $shmock->__toString();
                        $mock->return_value('mock object identify');
                    }
                );

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->createMockObject('\\Foo');
                $mock->return_value($mockMockClass2);
            }
        );
        $objectUnderTest = new \Box\TestScribe\classNameInStringProcessor($mockFullMockObjectFactory0);
        $executionResult = $objectUnderTest->process('[\Foo]');

        // Validate the execution result.

        $this->assertInstanceOf(
            'Box\\TestScribe\\ExpressionWithMocks',
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected type.'
        );
        $this->assertSame(
            '{"expression":"[$mock obj name]","mocks":["mock object identify"]}',
            json_encode($executionResult),
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

}
