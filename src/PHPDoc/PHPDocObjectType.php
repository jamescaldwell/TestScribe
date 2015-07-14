<?php
/**
 *
 */
namespace Box\TestScribe\PHPDoc;

class PHPDocObjectType extends PHPDocType
{
    /**
     * @param mixed|null $something
     *
     * @return bool
     */
    public function matches($something)
    {
        return is_object($something);
    }

    /**
     * @return bool
     */
    public function isPrimitiveType()
    {
        return false;
    }
}
