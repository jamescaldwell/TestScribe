<?php
/**
 *
 */
namespace Box\TestScribe\PHPDoc;

class PHPDocCompositeType extends PHPDocType
{
    /**
     * @param PHPDocType[] $types
     */
    public function __construct(array $types)
    {
        $this->types = $this->flattenTypes($types);
    }

    /**
     * @param mixed|null $something
     *
     * @return bool
     */
    public function matches($something)
    {
        foreach ($this->types as $type) {
            if ($type->matches($something)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function matchesVoid()
    {
        $any_matched = false;
        foreach ($this->types as $type) {
            $any_matched = $any_matched || $type->matchesVoid();
        }

        return $any_matched;
    }

    /**
     * @return bool
     */
    public function isComposite()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isPrimitiveType()
    {
        return false;
    }

    /**
     * The phpDocParser returns nested composite types, i.e:
     * for types int|string|null we would have:
     *      PHPDocComposite(int, PHPDocComposite(string, null) );
     * For application usability, we would like to flatten the array one time
     *
     * @param PHPDocType[] $types
     *
     * @return PHPDocType[];
     */
    private function flattenTypes($types)
    {
        $flatTypes = [];
        foreach ($types as $type) {
            if ($type->isComposite()) {
                $flatTypes = array_merge($flatTypes, $this->flattenTypes($type->getTypes()));
            } else {
                $flatTypes[] = $type;
            }
        }

        return $flatTypes;
    }
}
