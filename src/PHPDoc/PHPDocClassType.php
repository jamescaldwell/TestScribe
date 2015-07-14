<?php
/**
 *
 */
namespace Box\TestScribe\PHPDoc;

class PHPDocClassType extends PHPDocType
{
    /**
     * @param string $classname the classname to verify
     */
    public function __construct($classname)
    {
        $this->classname = $classname;
    }

    /**
     * @param mixed|null $candidate
     *
     * @return bool
     */
    public function matches($candidate)
    {
        $class_required = $this->classname;
        $subclass_allowed = false;
        if ($this->classname == 'Box_Item') {
            $class_required = 'Box_Item_Interface';
            $subclass_allowed = true;
        }
        if (is_object($candidate) && strpos(get_class($candidate), 'Mock_') === 0) {
            $subclass_allowed = true;
        }
        if ($subclass_allowed) {
            return ($candidate instanceof $class_required);
        } else {
            return is_a($candidate, $class_required);
        }
    }

    /**
     * @return bool
     */
    public function isPrimitiveType()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isClass()
    {
        return true;
    }
}
