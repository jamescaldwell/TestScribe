<?php
/**
 *
 */

namespace Box\TestScribe;

use Box\TestScribe\CLI\Application;
use DI\Container;

/**
 * Class EngineStarter
 *
 * @package Box\TestScribe
 *
 * Configures and starts the engine.
 */
class EngineStarter
{
    /**
     * @var Container
     */
    private $diContainer;

    /**
     * @var Engine
     */
    private $engine;

    /**
     * @var Configurator
     */
    private $configurator;

    /**
     * @var AppInstance
     */
    private $appInstance;

    /**
     * @param \DI\Container                          $diContainer
     * @param \Box\TestScribe\Engine       $engine
     * @param \Box\TestScribe\Configurator $configurator
     * @param \Box\TestScribe\AppInstance  $appInstance
     */
    function __construct(
        \DI\Container $diContainer,
        Engine $engine,
        Configurator $configurator,
        AppInstance $appInstance
    )
    {
        $this->diContainer = $diContainer;
        $this->engine = $engine;
        $this->configurator = $configurator;
        $this->appInstance = $appInstance;
    }

    /**
     * Configure the engine and start it.
     *
     * Compute and register some information such as computed global configuration,
     * input, output etc to the DI container for easier access later to
     * lower level components.
     *
     * @param \Symfony\Component\Console\Input\InputInterface   $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return void
     */
    public function configAndStart(
        \Symfony\Component\Console\Input\InputInterface $input,
        \Symfony\Component\Console\Output\OutputInterface $output
    )
    {
        $out = new Output($output);
        $this->diContainer->set('Box\TestScribe\Output', $out);

        $startUpMsg =
            "\n"
            . "Starting the test run. Version ( " . Application::APP_VERSION . " )\n"
            . "Type character h for help when prompted for an input value.";
        $out->writeln($startUpMsg);

        $config = $this->configurator->config($input);
        $this->diContainer->set('Box\\TestScribe\\GlobalComputedConfig', $config);

        App::Init($this->appInstance);

        $this->engine->start();
    }
} 
