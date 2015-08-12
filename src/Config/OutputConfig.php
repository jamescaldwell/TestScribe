<?php


namespace Box\TestScribe\Config;

use Box\TestScribe\GeneratedTestFile;
use Box\TestScribe\PhpClassName;
use Symfony\Component\Console\Input\InputInterface;


/**
 * Initialize output parameters
 */
class OutputConfig
{
    /**
     * @param \Box\TestScribe\Config\Options                  $options
     * @param \Box\TestScribe\Config\ConfigParams             $inputParams
     *
     * @return \Box\TestScribe\Config\ConfigParams
     */
    public function getOutputParams(
        Options $options,
        ConfigParams $inputParams
    )
    {
        $inFullClassName = $inputParams->getFullClassName();
        $outFullClassName = $inFullClassName . 'GenTest';
        $outPhpClassName = new PhpClassName($outFullClassName);
        $outSimpleClassName = $outPhpClassName->getClassName();

        $outSourceFileDir = $options->getOutSourceFileDir();

        $outSourceFilePath =
            $outSourceFileDir . DIRECTORY_SEPARATOR . $outSimpleClassName . '.php';

        $overwriteExistingDestinationFile = $options->isOverwriteExistingDestinationFile();

        $inClassName = $inputParams->getClassName();
        $methodName = $inputParams->getMethodName();
        $outTestMethodName = GeneratedTestFile::getTestName(
            $inClassName,
            $methodName,
            $overwriteExistingDestinationFile
        );

        $outputParams = new ConfigParams(
            $outSourceFilePath,
            $outPhpClassName,
            $outTestMethodName
        );

        return $outputParams;
    }
}
