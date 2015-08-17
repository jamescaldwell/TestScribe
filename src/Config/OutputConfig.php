<?php


namespace Box\TestScribe\Config;

use Box\TestScribe\ClassInfo\PhpClassName;
use Symfony\Component\Console\Input\InputInterface;


/**
 * Initialize output parameters
 * @var OutputTestNameGetter
 */
class OutputConfig
{
    /** @var OutputTestNameGetter */
    private $outputTestNameGetter;

    /**
     * @param \Box\TestScribe\Config\OutputTestNameGetter $outputTestNameGetter
     */
    function __construct(
        OutputTestNameGetter $outputTestNameGetter
    )
    {
        $this->outputTestNameGetter = $outputTestNameGetter;
    }

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

        $methodName = $inputParams->getMethodName();
        $outTestMethodName = $this->outputTestNameGetter->getTestName(
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
