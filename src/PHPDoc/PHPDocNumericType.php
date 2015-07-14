<?php
/**
 *
 */
namespace Box\TestScribe\PHPDoc;

class PHPDocNumericType extends PHPDocType
{
    /**
     * @param mixed|null $something
     *
     * @return bool
     */
    public function matches($something)
    {
        return is_numeric($something);
    }

    /**
     * @return bool
     */
    public function isPrimitiveType()
    {
        return true;
    }
}
