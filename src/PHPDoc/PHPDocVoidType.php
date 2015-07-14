<?php
/**
 *
 */
namespace Box\TestScribe\PHPDoc;

/**
 * Class PHPDocVoidType
 * @package Box\TestScribe\PHPDoc
 */
class PHPDocVoidType extends PHPDocType
{
    /**
     * @param mixed|null $something
     *
     * @return bool
     */
    public function matches($something)
    {
        return false; // no value can match void
    }

    /**
     * @return bool
     */
    public function matchesVoid()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isPrimitiveType()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isVoid()
    {
        return true;
    }
}
