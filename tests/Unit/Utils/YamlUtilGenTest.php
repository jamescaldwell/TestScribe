<?php
namespace Box\TestScribe\Utils;

/**
 * Generated by TestScribe.
 */
class YamlUtilGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers \Box\TestScribe\Utils\YamlUtil::loadYamlFile
     * @covers \Box\TestScribe\Utils\YamlUtil
     */
    public function test_loadYamlFile()
    {
        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\FunctionWrappers\FileFunctionWrapper $mockFileFunctionWrapper */
        $mockFileFunctionWrapper = $this->shmock(
            '\\Box\\TestScribe\\FunctionWrappers\\FileFunctionWrapper',
            function (
                /** @var \Box\TestScribe\FunctionWrappers\FileFunctionWrapper|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->file_get_all_contents('file_path');
                $mock->return_value("spec_gen: true");
            }
        );

        $objectUnderTest = new \Box\TestScribe\Utils\YamlUtil($mockFileFunctionWrapper);

        $executionResult = $objectUnderTest->loadYamlFile('file_path');

        // Validate the execution result.

        $this->assertInternalType('array', $executionResult);
        $this->assertCount(1, $executionResult);
        $expected = true;
        $this->assertSame(
            $expected,
            $executionResult['spec_gen'],
            'Variable ( executionResult[\'spec_gen\'] ) doesn\'t have the expected value.'
        );
    }

    /**
     * @covers \Box\TestScribe\Utils\YamlUtil::dumpToString
     * @covers \Box\TestScribe\Utils\YamlUtil
     */
    public function test_dumpToString()
    {
        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\FunctionWrappers\FileFunctionWrapper $mockFileFunctionWrapper */
        $mockFileFunctionWrapper = $this->shmock(
            '\\Box\\TestScribe\\FunctionWrappers\\FileFunctionWrapper',
            function (
                /** @var \Box\TestScribe\FunctionWrappers\FileFunctionWrapper|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );

        $objectUnderTest = new \Box\TestScribe\Utils\YamlUtil($mockFileFunctionWrapper);

        $executionResult = $objectUnderTest->dumpToString(['key' => 2]);

        // Validate the execution result.

        $expected = 'key: 2' . "\n" .
            '';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }
}
