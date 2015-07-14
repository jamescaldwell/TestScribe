<?php
/**
 *
 */
namespace Box\TestScribe\PHPDoc;

class PHPDocArrayOfType extends PHPDocType
{
    /**
     * @param PHPDocType $nested_type the elemental type of the array
     */
    public function __construct(PHPDocType $nested_type)
    {
        if ($nested_type->matchesVoid()) {
            throw new PHPDocTypeException("'void[]' - Array of void is illegal.");
        }
        $this->nested_type = $nested_type;
    }

    /**
     * @param mixed|null $something
     *
     * @return bool
     */
    public function matches($something)
    {
        if (is_array($something)) {
            foreach ($something as $nested) {
                if (!$this->nested_type->matches($nested)) {
                    return false;
                }
            }

            return true;
        }

        return false;
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
    public function isArray()
    {
        return true;
    }
}
