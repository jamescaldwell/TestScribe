<?php
namespace Box\TestScribe\Spec;

/**
 * Generated by TestScribe.
 */
class OneSpecPersistenceGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers \Box\TestScribe\Spec\OneSpecPersistence::loadOneSpec
     * @covers \Box\TestScribe\Spec\OneSpecPersistence
     */
    public function test_loadOneSpec()
    {
        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Spec\MockSpecPersistence $mockMockSpecPersistence */
        $mockMockSpecPersistence = $this->shmock(
            '\\Box\\TestScribe\\Spec\\MockSpecPersistence',
            function (
                /** @var \Box\TestScribe\Spec\MockSpecPersistence|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );

        $objectUnderTest = new \Box\TestScribe\Spec\OneSpecPersistence($mockMockSpecPersistence);

        $executionResult = $objectUnderTest->loadOneSpec(['name' => 'test_name', 'result' => 1, 'param' => [2]]);

        // Validate the execution result.

        $this->assertInstanceOf(
            'Box\\TestScribe\\Spec\\OneSpec',
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected type.'
        );

        $this->assertSame(
            '{}',
            json_encode($executionResult),
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );

    }

    /**
     * @covers \Box\TestScribe\Spec\OneSpecPersistence::encodeOneSpec
     * @covers \Box\TestScribe\Spec\OneSpecPersistence
     */
    public function test_encodeOneSpec()
    {
        // Setup mocks for parameters to the method under test.

        /** @var \Box\TestScribe\Spec\OneSpec $mockOneSpec */
        $mockOneSpec = $this->shmock(
            '\\Box\\TestScribe\\Spec\\OneSpec',
            function (
                /** @var \Box\TestScribe\Spec\OneSpec|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getTestName();
                $mock->return_value('test_name');

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getResult();
                $mock->return_value(1);

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getMethodParameters();
                $mock->return_value([1]);

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getConstructorParameters();
                $mock->return_value([]);

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getMockSpecs();
                $mock->return_value([]);
            }
        );

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Spec\MockSpecPersistence $mockMockSpecPersistence */
        $mockMockSpecPersistence = $this->shmock(
            '\\Box\\TestScribe\\Spec\\MockSpecPersistence',
            function (
                /** @var \Box\TestScribe\Spec\MockSpecPersistence|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );

        $objectUnderTest = new \Box\TestScribe\Spec\OneSpecPersistence($mockMockSpecPersistence);

        $executionResult = $objectUnderTest->encodeOneSpec($mockOneSpec);

        // Validate the execution result.

        $this->assertInternalType('array', $executionResult);
        $this->assertCount(3, $executionResult);
        $expected = 'test_name';
        $this->assertSame(
            $expected,
            $executionResult['name'],
            'Variable ( executionResult[\'name\'] ) doesn\'t have the expected value.'
        );
        $this->assertInternalType('array', $executionResult['param']);
        $this->assertCount(1, $executionResult['param']);
        $expected = 1;
        $this->assertSame(
            $expected,
            $executionResult['param'][0],
            'Variable ( executionResult[\'param\'][0] ) doesn\'t have the expected value.'
        );
        $expected = 1;
        $this->assertSame(
            $expected,
            $executionResult['result'],
            'Variable ( executionResult[\'result\'] ) doesn\'t have the expected value.'
        );
    }
}
