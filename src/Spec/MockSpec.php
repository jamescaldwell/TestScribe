<?php


namespace Box\TestScribe\Spec;


/**
 * Information about a mock object that needs to be saved.
 */
class MockSpec
{
    /** @var  string */
    private $objectName;

    /** @var  string */
    private $mockedClassName;

    /** @var  InvocationSpec[] */
    private $invocations;

    /** @var  array methodName => [returnExpressions] */
    private $returnExpressionMap = [];

    /**
     * MockSpec constructor.
     * @param string $objectName
     * @param string $mockedClassName
     * @param InvocationSpec[] $invocations
     */
    public function __construct($objectName, $mockedClassName, array $invocations)
    {
        $this->objectName = $objectName;
        $this->mockedClassName = $mockedClassName;
        $this->invocations = $invocations;
        $this->initializeReturnExpressionMap($invocations);
    }

    /**
     * @param InvocationSpec[] $invocations
     * @return void
     */
    private function initializeReturnExpressionMap(array $invocations)
    {
        foreach ($invocations as $call) {
            $methodName = $call->getMethodName();
            $returnExpression = $call->getReturnValue();
            $map = $this->returnExpressionMap;
            if (array_key_exists($methodName, $map)){
                $map[$methodName][] = $returnExpression;
            } else {
                $map[$methodName] = [$returnExpression];
            }
        }
    }

    /**
     * @return string
     */
    public function getObjectName()
    {
        return $this->objectName;
    }

    /**
     * @return string
     */
    public function getMockedClassName()
    {
        return $this->mockedClassName;
    }

    /**
     * @return InvocationSpec[]
     */
    public function getInvocations()
    {
        return $this->invocations;
    }

    /**
     * @return array
     */
    public function getReturnExpressionMap()
    {
        return $this->returnExpressionMap;
    }
}
