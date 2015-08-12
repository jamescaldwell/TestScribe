<?php
namespace Box\TestScribe;

use Box\TestScribe\CLI\Application;


/**
 * Modified from the generated test.
 * Use Application::APP_VERSION instead of its value in tests to avoid
 * having to update the test each time the version number changes.
 * @todo Revisit when we support easier updates of tests using the tool.
 */
class EngineStarterTest extends \PHPUnit_Framework_TestCase
{
    use \Shmock\Shmockers;

    /**
     * @covers \Box\TestScribe\EngineStarter::configAndStart
     * @covers \Box\TestScribe\EngineStarter
     */
    public function testConfigAndStart()
    {
        // Setup mocks for parameters to the method under test.

        /** @var \Symfony\Component\Console\Input\InputInterface $mockInputInterface5 */
        $mockInputInterface5 = $this->shmock(
            '\\Symfony\\Component\\Console\\Input\\InputInterface',
            function (
                /** @var \Symfony\Component\Console\Input\InputInterface|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
                $shmock->dont_preserve_original_methods();
            }
        );

        /** @var \Symfony\Component\Console\Output\OutputInterface $mockOutputInterface6 */
        $mockOutputInterface6 = $this->shmock(
            '\\Symfony\\Component\\Console\\Output\\OutputInterface',
            function (
                /** @var \Symfony\Component\Console\Output\OutputInterface|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
                $shmock->dont_preserve_original_methods();

                $shmock->writeln('' . "\n" .
                'Starting the test run. Version ( '. Application::APP_VERSION . ' )' . "\n" .
                'Type character h for help when prompted for an input value.');
            }
        );

        // Execute the method under test.

        // Setup mocks for parameters to the constructor.

        /** @var \DI\Container $mockContainer1 */
        $mockContainer1 = $this->shmock(
            '\\DI\\Container',
            function (
                /** @var \DI\Container|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                $shmock->set();

                $shmock->set();
            }
        );

        /** @var \Box\TestScribe\Engine $mockEngine2 */
        $mockEngine2 = $this->shmock(
            '\\Box\\TestScribe\\Engine',
            function (
                /** @var \Box\TestScribe\Engine|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                $shmock->start();
            }
        );

        /** @var \Box\TestScribe\Config\ConfigFactory $mockConfigFactory3 */
        $mockConfigFactory3 = $this->shmock(
            '\\Box\\TestScribe\\Config\\ConfigFactory',
            function (
                /** @var \Box\TestScribe\Config\ConfigFactory|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();

                // Set up mocks of return values.

                /** @var \Box\TestScribe\Config\GlobalComputedConfig $mockGlobalComputedConfig7 */
                $mockGlobalComputedConfig7 = $this->shmock(
                    '\\Box\\TestScribe\\Config\\GlobalComputedConfig',
                    function (
                        /** @var \Box\TestScribe\Config\GlobalComputedConfig|\Shmock\PHPUnitMockInstance $shmock */
                        $shmock
                    ) {
                        $shmock->order_matters();
                        $shmock->disable_original_constructor();
                    }
                );

                /** @var $mock \Shmock\Spec */
                $mock = $shmock->config();
                $mock->return_value($mockGlobalComputedConfig7);
            }
        );

        /** @var \Box\TestScribe\AppInstance $mockAppInstance4 */
        $mockAppInstance4 = $this->shmock(
            '\\Box\\TestScribe\\AppInstance',
            function (
                /** @var \Box\TestScribe\AppInstance|\Shmock\PHPUnitMockInstance $shmock */
                $shmock
            ) {
                $shmock->order_matters();
                $shmock->disable_original_constructor();
            }
        );

        $objectUnderTest = new \Box\TestScribe\EngineStarter($mockContainer1, $mockEngine2, $mockConfigFactory3, $mockAppInstance4);

        $objectUnderTest->configAndStart($mockInputInterface5, $mockOutputInterface6);
    }
}
