<?php


namespace Box\TestScribe\Spec;


/**
 * Information about a mocked method invocation.
 */
class InvocationSpec
{
    /** @var  string */
    private $methodName;

    /**
     * @var  array
     *
     * Mock objects are replaced by its fully qualified mocked class names.
     * e.g. [ 'key' => $mockedFooClass ] becomes
     * [ 'key' => \FooClass ]
     */
    private $parameters;

    /**
     * @var  mixed
     * Mock objects are replaced in a similar way as parameters.
     */
    private $returnValue;

    /**
     * InvocationSpec constructor.
     * @param string $methodName
     * @param array $parameters
     * @param mixed $returnValue
     */
    public function __construct($methodName, array $parameters, $returnValue)
    {
        $this->methodName = $methodName;
        $this->parameters = $parameters;
        $this->returnValue = $returnValue;
    }

    /**
     * @return string
     */
    public function getMethodName()
    {
        return $this->methodName;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @return mixed
     */
    public function getReturnValue()
    {
        return $this->returnValue;
    }
}
