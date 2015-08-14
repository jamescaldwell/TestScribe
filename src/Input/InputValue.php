<?php
/**
 *
 */

namespace Box\TestScribe\Input;

/**
 * Class InputValue
 * @package Box\TestScribe
 * 
 * Represent a value supplied by users.
 */
class InputValue implements \JsonSerializable
{
    /**
     * @var bool
     * true if the value represents a special value void
     * i.e. void in return value or an optional parameter.
     */
    private $isVoid;
    
    /**
     * @var mixed
     */
    private $value;
    
    /**
     * @var ExpressionWithMocks
     */
    private $expressionWithMocks;

    /**
     * Warning: Don't construct this instance directly.
     * Use factory methods @see InputValueFactory instead.
     * 
     * @param                                               $value
     * @param \Box\TestScribe\Input\ExpressionWithMocks $expressionWithMocks
     */
    function __construct($isVoid, $value, ExpressionWithMocks $expressionWithMocks)
    {
        $this->isVoid = $isVoid;
        $this->value = $value;
        $this->expressionWithMocks = $expressionWithMocks;
    }
    
    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return \Box\TestScribe\Mock\MockClass[]
     */
    public function getMocks()
    {
        return $this->expressionWithMocks->getMocks();
    }

    /**
     * @return string
     */
    public function getExpression()
    {
        return $this->expressionWithMocks->getExpression();
    }

    /**
     * @return boolean
     */
    public function isVoid()
    {
        return $this->isVoid;
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
        $result = $this->expressionWithMocks->getExpression();

        return $result;
    }
}
