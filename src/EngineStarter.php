<?php
/**
 *
 */

namespace Box\TestScribe;

use Box\TestScribe\CLI\Application;
use Box\TestScribe\Config\ConfigFactory;
use DI\Container;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class EngineStarter
 *
 * @package Box\TestScribe
 *
 * Configures and starts the engine.
 *
 * @var Container|Engine|ConfigFactory|AppInstance
 */
class EngineStarter
{
    /** @var Container */
    private $container;

    /** @var Engine */
    private $engine;

    /** @var ConfigFactory */
    private $configFactory;

    /** @var AppInstance */
    private $appInstance;

    /**
     * @param \DI\Container                        $container
     * @param \Box\TestScribe\Engine               $engine
     * @param \Box\TestScribe\Config\ConfigFactory $configFactory
     * @param \Box\TestScribe\AppInstance          $appInstance
     */
    function __construct(
        Container $container,
        Engine $engine,
        ConfigFactory $configFactory,
        AppInstance $appInstance
    )
    {
        $this->container = $container;
        $this->engine = $engine;
        $this->configFactory = $configFactory;
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
        InputInterface $input,
        OutputInterface $output
    )
    {
        // Output is used by the ConfigFactory.
        // It needs to be initialized before the ConfigFactory.
        $out = new Output($output);
        $this->container->set('Box\TestScribe\Output', $out);

        $startUpMsg =
            "\n"
            . "Starting the test run. Version ( " . Application::APP_VERSION . " )\n"
            . "Type character h for help when prompted for an input value.\n";
        $out->writeln($startUpMsg);

        $config = $this->configFactory->config($input, $output);
        $this->container->set('Box\\TestScribe\\Config\\GlobalComputedConfig', $config);

        App::Init($this->appInstance);

        $this->engine->start();
    }
} 
