<?php


namespace Box\TestScribe\Config;

use Box\TestScribe\ClassExtractor;
use Box\TestScribe\CmdOption;
use Box\TestScribe\FunctionWrappers\FileFunctionWrapper;
use Symfony\Component\Console\Input\InputInterface;


/**
 * Initialize input parameters
 * @var ConfigHelper| FileFunctionWrapper
 */
class InputConfig
{
    /** @var ConfigHelper */
    private $configHelper;

    /** @var FileFunctionWrapper */
    private $fileFunctionWrapper;

    /**
     * @param \Box\TestScribe\Config\ConfigHelper                  $configHelper
     * @param \Box\TestScribe\FunctionWrappers\FileFunctionWrapper $fileFunctionWrapper
     */
    function __construct(
        ConfigHelper $configHelper,
        FileFunctionWrapper $fileFunctionWrapper
    )
    {
        $this->configHelper = $configHelper;
        $this->fileFunctionWrapper = $fileFunctionWrapper;
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     *
     * @return \Box\TestScribe\Config\InputParams
     * @throws \Box\TestScribe\GeneratorException
     */
    public function getInputParams(
        InputInterface $input
    )
    {
        $this->configHelper->loadBootstrapFile($input);

        $originalInSourceFile = (string) $input->getArgument(CmdOption::SOURCE_FILE_NAME_KEY);
        // Always use the absolute path. This is needed when checking
        // if a call is from the class under test.
        $inSourceFile = $this->fileFunctionWrapper->realpath($originalInSourceFile);

        $methodName = (string) $input->getArgument(CmdOption::METHOD_NAME_KEY);

        $inClassName = ClassExtractor::getClassName($inSourceFile, $methodName);

        $inputParams = new InputParams(
            $inSourceFile,
            $inClassName,
            $methodName
        );

        return $inputParams;
    }
}
