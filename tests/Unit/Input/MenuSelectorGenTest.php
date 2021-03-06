<?php
namespace Box\TestScribe\Input;

/**
 * Generated by TestScribe.
 */
class MenuSelectorGenTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers \Box\TestScribe\Input\MenuSelector::selectFromMenu
     * @covers \Box\TestScribe\Input\MenuSelector
     */
    public function test_items_in_menu()
    {
        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Input\RawInputWithPrompt $mockRawInputWithPrompt */
        $mockRawInputWithPrompt = $this->shmock(
            '\\Box\\TestScribe\\Input\\RawInputWithPrompt',
            function (
                /** @var \Box\TestScribe\Input\RawInputWithPrompt|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->getString();
                $mock->return_value(1);
            }
        );

        /** @var \Box\TestScribe\Output $mockOutput */
        $mockOutput = $this->shmock(
            '\\Box\\TestScribe\\Output',
            function (
                /** @var \Box\TestScribe\Output|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                $shmock->writeln('msg');

                $shmock->writeln('0 : item1');

                $shmock->writeln('1 : item2');
            }
        );

        $objectUnderTest = new \Box\TestScribe\Input\MenuSelector($mockRawInputWithPrompt, $mockOutput);

        $executionResult = $objectUnderTest->selectFromMenu(['item1', 'item2'], 'msg');

        // Validate the execution result.

        $expected = 1;
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

    /**
     * @covers \Box\TestScribe\Input\MenuSelector::selectFromMenu
     * @covers \Box\TestScribe\Input\MenuSelector
     */
    public function test_throw_exception_when_selecting_from_one_item_menu()
    {
        $this->setExpectedException('Box\\TestScribe\\Exception\\TestScribeException');

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Input\RawInputWithPrompt $mockRawInputWithPrompt */
        $mockRawInputWithPrompt = $this->shmock(
            '\\Box\\TestScribe\\Input\\RawInputWithPrompt',
            function (
                /** @var \Box\TestScribe\Input\RawInputWithPrompt|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );

        /** @var \Box\TestScribe\Output $mockOutput */
        $mockOutput = $this->shmock(
            '\\Box\\TestScribe\\Output',
            function (
                /** @var \Box\TestScribe\Output|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );

        $objectUnderTest = new \Box\TestScribe\Input\MenuSelector($mockRawInputWithPrompt, $mockOutput);

        $objectUnderTest->selectFromMenu(['item'], '');
    }

    /**
     * @covers \Box\TestScribe\Input\MenuSelector::selectFromMenu
     * @covers \Box\TestScribe\Input\MenuSelector
     */
    public function test_no_item()
    {
        $this->setExpectedException('Box\\TestScribe\\Exception\\TestScribeException');

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \Box\TestScribe\Input\RawInputWithPrompt $mockRawInputWithPrompt */
        $mockRawInputWithPrompt = $this->shmock(
            '\\Box\\TestScribe\\Input\\RawInputWithPrompt',
            function (
                /** @var \Box\TestScribe\Input\RawInputWithPrompt|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );

        /** @var \Box\TestScribe\Output $mockOutput */
        $mockOutput = $this->shmock(
            '\\Box\\TestScribe\\Output',
            function (
                /** @var \Box\TestScribe\Output|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );

        $objectUnderTest = new \Box\TestScribe\Input\MenuSelector($mockRawInputWithPrompt, $mockOutput);

        $objectUnderTest->selectFromMenu([], 'msg');
    }
}
