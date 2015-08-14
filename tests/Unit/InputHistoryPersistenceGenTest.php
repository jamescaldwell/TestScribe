<?php
namespace Box\TestScribe;

/**
 * Generated by PHPUnit_test_Generator.
 */
class InputHistoryPersistenceGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers Box\TestScribe\InputHistoryPersistence::loadHistory
     */
    public function testLoadHistoryHistoryFileDoesNotExist()
    {

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Config\GlobalComputedConfig $mockGlobalComputedConfig0 */
        $mockGlobalComputedConfig0 = $this->shmock(
            '\\Box\\TestScribe\\Config\\GlobalComputedConfig',
            function (
                /** @var \Box\TestScribe\Config\GlobalComputedConfig|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getHistoryFile();
                $mock->return_value('f_history_file_path');
            }
        );
        /** @var \Box\TestScribe\Utils\DirectoryUtil $mockDirectoryUtil1 */
        $mockDirectoryUtil1 = $this->shmock(
            '\\Box\\TestScribe\\Utils\\DirectoryUtil',
            function (
                /** @var \Box\TestScribe\Utils\DirectoryUtil|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                $shmock->disable_original_constructor();

            }
        );
        /** @var \Box\TestScribe\FunctionWrappers\GlobalFunction $mockGlobalFunction2 */
        $mockGlobalFunction2 = $this->shmock(
            '\\Box\\TestScribe\\FunctionWrappers\\GlobalFunction',
            function (
                /** @var \Box\TestScribe\FunctionWrappers\GlobalFunction|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->__call('file_exists', array (
                  0 => 'f_history_file_path',
                ));
                $mock->return_value(false);
            }
        );
        $objectUnderTest = new \Box\TestScribe\InputHistoryPersistence($mockGlobalComputedConfig0, $mockDirectoryUtil1, $mockGlobalFunction2);
        $executionResult = $objectUnderTest->loadHistory();

        // Validate the execution result.

        $this->assertInstanceOf(
            'Box\\TestScribe\\InputHistory\\InputHistoryData',
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected type.'
        );
        $this->assertSame(
            '[]',
            json_encode($executionResult),
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

    /**
     * @covers Box\TestScribe\InputHistoryPersistence::loadHistory
     */
    public function testLoadHistory()
    {

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Config\GlobalComputedConfig $mockGlobalComputedConfig0 */
        $mockGlobalComputedConfig0 = $this->shmock(
            '\\Box\\TestScribe\\Config\\GlobalComputedConfig',
            function (
                /** @var \Box\TestScribe\Config\GlobalComputedConfig|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getHistoryFile();
                $mock->return_value('f_history_file_path');
            }
        );
        /** @var \Box\TestScribe\Utils\DirectoryUtil $mockDirectoryUtil1 */
        $mockDirectoryUtil1 = $this->shmock(
            '\\Box\\TestScribe\\Utils\\DirectoryUtil',
            function (
                /** @var \Box\TestScribe\Utils\DirectoryUtil|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                $shmock->disable_original_constructor();

            }
        );
        /** @var \Box\TestScribe\FunctionWrappers\GlobalFunction $mockGlobalFunction2 */
        $mockGlobalFunction2 = $this->shmock(
            '\\Box\\TestScribe\\FunctionWrappers\\GlobalFunction',
            function (
                /** @var \Box\TestScribe\FunctionWrappers\GlobalFunction|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->__call('file_exists', array (
                  0 => 'f_history_file_path',
                ));
                $mock->return_value(true);
                /** @var $mock \Shmock\Spec */
                $mock = $shmock->__call('file_get_contents', array (
                  0 => 'f_history_file_path',
                ));
                $mock->return_value("name: value");
            }
        );
        $objectUnderTest = new \Box\TestScribe\InputHistoryPersistence($mockGlobalComputedConfig0, $mockDirectoryUtil1, $mockGlobalFunction2);
        $executionResult = $objectUnderTest->loadHistory();

        // Validate the execution result.

        $this->assertInstanceOf(
            'Box\\TestScribe\\InputHistory\\InputHistoryData',
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected type.'
        );
        $this->assertSame(
            '{"name":"value"}',
            json_encode($executionResult),
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }


    /**
     * @covers Box\TestScribe\InputHistoryPersistence::saveHistory
     */
    public function testSaveHistory()
    {
        // Setup mocks for parameters to the method under test.

        /** @var \Box\TestScribe\InputHistory\InputHistoryData $mockInputHistoryData3 */
        $mockInputHistoryData3 = $this->shmock(
            '\\Box\\TestScribe\\InputHistory\\InputHistoryData',
            function (
                /** @var \Box\TestScribe\InputHistory\InputHistoryData|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getData();
                $mock->return_value(['section' => ['name' => 'value']]);
            }
        );

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Config\GlobalComputedConfig $mockGlobalComputedConfig0 */
        $mockGlobalComputedConfig0 = $this->shmock(
            '\\Box\\TestScribe\\Config\\GlobalComputedConfig',
            function (
                /** @var \Box\TestScribe\Config\GlobalComputedConfig|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getHistoryFile();
                $mock->return_value('f_history_file_path');
            }
        );
        /** @var \Box\TestScribe\Utils\DirectoryUtil $mockDirectoryUtil1 */
        $mockDirectoryUtil1 = $this->shmock(
            '\\Box\\TestScribe\\Utils\\DirectoryUtil',
            function (
                /** @var \Box\TestScribe\Utils\DirectoryUtil|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                $shmock->disable_original_constructor();

            }
        );
        /** @var \Box\TestScribe\FunctionWrappers\GlobalFunction $mockGlobalFunction2 */
        $mockGlobalFunction2 = $this->shmock(
            '\\Box\\TestScribe\\FunctionWrappers\\GlobalFunction',
            function (
                /** @var \Box\TestScribe\FunctionWrappers\GlobalFunction|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->__call('file_exists', array (
                  0 => 'f_history_file_path',
                ));
                $mock->return_value(true);
                /** @var $mock \Shmock\Spec */
                $mock = $shmock->__call('file_put_contents', array (
                  0 => 'f_history_file_path',
                  1 => "section:\n    name: value\n",
                ));
                $mock->return_value(true);
            }
        );
        $objectUnderTest = new \Box\TestScribe\InputHistoryPersistence($mockGlobalComputedConfig0, $mockDirectoryUtil1, $mockGlobalFunction2);
        $executionResult = $objectUnderTest->saveHistory($mockInputHistoryData3);

        // Validate the execution result.

        $expected = NULL;
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }


    /**
     * @covers Box\TestScribe\InputHistoryPersistence::saveHistory
     */
    public function testSaveHistoryWhenHistoryFileDoesNotExist()
    {
        // Setup mocks for parameters to the method under test.

        /** @var \Box\TestScribe\InputHistory\InputHistoryData $mockInputHistoryData3 */
        $mockInputHistoryData3 = $this->shmock(
            '\\Box\\TestScribe\\InputHistory\\InputHistoryData',
            function (
                /** @var \Box\TestScribe\InputHistory\InputHistoryData|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getData();
                $mock->return_value(['section' => ['name' => 'value']]);
            }
        );

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Config\GlobalComputedConfig $mockGlobalComputedConfig0 */
        $mockGlobalComputedConfig0 = $this->shmock(
            '\\Box\\TestScribe\\Config\\GlobalComputedConfig',
            function (
                /** @var \Box\TestScribe\Config\GlobalComputedConfig|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getHistoryFile();
                $mock->return_value('f_history_file_path');
            }
        );
        /** @var \Box\TestScribe\Utils\DirectoryUtil $mockDirectoryUtil1 */
        $mockDirectoryUtil1 = $this->shmock(
            '\\Box\\TestScribe\\Utils\\DirectoryUtil',
            function (
                /** @var \Box\TestScribe\Utils\DirectoryUtil|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->createDirectoriesWhenNeededForFile('f_history_file_path');
                $mock->return_value(true);
            }
        );
        /** @var \Box\TestScribe\FunctionWrappers\GlobalFunction $mockGlobalFunction2 */
        $mockGlobalFunction2 = $this->shmock(
            '\\Box\\TestScribe\\FunctionWrappers\\GlobalFunction',
            function (
                /** @var \Box\TestScribe\FunctionWrappers\GlobalFunction|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->__call('file_exists', array (
                  0 => 'f_history_file_path',
                ));
                $mock->return_value(false);
                /** @var $mock \Shmock\Spec */
                $mock = $shmock->__call('file_put_contents', array (
                  0 => 'f_history_file_path',
                  1 => "section:\n    name: value\n",
                ));
                $mock->return_value(true);
            }
        );
        $objectUnderTest = new \Box\TestScribe\InputHistoryPersistence($mockGlobalComputedConfig0, $mockDirectoryUtil1, $mockGlobalFunction2);
        $executionResult = $objectUnderTest->saveHistory($mockInputHistoryData3);

        // Validate the execution result.

        $expected = NULL;
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

}
