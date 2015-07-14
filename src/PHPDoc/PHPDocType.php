<?php

namespace Box\TestScribe\PHPDoc;

/**
 * Class PHPDocType
 * @package Box\TestScribe\PHPDoc
 */
abstract class PHPDocType implements IPhpDoc
{
    /**
     * Single type
     * @var PHPDocType $type
     */
    protected $type;

    /**
     * for composite types
     * @var PHPDocType[] $types;
     */
    protected $types;

    /**
     * @return PHPDocType
     */
    public static function unknown()
    {
        return PHPDocType::lookup('mixed|null');
    }

    /**
     * @return PHPDocType
     */
    public static function mixed()
    {
        return PHPDocType::lookup('mixed');
    }

    /**
     * @return PHPDocType
     */
    public static function void()
    {
        return PHPDocType::lookup('void');
    }

    /**
     * @param string $string_representation
     * @return PHPDocType
     */
    public static function lookup($string_representation)
    {
        $parser = new PHPDocParser($string_representation);
        return $parser->parse();
    }

    private $string_representation = null;

    /**
     * @param string
     * @return void
     */
    public function setRepresentation($representation)
    {
        $this->string_representation = $representation;
    }

    /**
     * @return string
     */
    public function getRepresentation()
    {
        return $this->__toString();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->string_representation ?: "<unknown type>";
    }

    /**
     * @param mixed $something
     * @return boolean
     */
    abstract public function matches($something);

    /**
     * @return boolean whether or not this type accepts void, that is, the absence of a value.
     * Note this is not the same as null.
     *
     * - When a variable has the value null, it means that the variable isn't referring to any object.
     * - A void method is a method that doesn't return a value. A void parameter is one that may not be passed at all.
     */
    public function matchesVoid()
    {
        return false;
    }
    
    /**
     * @return bool
     */
    public function isVoid()
    {
        return false;
    }

    /**
     * @return boolean whether this type is variadic. Variadic types specify the value of more than one
     * argument to a function.
     */
    public function isVariadic()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isClass()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isComposite()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isArray()
    {
        return false;
    }

    /**
     * returns whether the phpDocType is of type:
     * int, bool, string, float, null, void, array
     * @return boolean
     */
    abstract public function isPrimitiveType();

    /**
     * @return PHPDocType[]
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @return PHPDocType
     */
    public function getType()
    {
        return $this->type;
    }

}
