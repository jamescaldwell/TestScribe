<?php
/**
 *
 */

namespace Box\TestScribe;

/**
 * Class ExpressionWithMocks
 *
 * Represents an expression.
 * If the expression contains reference to mock objects,
 * the referenced mock objects are included as part of the object.
 *
 * @package Box\TestScribe
 */
class ExpressionWithMocks implements \JsonSerializable
{
    /**
     * @var string
     *
     * An expression that potentially references the mock objects defined in $mocks if any.
     */
    private $expression;

    /**
     * @var MockClass[]
     */
    private $mocks;

    /**
     * @param string                                $str
     * @param \Box\TestScribe\MockClass[] $mocks
     */
    public function __construct($str, array $mocks)
    {
        $this->expression = $str;
        $this->mocks = $mocks;
    }

    /**
     * @return string
     */
    public function getExpression()
    {
        return $this->expression;
    }

    /**
     * @return \Box\TestScribe\MockClass[]
     */
    public function getMocks()
    {
        return $this->mocks;
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
        $mockClassStrArray = [];
        foreach ($this->mocks as $mockClass) {
            $mockClassStrArray[] = $mockClass->__toString();
        }

        $result = [
            'expression' => $this->expression,
            'mocks' => $mockClassStrArray
        ];

        return $result;
    }
}
