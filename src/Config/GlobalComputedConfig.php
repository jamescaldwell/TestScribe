<?php

namespace Box\TestScribe\Config;

use Box\TestScribe\App;
use Box\TestScribe\MethodInfo\Method;
use Box\TestScribe\ClassInfo\PhpClassName;

/**
 * Class GlobalComputedConfig
 * @package Box\TestScribe
 *
 * Computed configuration values
 * including direct user configuration and derived configuration values.
 */
class GlobalComputedConfig
{
    /**
     * @var PhpClassName
     *
     * The class being tested.
     */
    private $inPhpClassName;

    /**
     * The method under test.
     *
     * @var \Box\TestScribe\MethodInfo\Method
     */
    private $inMethod;

    /**
     * @var string
     *
     * The source file path of the file that contains the class being tested.
     */
    private $inSourceFile;

    /**
     * @var PhpClassName
     *
     * The name of the output test class name.
     * Note that this class is yet to be generated.
     * So it can't be represented by PhpClass class.
     */
    private $outPhpClassName;

    /**
     * @var string
     *
     * The path of the file that contains the generated tests.
     */
    private $outSourceFile;

    /**
     * The name of the test to generate.
     *
     * @var string
     */
    private $outMethodName;

    /**
     * @var bool
     */
    private $overwriteExistingDestinationFile;

    /** @var  string */
    private $testFileRoot;

    /** @var  string */
    private $sourceFilePathRelativeToSourceRoot;

    /** @var  string */
    private $outSourcePath;

    /**
     * @param \Box\TestScribe\Config\ConfigParams $inputParams
     * @param \Box\TestScribe\MethodInfo\Method   $inMethod
     * @param \Box\TestScribe\Config\Options      $options
     * @param \Box\TestScribe\Config\ConfigParams $outputParams
     */
    function __construct(
        ConfigParams $inputParams,
        Method $inMethod,
        Options $options,
        ConfigParams $outputParams
    )
    {
        $this->inPhpClassName = $inputParams->getPhpClassName();
        $this->inMethod = $inMethod;
        $this->inSourceFile = $inputParams->getSourceFile();
        $this->outPhpClassName = $outputParams->getPhpClassName();
        $this->outSourceFile = $outputParams->getSourceFile();
        $this->outMethodName = $outputParams->getMethodName();
        $this->overwriteExistingDestinationFile = $options->isOverwriteExistingDestinationFile();
        $this->testFileRoot = $options->getTestRootPath();
        $this->sourceFilePathRelativeToSourceRoot = $options->getSourceFilePathRelativeToSourceRoot();
        $this->outSourcePath = PathUtil::getPathUnderRoot(
            $this->testFileRoot,
            $this->sourceFilePathRelativeToSourceRoot
        );
    }

    /**
     * Get the return type of the method under test.
     *
     * @return \Box\TestScribe\PHPDoc\PHPDocType
     */
    public function getReturnType()
    {
        $returnType = $this->inMethod->getReturnType();

        return $returnType;
    }

    /**
     * @return bool
     */
    public function isReturnTypeVoid()
    {
        $returnType = $this->inMethod->getReturnType();

        $isVoid = $returnType->isVoid();

        return $isVoid;
    }

    /**
     * Get the full class name of the class under test.
     *
     * @return string
     */
    public function getFullClassName()
    {
        $fullName = $this->inPhpClassName->getFullyQualifiedClassName();

        return $fullName;
    }

    /**
     * @return \Box\TestScribe\MethodInfo\Method
     */
    public function getInMethod()
    {
        return $this->inMethod;
    }

    /**
     * Get the name of the method under test.
     *
     * @return string
     */
    public function getMethodName()
    {
        return $this->inMethod->getName();
    }

    /**
     * @return bool
     */
    public function isMethodStatic()
    {
        $methodObj = $this->inMethod;

        $isStatic = $methodObj->isStatic();

        return $isStatic;
    }


    /**
     * @return bool
     */
    public function isMethodPublic()
    {
        $methodObj = $this->inMethod;

        $isStatic = $methodObj->isPublic();

        return $isStatic;
    }


    /**
     * @return string
     */
    public function getInSourceFile()
    {
        return $this->inSourceFile;
    }

    /**
     * @return \Box\TestScribe\ClassInfo\PhpClassName
     */
    public function getOutPhpClassName()
    {
        return $this->outPhpClassName;
    }

    /**
     * @return string
     */
    public function getOutSourceFile()
    {
        return $this->outSourceFile;
    }

    /**
     * @return string
     */
    public function getTestMethodName()
    {
        return $this->outMethodName;
    }

    /**
     * @return boolean
     */
    public function isOverwriteExistingDestinationFile()
    {
        return $this->overwriteExistingDestinationFile;
    }

    /**
     * @return string
     */
    public function getInjectMockedObjectMethodName()
    {
        $name = App::getInjectMockedObjectMethodName();

        return $name;
    }

    /**
     * @return string
     */
    public function getInjectMockedClassMethodName()
    {
        $name = App::getInjectMockedClassMethodName();

        return $name;
    }

    /**
     * Get the history file path.
     *
     * @return string
     */
    public function getHistoryFile()
    {
        $historyFilePathRoot = $this->testFileRoot . DIRECTORY_SEPARATOR . 'test_generator' .
            DIRECTORY_SEPARATOR . 'history';
        $historyFilePath = PathUtil::getPathUnderRoot(
            $historyFilePathRoot,
            $this->sourceFilePathRelativeToSourceRoot
        );
        $inClassName = $this->inPhpClassName->getClassName();
        $historyFilePath .=
            DIRECTORY_SEPARATOR . $inClassName . '.yaml';

        return $historyFilePath;
    }

    /**
     * @return string
     */
    public function getSpecFilePath()
    {
        $inClassName = $this->inPhpClassName->getClassName();
        $specFilePath = $this->outSourcePath . DIRECTORY_SEPARATOR . $inClassName . '.yaml';

        return $specFilePath;
    }
}
