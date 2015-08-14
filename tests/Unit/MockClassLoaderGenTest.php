<?php
namespace Box\TestScribe;

/**
 * Generated by PHPUnit_test_Generator.
 */
class MockClassLoaderGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers Box\TestScribe\MockClassLoader::createAndLoadMockClass
     * @covers Box\TestScribe\MockClassLoader
     */
    public function testCreateAndLoadMockClass()
    {

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Mock\MockClassFactory $mockMockClassFactory0 */
        $mockMockClassFactory0 = $this->shmock(
            '\\Box\\TestScribe\\Mock\\MockClassFactory',
            function (
                /** @var \Box\TestScribe\Mock\MockClassFactory|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                // Set up mocks of return values.

                /** @var \Box\TestScribe\Mock\MockClass $mockMockClass3 */
                $mockMockClass3 = $this->shmock(
                    '\\Box\\TestScribe\\Mock\\MockClass',
                    function (
                        /** @var \Box\TestScribe\Mock\MockClass|\Shmock\PHPUnitMockInstance $shmock */
                        $shmock
                    ) {
                        $shmock->order_matters();
                        $shmock->disable_original_constructor();

                        /** @var $mock \Shmock\Spec */
                        $mock = $shmock->getMockObjectName();
                        $mock->return_value('mock object name');
                        $shmock->setMockClassName('mock class name');
                    }
                );

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->create('className', false, 'method_to_pass_through');
                $mock->return_value($mockMockClass3);
            }
        );
        /** @var \Box\TestScribe\ClassBuilder $mockClassBuilder1 */
        $mockClassBuilder1 = $this->shmock(
            '\\Box\\TestScribe\\ClassBuilder',
            function (
                /** @var \Box\TestScribe\ClassBuilder|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->create('mock object name', 'className', 'method_to_pass_through');
                $mock->return_value('mock class name');
            }
        );
        $objectUnderTest = new Mock\MockClassLoader($mockMockClassFactory0, $mockClassBuilder1);
        $executionResult = $objectUnderTest->createAndLoadMockClass('className', 'method_to_pass_through');

        // Validate the execution result.

        $this->assertInstanceOf(
            'Box\\TestScribe\\Mock\\MockClass',
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected type.'
        );
    }

}
