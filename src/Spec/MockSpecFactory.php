<?php


namespace Box\TestScribe\Spec;

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
        foreach($methodInvocations as $invocation){
            /** @var Method $methodObj */
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
     * @param string $methodName
     * @param array $arguments
     * @param mixed $returnValue
     *
     * @return InvocationSpec
     */
    private function convertOne($methodName, $arguments, $returnValue)
    {
        $convertedArguments = [];
        foreach($arguments as $arg){
            $convertedArguments[] = $this->valueTransformer->translateObjectsAndResourceToString(
                $arg,
                true
            );
        }
        $convertedReturnValue = $this->valueTransformer->translateObjectsAndResourceToString(
            $returnValue
        );

        $spec = new InvocationSpec($methodName, $convertedArguments, $convertedReturnValue);

        return $spec;
    }
}
