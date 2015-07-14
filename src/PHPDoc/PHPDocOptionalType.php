<?php
/**
 *
 */
namespace Box\TestScribe\PHPDoc;

class PHPDocOptionalType extends PHPDocType
{
    /**
     * @param PHPDocType $type
     *
     * @throws PHPDocTypeException
     */
    public function __construct(PHPDocType $type)
    {
        if ($type->matchesVoid()) {
            throw new PHPDocTypeException("'void?' - Optional void types are illegal.");
        }
        $this->type = $type;
    }

    /**
     * @param mixed|null $something
     *
     * @return bool
     */
    public function matches($something)
    {
        if ($something === null) {
            return true;
        }

        return $this->type->matches($something);
    }

    /**
     * @return bool
     */
    public function isPrimitiveType()
    {
        return false;
    }
}
