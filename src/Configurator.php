<?php
/**
 *
 */

namespace Box\TestScribe;

use Box\TestScribe\CLI\InputParamsBuilder;
use Box\TestScribe\CLI\OutputParamsBuilder;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Class Configurator
 * @package Box\TestScribe
 *
 * Calculate global configurations
 */
class Configurator
{
    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     *
     * @return \Box\TestScribe\GlobalComputedConfig
     */
    public function config(InputInterface $input)
    {
        $bootStrapFile = $input->getOption(CmdOption::BOOT_STRAP_FILE_PATH_OPTION);
        if ($bootStrapFile && file_exists($bootStrapFile)) {
            // @TODO (ryang 8/4/14) : Show an error if the bootstrap file can't be found
            /** @noinspection PhpIncludeInspection */
            include $bootStrapFile;
        }

        $inSourceFile = (string) $input->getArgument(CmdOption::SOURCE_FILE_NAME_KEY);
        // Always use the absolute path. This is needed when checking
        // if a call is from the class under test.
        $inSourceFile = realpath($inSourceFile);

        $methodName = (string) $input->getArgument(CmdOption::METHOD_NAME_KEY);
        $inClassName = (string) $input->getOption(CmdOption::SOURCE_CLASS_NAME_OPTION);
        if (!$inClassName) {
            $inClassName = ClassExtractor::getClassName($inSourceFile, $methodName);
        }

        $cmdLineOutParamHelperObj = new CmdLineOutParamHelper();

        $overwriteExistingDestinationFile =
            $input->getOption(CmdOption::OVERWRITE_EXISTING_DESTINATION_FILE_OPTION);
        $outClassName = (string) $input->getOption(CmdOption::DESTINATION_CLASS_NAME_OPTION);
        $testFileRoot = $this->getTestRootPath($input);

        $sourceFileRoot = (string) $input->getOption(CmdOption::SOURCE_ROOT_OPTION_NAME);
        if ($sourceFileRoot === '') {
            // Infer source file root.
            $sourceFileRoot = $cmdLineOutParamHelperObj->getSourceRoot(
                $testFileRoot,
                $inSourceFile
            );
        } else {
            $sourceFileRoot = realpath($sourceFileRoot);
        }

        $sourceFilePathRelativeToSourceRoot = $cmdLineOutParamHelperObj->getSourceFilePathRelativeToSourceRoot(
            $sourceFileRoot,
            $inSourceFile
        );

        $inParams = $this->initInParameters($inClassName, $inSourceFile, $methodName);
        $outParams = $this->initOutParameters(
            $outClassName,
            $testFileRoot,
            $inParams,
            $sourceFilePathRelativeToSourceRoot
        );
        $testName = GeneratedTestFile::getTestName(
            $inClassName,
            $methodName,
            $overwriteExistingDestinationFile
        );
        $inClass = $inParams->getPhpClass();
        $inMethod = $inParams->getMethod();
        $outPhpClassName = $outParams->getPhpClassName();
        $outSourceFile = $outParams->getSourceFile();

        $historyFile = $cmdLineOutParamHelperObj->getInputHistoryFilePath(
            $testFileRoot,
            $inClass->getPhpClassName()->getClassName(),
            $sourceFilePathRelativeToSourceRoot
        );
        $config = new GlobalComputedConfig(
            $inClass,
            $inMethod,
            $inSourceFile,
            $outPhpClassName,
            $outSourceFile,
            $testName,
            $historyFile,
            $overwriteExistingDestinationFile
        );

        return $config;
    }

    /**
     * Initialize outClass and outSourceFile members.
     *
     * @param string|null                               $outClassName
     * @param string                                    $testFileRoot
     * @param \Box\TestScribe\CLI\InputParams $inParams
     * @param string                                    $sourceFilePathRelativeToSourceRoot
     *
     * @return \Box\TestScribe\CLI\OutputParams
     */
    private function initOutParameters(
        $outClassName,
        $testFileRoot,
        $inParams,
        $sourceFilePathRelativeToSourceRoot
    )
    {
        $cmdLineOutParamHelperObj = new CmdLineOutParamHelper();
        $ret = new OutputParamsBuilder();
        $retOutClassName = $cmdLineOutParamHelperObj->getOuputClassName(
            $outClassName,
            $inParams->getPhpClassName()
        );
        $ret->setOutPhpClassName($retOutClassName);

        $outSourceFileDir = $cmdLineOutParamHelperObj->getPathUnderRoot(
            $testFileRoot,
            $sourceFilePathRelativeToSourceRoot
        );
        $retSimpleOutClassName = $retOutClassName->getClassName();
        $outSourceFile =
            $outSourceFileDir . DIRECTORY_SEPARATOR . $retSimpleOutClassName . '.php';
        $ret->setOutSourceFile($outSourceFile);

        return $ret->build();
    }

    /**
     * Initialize the parameters regarding the input class and method.
     *
     * @param  string $inClassName
     * @param  string $inSourceFile
     * @param  string $inMethodName
     *
     * @return \Box\TestScribe\CLI\InputParams
     * @throws \RuntimeException
     */
    private function initInParameters(
        $inClassName,
        $inSourceFile,
        $inMethodName
    )
    {
        $inputBuilder = new InputParamsBuilder();
        $cmdLineParameterHelperObj = new CmdLineInParametersHelper();
        $inputBuilder->setInSourceFile(
            $cmdLineParameterHelperObj->initInClassAndSourceFile(
                $inClassName,
                $inSourceFile
            )
        );
        $phpClassName = new PhpClassName($inClassName);
        $inputBuilder->setInPhpClassName($phpClassName);
        $inClass = new PhpClass($phpClassName);
        $inputBuilder->setInClass($inClass);
        $methodHelper = new MethodHelper();
        $methodUnderTest = $methodHelper->createFromMethodName($inClass, $inMethodName);
        if (!$methodUnderTest->isTestable()) {
            $errMsg = "The tool currently doesn't support testing abstract method or constructor.";
            throw new \RuntimeException($errMsg);
        }
        $inputBuilder->setInMethod($methodUnderTest);
        $inputBuilder->setInConstructor($methodHelper->createConstructor($inClass));

        return $inputBuilder->build();
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     *
     * @return string
     */
    private function getTestRootPath(InputInterface $input)
    {
        $origTestFileRoot = (string) $input->getOption(CmdOption::TEST_SOURCE_ROOT_OPTION_NAME);
        $testFileRoot = realpath($origTestFileRoot);
        if ($testFileRoot===false) {
            $msg = sprintf(
                'Invalid test file root directory (%s)',
                $origTestFileRoot
            );
            throw new \RuntimeException($msg);
        }

        return $testFileRoot;
    }
}
