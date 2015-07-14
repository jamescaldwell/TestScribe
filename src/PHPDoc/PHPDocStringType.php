<?php
/**
 *
 */
namespace Box\TestScribe\PHPDoc;

class PHPDocStringType extends PHPDocType
{
    /**
     * @param mixed|null $something
     *
     * @return bool
     */
    public function matches($something)
    {
        return is_string($something);
    }

    /**
     * @return bool
     */
    public function isPrimitiveType()
    {
        return true;
    }
}
