<?php


namespace Box\TestScribe\Config;

use Box\TestScribe\CmdOption;
use Box\TestScribe\FunctionWrappers\FileFunctionWrapper;
use Box\TestScribe\PhpClassName;
use Symfony\Component\Console\Input\InputInterface;


/**
 * Initialize output parameters
 * @var FileFunctionWrapper|ConfigHelper
 */
class OutputConfig
{
    /** @var FileFunctionWrapper */
    private $fileFunctionWrapper;

    /** @var ConfigHelper */
    private $configHelper;

    /**
     * @param \Box\TestScribe\FunctionWrappers\FileFunctionWrapper $fileFunctionWrapper
     * @param \Box\TestScribe\Config\ConfigHelper                  $configHelper
     */
    function __construct(
        FileFunctionWrapper $fileFunctionWrapper,
        ConfigHelper $configHelper
    )
    {
        $this->fileFunctionWrapper = $fileFunctionWrapper;
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
        $testFileRoot = $this->configHelper->getTestRootPath($input);

        $inSourceFile = $inputParams->getSourceFile();

        $originalSourceFileRoot = (string) $input->getOption(CmdOption::SOURCE_ROOT_OPTION_NAME);
        if ($originalSourceFileRoot === '') {
            // Infer source file root.
            $sourceFileRoot = $this->configHelper->getSourceRoot(
                $testFileRoot,
                $inSourceFile
            );
        } else {
            $sourceFileRoot = $this->fileFunctionWrapper->realpath($originalSourceFileRoot);
        }

        $sourceFilePathRelativeToSourceRoot = $this->configHelper->getSourceFilePathRelativeToSourceRoot(
            $sourceFileRoot,
            $inSourceFile
        );

        $inFullClassName = $inputParams->getFullClassName();
        $outFullClassName = $inFullClassName . 'GenTest';
        $outPhpClassName = new PhpClassName($outFullClassName);

        $outSourceFileDir = $this->configHelper->getPathUnderRoot(
            $testFileRoot,
            $sourceFilePathRelativeToSourceRoot
        );
        $outSimpleOutClassName = $outPhpClassName->getClassName();
        $outSourceFile =
            $outSourceFileDir . DIRECTORY_SEPARATOR . $outSimpleOutClassName . '.php';

        $outTestMethodName = $this->configHelper->getOutputTestMethodName(
            $inputParams,
            $overwriteExistingDestinationFile
        );

        $outputParams = new ConfigParams(
            $outSourceFile,
            $outPhpClassName,
            $outTestMethodName
        );

        return $outputParams;
    }
}
