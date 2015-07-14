<?php
/**
 *
 */
namespace Box\TestScribe\PHPDoc;

class PHPDocIntegerType extends PHPDocType
{
    /**
     * @param mixed|null $something
     *
     * @return bool
     */
    public function matches($something)
    {
        return is_integer($something);
    }

    /**
     * @return bool
     */
    public function isPrimitiveType()
    {
        return true;
    }
}
