<?php
/**
 *
 */
namespace Box\TestScribe\PHPDoc;

class PHPDocResourceType extends PHPDocType
{
    /**
     * @param mixed|null $something
     *
     * @return bool
     */
    public function matches($something)
    {
        return is_resource($something);
    }

    /**
     * @return bool
     */
    public function isPrimitiveType()
    {
        return false;
    }
}
