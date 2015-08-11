<?php


namespace Box\TestScribe\Config;

use Box\TestScribe\PhpClassName;
use Symfony\Component\Console\Input\InputInterface;


/**
 * Initialize output parameters
 * @var ConfigHelper
 */
class OutputConfig
{
    /** @var ConfigHelper */
    private $configHelper;

    /**
     * @param \Box\TestScribe\Config\ConfigHelper                  $configHelper
     */
    function __construct(
        ConfigHelper $configHelper
    )
    {
        $this->configHelper = $configHelper;
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     *
     * @param bool                                            $overwriteExistingDestinationFile
     * @param \Box\TestScribe\Config\ConfigParams             $inputParams
     *
     * @return \Box\TestScribe\Config\ConfigParams
     * @throws \Box\TestScribe\GeneratorException
     */
    public function getOutputParams(
        InputInterface $input,
        $overwriteExistingDestinationFile,
        ConfigParams $inputParams
    )
    {
        $inFullClassName = $inputParams->getFullClassName();
        $outFullClassName = $inFullClassName . 'GenTest';
        $outPhpClassName = new PhpClassName($outFullClassName);
        $outSimpleClassName = $outPhpClassName->getClassName();

        $inSourceFile = $inputParams->getSourceFile();

        $outFilePath = $this->configHelper->getOutputFilePath(
            $input,
            $outSimpleClassName,
            $inSourceFile
        );

        $outTestMethodName = $this->configHelper->getOutputTestMethodName(
            $inputParams,
            $overwriteExistingDestinationFile
        );

        $outputParams = new ConfigParams(
            $outFilePath,
            $outPhpClassName,
            $outTestMethodName
        );

        return $outputParams;
    }
}
