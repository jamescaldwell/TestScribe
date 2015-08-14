<?php

namespace Box\TestScribe;

use Box\TestScribe\Input\InputValueGetter;
use Box\TestScribe\Mock\MockClass;

/**
 * This is the only class which should modify the MockClass's state
 * after that instance is created.
 *
 * @var  InputValueGetter | MethodHelper
 */
class MockClassServiceInfoSaver
{
    /** @var InputValueGetter */
    private $inputValueGetter;

    /** @var MethodHelper */
    private $methodHelper;

    /**
     * @param \Box\TestScribe\Input\InputValueGetter $inputValueGetter
     * @param \Box\TestScribe\MethodHelper     $methodHelper
     */
    function __construct(
        InputValueGetter $inputValueGetter,
        MethodHelper $methodHelper
    )
    {
        $this->inputValueGetter = $inputValueGetter;
        $this->methodHelper = $methodHelper;
    }
    /**
     * Handle intercepted calls made to the mock class instance.
     *
     * @param \Box\TestScribe\Mock\MockClass $mockClass
     * @param string                              $methodName
     * @param array                               $arguments
     *
     * @return mixed|void
     * @throws \Box\TestScribe\GeneratorException
     * @throw \RuntimeException
     */
    public function gatherAndSaveCallInfo(
        MockClass $mockClass,
        $methodName,
        $arguments
    )
    {
        $phpClass = $mockClass->getPhpClass();
        $className = $mockClass->getClassNameBeingMocked();

        $methodObj = $this->methodHelper->createFromMethodName(
            $phpClass,
            $methodName
        );
        $retPHPDocType = $methodObj->getReturnType();
        $value = $this->inputValueGetter->get(
            $retPHPDocType,
            'return value',
            $className,
            $methodName,
            ''
        );
        $mockClass->saveInvocationInformation(
            $methodObj,
            $arguments,
            $value
        );

        $returnValue = $value->getValue();

        return $returnValue;
    }
}
