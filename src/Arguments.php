<?php
/**
 *
 */

namespace Box\TestScribe;

use Box\TestScribe\Input\InputValue;
use Box\TestScribe\Mock\MockClass;

/**
 * Class Arguments
 * @package Box\TestScribe
 *
 * All arguments to a method.
 */
class Arguments implements \JsonSerializable
{
    /**
     * @var InputValue[]
     */
    private $args;

    /**
     * @param InputValue[] $args
     */
    function __construct(array $args)
    {
        $this->args = $args;
    }

    /**
     * Return the underlining values of all the arguments as an array.
     *
     * @return mixed[]
     */
    public function getValues()
    {
        $values = [];
        foreach ($this->args as $arg) {
            $value = $arg->getValue();
            $values[] = $value;
        }

        return $values;
    }

    /**
     * Get the expressions of all the arguments.
     *
     * @return string[]
     */
    public function getExpressions()
    {
        $expressions = [];

        foreach ($this->args as $arg) {
            $expression = $arg->getExpression();
            $expressions[] = $expression;
        }

        return $expressions;
    }

    /**
     * Get all the mocks referenced in the argument list.
     *
     * @return MockClass[]
     */
    public function getMocks()
    {
        $allMocks = [];

        foreach ($this->args as $arg) {
            $mocks = $arg->getMocks();
            $allMocks = array_merge($allMocks, $mocks);
        }

        return $allMocks;
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    function jsonSerialize()
    {
        $expressions = $this->getExpressions();

        return $expressions;
    }
}
