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
 * @var InputConfig|OptionsConfig|OutputConfig|ParamHelper
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

    /**
     * @param \Box\TestScribe\Config\InputConfig   $inputConfig
     * @param \Box\TestScribe\Config\OptionsConfig $optionsConfig
     * @param \Box\TestScribe\Config\OutputConfig  $outputConfig
     * @param \Box\TestScribe\Config\ParamHelper   $paramHelper
     */
    function __construct(
        InputConfig $inputConfig,
        OptionsConfig $optionsConfig,
        OutputConfig $outputConfig,
        ParamHelper $paramHelper
    )
    {
        $this->inputConfig = $inputConfig;
        $this->optionsConfig = $optionsConfig;
        $this->outputConfig = $outputConfig;
        $this->paramHelper = $paramHelper;
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
