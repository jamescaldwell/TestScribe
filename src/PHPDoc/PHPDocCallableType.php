<?php
/**
 *
 */
namespace Box\TestScribe\PHPDoc;

class PHPDocCallableType extends PHPDocType
{
    /**
     * @param mixed|null $something
     *
     * @return bool
     */
    public function matches($something)
    {
        return is_callable($something);
    }

    /**
     * @return bool
     */
    public function isPrimitiveType()
    {
        return false;
    }
}
