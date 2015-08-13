<?php
/**
 *
 */

namespace Box\TestScribe\Config;

use Box\TestScribe\MethodHelper;
use Box\TestScribe\PhpClass;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ConfigFactory
 *
 * Calculate global configurations.
 *
 * @var InputConfig|OptionsConfig|OutputConfig|MethodHelper
 */
class ConfigFactory
{
    /** @var InputConfig */
    private $inputConfig;

    /** @var OptionsConfig */
    private $optionsConfig;

    /** @var OutputConfig */
    private $outputConfig;

    /** @var MethodHelper */
    private $methodHelper;

    /**
     * @param \Box\TestScribe\Config\InputConfig   $inputConfig
     * @param \Box\TestScribe\Config\OptionsConfig $optionsConfig
     * @param \Box\TestScribe\Config\OutputConfig  $outputConfig
     * @param \Box\TestScribe\MethodHelper         $methodHelper
     */
    function __construct(
        InputConfig $inputConfig,
        OptionsConfig $optionsConfig,
        OutputConfig $outputConfig,
        MethodHelper $methodHelper
    )
    {
        $this->inputConfig = $inputConfig;
        $this->optionsConfig = $optionsConfig;
        $this->outputConfig = $outputConfig;
        $this->methodHelper = $methodHelper;
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

        $inPhpClassName = $inputParams->getPhpClassName();
        $inPhpClass = new PhpClass($inPhpClassName);
        $methodName = $inputParams->getMethodName();
        $inMethodObj = $this->methodHelper->createFromMethodName($inPhpClass, $methodName);

        $config = new GlobalComputedConfig(
            $inputParams,
            $inMethodObj,
            $options,
            $outputParams
        );

        return $config;
    }
}
