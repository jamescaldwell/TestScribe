<?php
namespace Box\TestScribe\Utils;

use Box\TestScribe\_fixture\_input\Calculator;
use Box\TestScribe\_fixture\ObjectFactory;
use Box\TestScribe\Arguments;
use Box\TestScribe\MethodHelper;
use Box\TestScribe\PhpClass;
use Box\TestScribe\PhpClassName;

/**
 */
class ReflectionUtilTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Box\TestScribe\Utils\ReflectionUtil
     */
    public function test_execute_public_instance_method()
    {
        $objectFactoryObj = new ObjectFactory();
        $objectUnderTest = $objectFactoryObj->getReflectionUtil();

        $targetObj = new Calculator(1);
        $phpClass = new PhpClass(new PhpClassName("\\Box\\TestScribe\\_fixture\\_input\\Calculator"));
        $methodHelper = new MethodHelper();
        $methodObj = $methodHelper->createFromMethodName($phpClass,'publicAddOne');
        $args = new Arguments([]);
        $executionResult = $objectUnderTest->invokeMethodRegardlessOfProtectionLevel(
            $targetObj,
            $methodObj,
            $args
        );

        // Validate the execution result.

        $expected = 2;
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

    /**
     * @covers Box\TestScribe\Utils\ReflectionUtil
     */
    public function test_execute_private_instance_method()
    {
        $targetObj = new Calculator(1);

        $phpClass = new PhpClass(new PhpClassName("\\Box\\TestScribe\\_fixture\\_input\\Calculator"));
        $methodHelper = new MethodHelper();
        $methodObj = $methodHelper->createFromMethodName($phpClass,'privateAddOne');

        $objectFactoryObj = new ObjectFactory();
        $converterObj = $objectFactoryObj->getStringToInputValueConverter();
        $inputValue = $converterObj->getValue('2');
        $args = new Arguments([$inputValue]);

        $objectUnderTest = $objectFactoryObj->getReflectionUtil();

        $executionResult = $objectUnderTest->invokeMethodRegardlessOfProtectionLevel(
            $targetObj,
            $methodObj,
            $args
        );

        // Validate the execution result.

        $expected = 3;
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }

    /**
     * @covers Box\TestScribe\Utils\ReflectionUtil
     */
    public function test_execute_private_instance_method_in_a_mock()
    {
        $className = "\\Box\\TestScribe\\_fixture\\_input\\Calculator";
        $methodName = 'privateAddOne';

        $objectFactoryObj = new ObjectFactory();

        $mockClassLoaderObj = $objectFactoryObj->getMockClassLoader();
        $mockClass = $mockClassLoaderObj->createAndLoadMockClass(
            $className,
            $methodName
        );
        $mockObjectFactoryObj = $objectFactoryObj->getMockObjectFactory();
        $mockObj = $mockObjectFactoryObj->createMockObjectFromMockClass(
            $mockClass,
            [1]
        );

        $phpClass = new PhpClass(new PhpClassName($className));
        $methodHelper = new MethodHelper();
        $methodObj = $methodHelper->createFromMethodName($phpClass, $methodName);

        $converterObj = $objectFactoryObj->getStringToInputValueConverter();
        $inputValue = $converterObj->getValue('2');
        $args = new Arguments([$inputValue]);

        $objectUnderTest = $objectFactoryObj->getReflectionUtil();

        $executionResult = $objectUnderTest->invokeMethodRegardlessOfProtectionLevel(
            $mockObj,
            $methodObj,
            $args
        );

        // Validate the execution result.

        $expected = 3;
        $this->assertSame(
            $expected,
            $executionResult,
            'Variable ( executionResult ) doesn\'t have the expected value.'
        );
    }
}
