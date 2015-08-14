<?php


namespace Box\TestScribe\Config;

use Box\TestScribe\CLI\CmdOption;
use Box\TestScribe\FunctionWrappers\FileFunctionWrapper;
use Box\TestScribe\Output;
use Box\TestScribe\PhpClassName;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * Initialize input parameters
 * @var FileFunctionWrapper|ClassExtractor|Output
 */
class InputConfig
{
    /** @var FileFunctionWrapper */
    private $fileFunctionWrapper;

    /** @var ClassExtractor */
    private $classExtractor;

    /** @var Output */
    private $output;

    /**
     * @param \Box\TestScribe\FunctionWrappers\FileFunctionWrapper $fileFunctionWrapper
     * @param \Box\TestScribe\Config\ClassExtractor                $classExtractor
     * @param \Box\TestScribe\Output                               $output
     */
    function __construct(
        FileFunctionWrapper $fileFunctionWrapper,
        ClassExtractor $classExtractor,
        Output $output
    )
    {
        $this->fileFunctionWrapper = $fileFunctionWrapper;
        $this->classExtractor = $classExtractor;
        $this->output = $output;
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

        $methodName = (string) $input->getArgument(CmdOption::METHOD_NAME_KEY);

        $inClassName = $this->classExtractor->getClassName($inSourceFile, $methodName);
        $inPhpClassName = new PhpClassName($inClassName);

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
