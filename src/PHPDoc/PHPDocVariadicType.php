<?php
/**
 *
 */
namespace Box\TestScribe\PHPDoc;

class PHPDocVariadicType extends PHPDocType
{
    private $elemental_type = null;

    /**
     * @param PHPDocType $elemental the elemental type
     */
    public function __construct($elemental)
    {
        $this->elemental_type = $elemental;
    }

    /**
     * @param mixed|null $something
     *
     * @return bool
     */
    public function matches($something)
    {
        return $this->elemental_type->matches($something);
    }

    /**
     * @return bool
     */
    public function isVariadic()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isPrimitiveType()
    {
        return false;
    }
}
