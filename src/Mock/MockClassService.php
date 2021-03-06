<?php

namespace Box\TestScribe\Mock;

use Box\TestScribe\MethodInfo\MethodHelper;
use Box\TestScribe\Output;

/**
 * Responsible for operations to the MockClass instance.
 * This is the only class which should modify the MockClass's state
 * after that instance is created.
 *
 * @var MockClassServiceCallInfo | MockClassServiceInfoSaver | \Box\TestScribe\MethodInfo\MethodHelper|Output
 */
class MockClassService
{
    /** @var MockClassServiceCallInfo */
    private $mockClassServiceCallInfo;

    /** @var MockClassServiceInfoSaver */
    private $mockClassServiceInfoSaver;

    /** @var \Box\TestScribe\MethodInfo\MethodHelper */
    private $methodHelper;

    /** @var Output */
    private $output;

    /**
     * @param \Box\TestScribe\Mock\MockClassServiceCallInfo  $mockClassServiceCallInfo
     * @param \Box\TestScribe\Mock\MockClassServiceInfoSaver $mockClassServiceInfoSaver
     * @param \Box\TestScribe\MethodInfo\MethodHelper              $methodHelper
     * @param \Box\TestScribe\Output                    $output
     */
    function __construct(
        MockClassServiceCallInfo $mockClassServiceCallInfo,
        MockClassServiceInfoSaver $mockClassServiceInfoSaver,
        MethodHelper $methodHelper,
        Output $output
    )
    {
        $this->mockClassServiceCallInfo = $mockClassServiceCallInfo;
        $this->mockClassServiceInfoSaver = $mockClassServiceInfoSaver;
        $this->methodHelper = $methodHelper;
        $this->output = $output;
    }

    /**
     * Handle intercepted calls made to the mock class instance.
     *
     * @param \Box\TestScribe\Mock\MockClass $mockClass
     * @param string                              $methodName
     * @param array                               $arguments
     *
     * @return mixed|void
     * @throws \Box\TestScribe\Exception\TestScribeException
     * @throw \RuntimeException
     */
    public function invokeInterceptedCall(
        MockClass $mockClass,
        $methodName,
        $arguments
    )
    {
        $this->output->writeStartSeparator();

        $phpClassObj = $mockClass->getPhpClass();
        $methodObj = $this->methodHelper->createFromMethodName(
            $phpClassObj,
            $methodName
        );

        $mockObjName = $mockClass->getMockObjectName();
        $this->mockClassServiceCallInfo->showCallInfo(
            $mockObjName,
            $methodObj,
            $arguments
        );

        $returnValue = $this->mockClassServiceInfoSaver->gatherAndSaveCallInfo(
            $mockClass,
            $methodName,
            $arguments
        );

        $this->output->writeEndSeparator();

        return $returnValue;
    }
}
