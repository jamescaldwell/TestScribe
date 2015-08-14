<?php

namespace Box\TestScribe\Mock;

use Box\TestScribe\Method;
use Box\TestScribe\MethodCallInfo;
use Box\TestScribe\Output;
use Box\TestScribe\Utils\CallInformationCollector;
use Box\TestScribe\Utils\Util;

/**
 * @var Output | CallInformationCollector | Util | MethodCallInfo
 */
class MockClassServiceCallInfo
{
    /** @var Output */
    private $output;

    /** @var CallInformationCollector */
    private $callInformationCollector;

    /** @var MethodCallInfo */
    private $methodCallInfo;

    /**
     * @param \Box\TestScribe\Output                         $output
     * @param \Box\TestScribe\Utils\CallInformationCollector $callInformationCollector
     * @param \Box\TestScribe\MethodCallInfo                 $methodCallInfo
     */
    function __construct(
        Output $output,
        CallInformationCollector $callInformationCollector,
        MethodCallInfo $methodCallInfo
    )
    {
        $this->output = $output;
        $this->callInformationCollector = $callInformationCollector;
        $this->methodCallInfo = $methodCallInfo;
    }

    /**
     * Handle intercepted calls made to the mock class instance.
     *
     * @param \Box\TestScribe\Method $method
     * @param array                            $arguments
     *
     * @return void
     */
    public function showCallInfo(
        Method $method,
        array $arguments
    )
    {
        $phpClassInfo = $method->getClass();
        $className = $phpClassInfo->getPhpClassName()->getFullyQualifiedClassName();
        $methodName = $method->getName();

        $callerInfoString = $this->getCallerInfoString();

        $msg = "\n$callerInfoString Calling $className::$methodName( ";
        $this->output->write($msg);

        $msg = $this->methodCallInfo->getCallParamInfo($method, $arguments);
        $this->output->writeln($msg);
    }

    /**
     * @return string
     * @throws \Box\TestScribe\GeneratorException
     */
    private function getCallerInfoString()
    {
        //  #0  Box\TestScribe\_fixture\_input\CalculatorUtil->calc()
        //  #1  mockClassInstance->add()
        //  #2  mockClassInstance->__routeAllCallsToTestGeneratorMockObjects()
        //  #3  Box\TestScribe\Mock\MockClass->invokeInterceptedCall()
        //  #4  Box\TestScribe\Mock\MockClassService->invokeInterceptedCall()
        //  #5  Box\TestScribe\Mock\MockClassServiceCallInfo::showCallInfo()
        //  #6  Box\TestScribe\Mock\MockClassServiceCallInfo->getCallerInfoString()

        // @TODO (ryang 5/28/15) : find a better way to maintain this logic and add a test
        // for it.
        // It's easy to pass the wrong parameter
        // when adding or subtracting a layer of calls here.
        $callerLocationInfo = $this->callInformationCollector
            ->getCallerInfoAt(7);
        $lineNumberString = $callerLocationInfo->getLineNumberString();
        $callerInfoString = "line ( $lineNumberString )";

        return $callerInfoString;
    }
}
