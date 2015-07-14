<?php
/**
 *
 */
namespace Box\TestScribe\PHPDoc;

class PHPDocFloatType extends PHPDocType
{
    /**
     * @param mixed|null $something
     *
     * @return bool
     */
    public function matches($something)
    {
        return is_float($something);
    }

    /**
     * @return bool
     */
    public function isPrimitiveType()
    {
        return true;
    }
}
