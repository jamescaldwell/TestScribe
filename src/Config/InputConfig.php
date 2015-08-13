<?php


namespace Box\TestScribe\Config;

use Box\TestScribe\CmdOption;
use Box\TestScribe\FunctionWrappers\FileFunctionWrapper;
use Box\TestScribe\PhpClassName;
use Symfony\Component\Console\Input\InputInterface;


/**
 * Initialize input parameters
 * @var FileFunctionWrapper|ClassExtractor
 */
class InputConfig
{
    /** @var FileFunctionWrapper */
    private $fileFunctionWrapper;

    /** @var ClassExtractor */
    private $classExtractor;

    /**
     * @param \Box\TestScribe\FunctionWrappers\FileFunctionWrapper $fileFunctionWrapper
     * @param \Box\TestScribe\Config\ClassExtractor                $classExtractor
     */
    public function __construct(
        FileFunctionWrapper $fileFunctionWrapper,
        ClassExtractor $classExtractor
    )
    {
        $this->fileFunctionWrapper = $fileFunctionWrapper;
        $this->classExtractor = $classExtractor;
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     *
     * @return \Box\TestScribe\Config\ConfigParams
     * @throws \Box\TestScribe\GeneratorException
     */
    public function getInputParams(
        InputInterface $input
    )
    {
        $originalInSourceFile = (string) $input->getArgument(CmdOption::SOURCE_FILE_NAME_KEY);
        // Always use the absolute path. This is needed when checking
        // if a call is from the class under test.
        $inSourceFile = $this->fileFunctionWrapper->realpath($originalInSourceFile);

        $methodName = (string) $input->getArgument(CmdOption::METHOD_NAME_KEY);

        $inClassName = $this->classExtractor->getClassName($inSourceFile, $methodName);
        $inPhpClassName = new PhpClassName($inClassName);

        $inputParams = new ConfigParams(
            $inSourceFile,
            $inPhpClassName,
            $methodName
        );

        return $inputParams;
    }
}
