<?php
namespace Box\TestScribe;

/**
 * Generated by PHPUnit_test_Generator.
 */
class InputWithHistoryGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers Box\TestScribe\InputWithHistory::getInputValue
     */
    public function testGetInputValueForReturnValue()
    {

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Input\RawInputWithHelp $mockRawInputWithHelp0 */
        $mockRawInputWithHelp0 = $this->shmock(
            '\\Box\\TestScribe\\Input\\RawInputWithHelp',
            function (
                /** @var \Box\TestScribe\Input\RawInputWithHelp|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getString('subject', 'lastValue');
                $mock->return_value('rawInput');
            }
        );
        /** @var \Box\TestScribe\InputHistory $mockInputHistory1 */
        $mockInputHistory1 = $this->shmock(
            '\\Box\\TestScribe\\InputHistory',
            function (
                /** @var \Box\TestScribe\InputHistory|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getInputStringFromHistory('className', 'methodName');
                $mock->return_value('lastValue');
                $shmock->setInputStringToHistory('className', 'methodName', 'rawInput');
                $shmock->saveHistoryToFile();
            }
        );
        $objectUnderTest = new \Box\TestScribe\InputWithHistory($mockRawInputWithHelp0, $mockInputHistory1);
        $executionResult = $objectUnderTest->getInputValue('subject', 'className', 'methodName', 'paramName');

        // Validate the execution result.

        $expected = 'rawInput';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

    /**
     * @covers Box\TestScribe\InputWithHistory::getInputValue
     */
    public function testGetInputValueForParameters()
    {

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Input\RawInputWithHelp $mockRawInputWithHelp0 */
        $mockRawInputWithHelp0 = $this->shmock(
            '\\Box\\TestScribe\\Input\\RawInputWithHelp',
            function (
                /** @var \Box\TestScribe\Input\RawInputWithHelp|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getString('subject', 'lastValue');
                $mock->return_value('rawInput');
            }
        );
        /** @var \Box\TestScribe\InputHistory $mockInputHistory1 */
        $mockInputHistory1 = $this->shmock(
            '\\Box\\TestScribe\\InputHistory',
            function (
                /** @var \Box\TestScribe\InputHistory|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                // Keep track of the order of calls made on this mock.
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getInputStringFromHistory('methodName', 'paramName');
                $mock->return_value('lastValue');
                $shmock->setInputStringToHistory('methodName', 'paramName', 'rawInput');
                $shmock->saveHistoryToFile();
            }
        );
        $objectUnderTest = new \Box\TestScribe\InputWithHistory($mockRawInputWithHelp0, $mockInputHistory1);
        $executionResult = $objectUnderTest->getInputValue('subject', '', 'methodName', 'paramName');

        // Validate the execution result.

        $expected = 'rawInput';
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

}
