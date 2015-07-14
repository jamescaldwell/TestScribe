<?php
/**
 *
 */
namespace Box\TestScribe\PHPDoc;

class PHPDocNullType extends PHPDocType
{

    /**
     * @param mixed|null $something
     *
     * @return bool
     */
    public function matches($something)
    {
        return $something === null;
    }

    /**
     * @return bool
     */
    public function isPrimitiveType()
    {
        return true;
    }
}
