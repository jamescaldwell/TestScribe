<?php


namespace Box\TestScribe\Config;

use Box\TestScribe\CLI\CmdOption;
use Box\TestScribe\FunctionWrappers\FileFunctionWrapper;
use Box\TestScribe\Output;
use Box\TestScribe\ClassInfo\PhpClassName;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * Initialize input parameters
 * @var FileFunctionWrapper|ClassExtractor|Output|MethodNameGetter
 */
class InputConfig
{
    /** @var FileFunctionWrapper */
    private $fileFunctionWrapper;

    /** @var ClassExtractor */
    private $classExtractor;

    /** @var Output */
    private $output;

    /** @var MethodNameGetter */
    private $methodNameGetter;

    /**
     * @param \Box\TestScribe\FunctionWrappers\FileFunctionWrapper $fileFunctionWrapper
     * @param \Box\TestScribe\Config\ClassExtractor $classExtractor
     * @param \Box\TestScribe\Output $output
     * @param \Box\TestScribe\Config\MethodNameGetter $methodNameGetter
     */
    function __construct(
        FileFunctionWrapper $fileFunctionWrapper,
        ClassExtractor $classExtractor,
        Output $output,
        MethodNameGetter $methodNameGetter
    )
    {
        $this->fileFunctionWrapper = $fileFunctionWrapper;
        $this->classExtractor = $classExtractor;
        $this->output = $output;
        $this->methodNameGetter = $methodNameGetter;
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface   $input
     *
     * @return \Box\TestScribe\Config\ConfigParams
     * @throws \Box\TestScribe\Exception\TestScribeException
     */
    public function getInputParams(
        InputInterface $input
    )
    {
        $originalInSourceFile = (string) $input->getArgument(CmdOption::SOURCE_FILE_NAME_KEY);
        // Always use the absolute path. This is needed when checking
        // if a call is from the class under test.
        $inSourceFile = $this->fileFunctionWrapper->realpath($originalInSourceFile);

        $inClassName = $this->classExtractor->getClassName($inSourceFile);
        $inPhpClassName = new PhpClassName($inClassName);

        $methodName = $this->methodNameGetter->getTestMethodName(
            $input,
            $inClassName
        );

        $msg = "Testing the method ( $methodName ) of the class ( $inClassName ).";
        $this->output->writeln($msg);

        $inputParams = new ConfigParams(
            $inSourceFile,
            $inPhpClassName,
            $methodName
        );

        return $inputParams;
    }
}
