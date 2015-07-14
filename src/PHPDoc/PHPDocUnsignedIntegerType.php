<?php
/**
 *
 */
namespace Box\TestScribe\PHPDoc;

class PHPDocUnsignedIntegerType extends PHPDocType
{
    /**
     * @param mixed|null $something
     *
     * @return bool
     */
    public function matches($something)
    {
        return is_integer($something) && $something >= 0;
    }

    /**
     * @return bool
     */
    public function isPrimitiveType()
    {
        return true;
    }
}
