<?php


namespace Box\TestScribe\Spec;

use Box\TestScribe\Input\InputValue;
use Box\TestScribe\MethodInfo\Method;
use Box\TestScribe\Mock\MockClass;
use Box\TestScribe\Utils\ValueTransformer;


/**
 * @var ValueTransformer
 */
class MockSpecFactory
{
    /** @var ValueTransformer */
    private $valueTransformer;

    /**
     * @param ValueTransformer $valueTransformer
     */
    function __construct(
        ValueTransformer $valueTransformer
    )
    {
        $this->valueTransformer = $valueTransformer;
    }

    /**
     * @param MockClass $mock
     *
     * @return MockSpec
     */
    public function createMockSpecFromMockClass(MockClass $mock)
    {
        $objectName = $mock->getMockObjectName();
        $mockedClassName = $mock->getClassNameBeingMocked();
        $methodInvocations = $mock->getMethodInvocations();
        $invocationSpecs = $this->convertToInvocationSpecs($methodInvocations);
        $mockSpec = new MockSpec(
            $objectName,
            $mockedClassName,
            $invocationSpecs
        );

        return $mockSpec;
    }

    /**
     * @param array $methodInvocations
     *
     * @return array
     */
    private function convertToInvocationSpecs(array $methodInvocations)
    {
        $specArray = [];
        foreach ($methodInvocations as $invocation) {
            /** @var Method $methodObj */
            /** @var InputValue $returnValue */
            list($methodObj, $parameters, $returnValue) = $invocation;
            $methodName = $methodObj->getName();
            $specArray[] = $this->convertOne(
                $methodName,
                $parameters,
                $returnValue
            );
        }

        return $specArray;
    }

    /**
     * @param string     $methodName
     * @param array      $arguments
     * @param InputValue $returnInputValue
     *
     * @return InvocationSpec
     */
    private function convertOne($methodName, array $arguments, InputValue $returnInputValue)
    {
        $convertedArguments = [];
        foreach ($arguments as $arg) {
            $convertedArguments[] = $this->valueTransformer->translateObjectsAndResourceToString(
                $arg,
                true
            );
        }
        $returnValue = $returnInputValue->getValue();
        $convertedReturnValue = $this->valueTransformer->translateObjectsAndResourceToString(
            $returnValue,
            true
        );
        $spec = new InvocationSpec($methodName, $convertedArguments, $convertedReturnValue);

        return $spec;
    }
}
