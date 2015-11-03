<?php
/**
 *
 */

namespace Box\TestScribe\Config;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ConfigFactory
 *
 * Calculate global configurations.
 *
 * @var InputConfig|OptionsConfig|OutputConfig|ParamHelper|ConfigHelper
 */
class ConfigFactory
{
    /** @var InputConfig */
    private $inputConfig;

    /** @var OptionsConfig */
    private $optionsConfig;

    /** @var OutputConfig */
    private $outputConfig;

    /** @var ParamHelper */
    private $paramHelper;

    /** @var ConfigHelper */
    private $configHelper;

    /**
     * @param \Box\TestScribe\Config\InputConfig   $inputConfig
     * @param \Box\TestScribe\Config\OptionsConfig $optionsConfig
     * @param \Box\TestScribe\Config\OutputConfig  $outputConfig
     * @param \Box\TestScribe\Config\ParamHelper   $paramHelper
     * @param \Box\TestScribe\Config\ConfigHelper  $configHelper
     */
    function __construct(
        InputConfig $inputConfig,
        OptionsConfig $optionsConfig,
        OutputConfig $outputConfig,
        ParamHelper $paramHelper,
        ConfigHelper $configHelper
    )
    {
        $this->inputConfig = $inputConfig;
        $this->optionsConfig = $optionsConfig;
        $this->outputConfig = $outputConfig;
        $this->paramHelper = $paramHelper;
        $this->configHelper = $configHelper;
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface   $input
     *
     * @return \Box\TestScribe\Config\GlobalComputedConfig
     */
    public function config(
        InputInterface $input
    )
    {
        // Need to load the bootstrap file first
        // This is needed to set up class auto loader so
        // that the call to select methods can load the target
        // class correctly.
        $this->configHelper->loadBootstrapFile($input);

        $inputParams = $this->inputConfig->getInputParams(
            $input
        );

        $inSourceFile = $inputParams->getSourceFile();
        $options = $this->optionsConfig->getOptions($input, $inSourceFile);

        $outputParams = $this->outputConfig->getOutputParams(
            $options,
            $inputParams
        );

        $inMethodObj = $this->paramHelper->getMethodObjFromParamObj($inputParams);

        $config = new GlobalComputedConfig(
            $inputParams,
            $inMethodObj,
            $options,
            $outputParams
        );

        return $config;
    }
}
