<?php
namespace Box\TestScribe;

/**
 * Generated by TestScribe.
 */
class StaticMockClassFactoryGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers Box\TestScribe\Mock\StaticMockClassFactory::createAndLoadStaticMockClass
     * @covers Box\TestScribe\Mock\StaticMockClassFactory
     */
    public function testCreateAndLoadStaticMockClass()
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

                /** @var \Box\TestScribe\Mock\MockClass $mockMockClass4 */
                $mockMockClass4 = $this->shmock(
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
                    }
                );

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->create('class name', true, '');
                $mock->return_value($mockMockClass4);
            }
        );
        /** @var \Box\TestScribe\Output $mockOutput1 */
        $mockOutput1 = $this->shmock(
            '\\Box\\TestScribe\\Output',
            function (
                /** @var \Box\TestScribe\Output|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                $shmock->writeln('Mocked ( class name ) id ( mock object name ) for static methods invocation.' . "\n" . '');
            }
        );
        /** @var \Box\TestScribe\Mock\ClassBuilderStatic $mockClassBuilderStatic2 */
        $mockClassBuilderStatic2 = $this->shmock(
            '\\Box\\TestScribe\\Mock\\ClassBuilderStatic',
            function (
                /** @var \Box\TestScribe\Mock\ClassBuilderStatic|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                $shmock->create();
            }
        );
        $objectUnderTest = new Mock\StaticMockClassFactory($mockMockClassFactory0, $mockOutput1, $mockClassBuilderStatic2);
        $executionResult = $objectUnderTest->createAndLoadStaticMockClass('class name');

        // Validate the execution result.

        $this->assertInstanceOf(
            'Box\\TestScribe\\Mock\\MockClass',
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected type.'
        );
    }

}
