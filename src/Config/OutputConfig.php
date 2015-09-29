<?php


namespace Box\TestScribe\Config;

use Box\TestScribe\ClassInfo\PhpClassName;
use Box\TestScribe\Spec\SavedSpecs;
use Symfony\Component\Console\Input\InputInterface;


/**
 * Initialize output parameters
 * @var OutputTestNameGetter|SavedSpecs
 */
class OutputConfig
{
    /** @var OutputTestNameGetter */
    private $outputTestNameGetter;

    /** @var SavedSpecs */
    private $savedSpecs;

    /**
     * @param \Box\TestScribe\Config\OutputTestNameGetter $outputTestNameGetter
     * @param \Box\TestScribe\Spec\SavedSpecs $savedSpecs
     */
    function __construct(
        OutputTestNameGetter $outputTestNameGetter,
        SavedSpecs $savedSpecs
    )
    {
        $this->outputTestNameGetter = $outputTestNameGetter;
        $this->savedSpecs = $savedSpecs;
    }

    /**
     * @param \Box\TestScribe\Config\Options $options
     * @param \Box\TestScribe\Config\ConfigParams $inputParams
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

        $specPerClass = $this->savedSpecs->loadExistingSpecs(
            $inputParams,
            $outSourceFileDir
        );

        $outTestMethodName = $this->outputTestNameGetter->getTestName(
            $methodName,
            $overwriteExistingDestinationFile,
            $specPerClass
        );

        $outputParams = new ConfigParams(
            $outSourceFilePath,
            $outPhpClassName,
            $outTestMethodName
        );

        return $outputParams;
    }
}
