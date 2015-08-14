<?php

namespace Box\TestScribe\Mock;

use Box\TestScribe\Input\InputValue;
use Box\TestScribe\Method;
use Box\TestScribe\MethodHelper;
use Box\TestScribe\PhpClass;

/**
 * Represent a class being mocked
 *
 * This is a stateful value class.
 * It's designed to be instantiated by the MockClassFactory class.
 *
 * @var MockClassService
 */
class MockClass implements \JsonSerializable
{
    /**
     * Array of MockClass
     *
     * @var array
     */
    private $mockedReturnValues = [];

    /**
     * @var array
     *  value: [
     *      Method class instance
     *      argument array
     *      return value for that method. If it is a mock, an instance of MockClass.
     *  ]
     */
    private $methodInvocations = [];

    /**
     * @var string
     */
    private $mockObjectName;

    /**
     * @var string
     */
    private $mockClassName;

    /**
     * @var PhpClass
     */
    private $phpClass;

    /**
     * true if this class is mocked for
     * invocation of static methods.
     *
     * @var bool
     */
    private $isStaticMock;

    /**
     * An instance of a dynamically generated class which is
     * a subclass of the class being mocked.
     * Null if isStaticMock is true.
     *
     * @var object|null
     */
    private $mockedDynamicClassObj;

    /** @var MockClassService */
    private $mockClassService;

    /**
     * @param \Box\TestScribe\Mock\MockClassService $mockClassService
     * @param \Box\TestScribe\PhpClass         $phpClass
     *   The class being mocked
     * @param bool                                       $isStaticMock
     * @param string                                     $nameOfTheMethodToPassThrough
     *   If not empty string, it tells this instance to pass calls to
     *   this method to the real object of the class being mocked
     *   and continue to mock other methods.
     *   If it is empty, it tells this instance to mock all methods.
     * @param string                                     $mockObjectName
     */
    function __construct(
        MockClassService $mockClassService,
        PhpClass $phpClass,
        $isStaticMock,
        $nameOfTheMethodToPassThrough,
        $mockObjectName
    )
    {
        $this->mockClassService = $mockClassService;

        $this->phpClass = $phpClass;
        $this->isStaticMock = $isStaticMock;
        $this->mockObjectName = $mockObjectName;
        // @TODO (ryang 8/18/14) : generate expectation of constructor arguments.
    }


    /**
     * Get the class name of the class being mocked.
     *
     * @return string
     */
    public function getClassNameBeingMocked()
    {
        $phpClassName = $this->phpClass->getPhpClassName();
        $className = $phpClassName->getFullyQualifiedClassName();

        return $className;
    }

    /**
     * Return information about all the method invocations.
     *
     * @return array
     */
    public function getMethodInvocations()
    {
        return $this->methodInvocations;
    }

    /**
     * @return string
     */
    public function getMockObjectName()
    {
        return $this->mockObjectName;
    }

    /**
     * @return boolean
     */
    public function isStaticMock()
    {
        return $this->isStaticMock;
    }

    /**
     * @return array
     */
    public function getMockedReturnValues()
    {
        return $this->mockedReturnValues;
    }

    /**
     * @return object|null
     */
    public function getMockedDynamicClassObj()
    {
        return $this->mockedDynamicClassObj;
    }

    /**
     * @param object|null $mockedDynamicClassObj
     *
     * @return void
     */
    public function setMockedDynamicClassObj($mockedDynamicClassObj)
    {
        $this->mockedDynamicClassObj = $mockedDynamicClassObj;
    }

    /**
     * @return \Box\TestScribe\PhpClass
     *
     * Information about the class being mocked.
     */
    public function getPhpClass()
    {
        return $this->phpClass;
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        return $this->getStringRepresentation();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getStringRepresentation();
    }

    /**
     * @return string
     */
    private function getStringRepresentation()
    {
        $ret = sprintf("mock object ( %s )", $this->mockObjectName);

        return $ret;
    }

    /**
     * Handle intercepted calls made to the mock class instance.
     *
     * @param string $methodName
     * @param array  $arguments
     *
     * @return mixed|void
     * @throws \Box\TestScribe\GeneratorException
     * @throw \RuntimeException
     */
    public function invokeInterceptedCall(
        $methodName,
        $arguments
    )
    {
        $rc = $this->mockClassService->invokeInterceptedCall($this, $methodName, $arguments);

        return $rc;
    }

    /**
     * @param \Box\TestScribe\Method     $methodObj
     * @param array                                $arguments
     * @param \Box\TestScribe\Input\InputValue $value
     *
     * @return void
     */
    public function saveInvocationInformation(
        Method $methodObj,
        array $arguments,
        InputValue $value
    )
    {
        // Save the mocked object so that we can generate the mock statements for them.
        $this->mockedReturnValues = array_merge(
            $this->mockedReturnValues,
            $value->getMocks()
        );

        // To make the renderer simpler,
        // always save the MockClass instance in invocation record.
        $this->methodInvocations[] = [
            $methodObj,
            $arguments,
            $value
        ];
    }

    /**
     * @return string
     */
    public function getMockClassName()
    {
        return $this->mockClassName;
    }

    /**
     * @param string $mockClassName
     *
     * @return void
     */
    public function setMockClassName($mockClassName)
    {
        $this->mockClassName = $mockClassName;
    }

    /**
     * Return the constructor associated with the class being mocked.
     *
     * @return \Box\TestScribe\Method|null
     */
    public function getConstructorOfTheMockedClass()
    {
        $methodHelperObj = new MethodHelper();
        $constructorMethodObj = $methodHelperObj->createConstructor($this->phpClass);

        return $constructorMethodObj;
    }

}
