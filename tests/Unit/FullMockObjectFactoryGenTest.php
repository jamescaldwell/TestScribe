<?php
namespace Box\TestScribe;

/**
 * Generated by PHPUnit_test_Generator.
 */
class FullMockObjectFactoryGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers Box\TestScribe\FullMockObjectFactory::createMockObject
     * @covers Box\TestScribe\FullMockObjectFactory
     */
    public function testCreateMockObject()
    {

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\MockClassLoader $mockMockClassLoader0 */
        $mockMockClassLoader0 = $this->shmock(
            '\\Box\\TestScribe\\MockClassLoader',
            function (
                /** @var \Box\TestScribe\MockClassLoader|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                // Set up mocks of return values.

                /** @var \Box\TestScribe\Mock\MockClass $mockMockClass4 */
                $mockMockClass4 = $this->shmock(
                    '\\Box\\TestScribe\\Mock\\MockClass',
                    function (
                        /** @var \Box\TestScribe\Mock\MockClass|\Shmock\PHPUnitMockInstance $shmock */
                        $shmock
                    ) {
                        $shmock->order_matters();
                        $shmock->disable_original_constructor();

                        $shmock->setMockedDynamicClassObj(NULL);
                        /** @var $mock \Shmock\Spec */
                        $mock = $shmock->getClassNameBeingMocked();
                        $mock->return_value('class being mocked');
                        /** @var $mock \Shmock\Spec */
                        $mock = $shmock->getMockObjectName();
                        $mock->return_value('mock object name');
                    }
                );

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->createAndLoadMockClass('class name', '');
                $mock->return_value($mockMockClass4);
            }
        );
        /** @var \Box\TestScribe\Mock\MockObjectFactory $mockMockObjectFactory1 */
        $mockMockObjectFactory1 = $this->shmock(
            '\\Box\\TestScribe\\Mock\\MockObjectFactory',
            function (
                /** @var \Box\TestScribe\Mock\MockObjectFactory|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->createMockObjectFromMockClass();
                $mock->return_value(null);
            }
        );
        /** @var \Box\TestScribe\Output $mockOutput2 */
        $mockOutput2 = $this->shmock(
            '\\Box\\TestScribe\\Output',
            function (
                /** @var \Box\TestScribe\Output|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                $shmock->writeln('Mocked ( class being mocked ) id ( mock object name ).' . "\n" . '');
            }
        );
        $objectUnderTest = new \Box\TestScribe\FullMockObjectFactory($mockMockClassLoader0, $mockMockObjectFactory1, $mockOutput2);
        $executionResult = $objectUnderTest->createMockObject('class name');

        // Validate the execution result.

        $this->assertInstanceOf(
            'Box\\TestScribe\\Mock\\MockClass',
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected type.'
        );
    }
}
