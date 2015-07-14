<?php
/**
 *
 */

namespace Box\TestScribe\PHPDoc;

/**
 * Interface IPhpDoc
 * @package Box\TestScribe\PHPDoc
 */
interface IPhpDoc {
    /**
     * @return string
     */
    public function getRepresentation();
    
    /**
     * @return bool
     */
    public function isVoid();

    /**
     * @return boolean whether this type is variadic. Variadic types specify the value of more than one
     * argument to a function.
     */
    public function isVariadic();

    /**
     * @return bool
     */
    public function isClass();
    
    /**
     * @return bool
     */
    public function isComposite();
    
    /**
     * @return bool
     */
    public function isArray();

    /**
     * returns whether the phpDocType is of type:
     * int, bool, string, float, null, void, array
     * @return boolean
     */
    public function isPrimitiveType();

    /**
     * @return PHPDocType[]
     */
    public function getTypes();

    /**
     * @return PHPDocType
     */
    public function getType();
}
