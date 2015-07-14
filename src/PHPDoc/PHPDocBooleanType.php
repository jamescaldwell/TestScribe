<?php
/**
 *
 */
namespace Box\TestScribe\PHPDoc;

class PHPDocBooleanType extends PHPDocType
{

    /**
     * @param mixed|null $something
     *
     * @return bool
     */
    public function matches($something)
    {
        return is_bool($something);
    }

    /**
     * @return bool
     */
    public function isPrimitiveType()
    {
        return true;
    }
}
