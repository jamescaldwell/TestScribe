<?php
/**
 *
 */

namespace Box\TestScribe;

/**
 * Class GlobalComputedConfig
 * @package Box\TestScribe
 * 
 * Computed configuration values 
 * e.g. value dervied from command line options.
 */
class GlobalComputedConfig 
{
    /**
     * @var PhpClass
     * 
     * The class being tested
     */
    private $inClass;

    /**
     * The method under test.
     *
     * @var Method
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
     * the name of the test to generate
     *
     * @var string
     */
    private $testMethodName;

    /**
     * File path of the input history
     * 
     * @var string
     */
    private $historyFile;

    /**
     * @var bool
     */
    private $overwriteExistingDestinationFile;

    /**
     * @param $inClass
     * @param $inMethod
     * @param $inSourceFile
     * @param $outPhpClassName
     * @param $outSourceFile
     * @param $testMethodName
     * @param string $historyFile
     * @param $overwriteExistingDestinationFile
     */
    function __construct(
        $inClass,
        $inMethod,
        $inSourceFile,
        $outPhpClassName,
        $outSourceFile,
        $testMethodName,
        $historyFile,
        $overwriteExistingDestinationFile
    )
    {
        $this->inClass = $inClass;
        $this->inMethod = $inMethod;
        $this->inSourceFile = $inSourceFile;
        $this->outPhpClassName = $outPhpClassName;
        $this->outSourceFile = $outSourceFile;
        $this->testMethodName = $testMethodName;
        $this->historyFile = $historyFile;
        $this->overwriteExistingDestinationFile = $overwriteExistingDestinationFile;
    }

    /**
     * @return string
     */
    public function getHistoryFile()
    {
        return $this->historyFile;
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
     * @return \Box\TestScribe\PhpClass
     */
    public function getInClass()
    {
        return $this->inClass;
    }

    /**
     * Get the full class name of the class under test.
     *
     * @return string
     */
    public function getFullClassName()
    {
        $fullName = $this->inClass->getPhpClassName()->getFullyQualifiedClassName();

        return $fullName;
    }

    /**
     * @return \Box\TestScribe\Method
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
     * @return \Box\TestScribe\PhpClassName
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
        return $this->testMethodName;
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
}
