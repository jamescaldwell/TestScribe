<?php

namespace Box\TestScribe\CLI;

use Box\TestScribe\App;
use Box\TestScribe\EngineStarter;
use DI\ContainerBuilder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GenerateTestCommand
 *
 * @package Box\TestScribe\CLI
 *
 * Implement the required methods required by the Sympfony framework to create a Command.
 *
 * Handle command line arguments.
 */
class GenerateTestCommand extends Command
{

    /**
     * Executes the current command.
     *
     * @param InputInterface  $input An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     *
     * @return null|integer null or 0 if everything went fine, or an error code
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Initialize dependency injection framework.
        $builder = new ContainerBuilder();
        $container = $builder->build();

        $container->set('Symfony\Component\Console\Output\OutputInterface', $output);

        // Make sure App class is initialized before calling the bootstrap script.
        // The presence of this class sends a signal to the code executing later
        // that this execution is for generating tests.
        App::setOutput($output);

        /**
         * @var EngineStarter $engineStarter
         */
        $engineStarter = $container->get("Box\\TestScribe\\EngineStarter");
        $engineStarter->configAndStart($input, $output);

        return 0;
    }

    /**
     * Configures the current command.
     *
     * @return null
     */
    protected function configure()
    {
        CmdOption::configure($this);
    }
}
