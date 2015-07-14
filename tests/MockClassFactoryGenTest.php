<?php
namespace Box\TestScribe;

/**
 * Generated by PHPUnit_test_Generator.
 */
class MockClassFactoryGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers Box\TestScribe\MockClassFactory::create
     * @covers Box\TestScribe\MockClassFactory
     */
    public function testCreate()
    {

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\MockClassService $mockMockClassService0 */
        $mockMockClassService0 = $this->shmock(
            '\\Box\\TestScribe\\MockClassService',
            function (
                /** @var \Box\TestScribe\MockClassService|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

            }
        );
        /** @var \Box\TestScribe\GlobalCounter $mockGlobalCounter1 */
        $mockGlobalCounter1 = $this->shmock(
            '\\Box\\TestScribe\\GlobalCounter',
            function (
                /** @var \Box\TestScribe\GlobalCounter|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getNextCounter();
                $mock->return_value(0);
            }
        );
        $objectUnderTest = new \Box\TestScribe\MockClassFactory($mockMockClassService0, $mockGlobalCounter1);
        $executionResult = $objectUnderTest->create('\Box\TestScribe\Output', false, 'methodToPassThrough');

        // Validate the execution result.

        $this->assertInstanceOf(
            'Box\\TestScribe\\MockClass',
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected type.'
        );
        $this->assertSame(
            '"mock object ( mockOutput0 )"',
            json_encode($executionResult),
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

}
