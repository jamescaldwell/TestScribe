<?php
/**
 *
 */

namespace Box\TestScribe;

/**
 * Class ClassValue
 * @package Box\TestScribe
 *
 * Represents a validated PHP class
 *
 * Always use the factory methods to create instances of this class
 * in the production code. The factory methods provide
 * additional verifications.
 *
 * We could have combined the factory class with this one
 * and made the constructor private.
 * The constructor is not made private to make it easier to unit
 * test this class.
 */
class ClassValue 
{
    private $fullClassName;

    /**
     * @param string $fullClassName fully qualified class name
     */
    function __construct($fullClassName)
    {
        $this->fullClassName = $fullClassName;
    }

    /**
     * @return string
     */
    public function getFullClassName()
    {
        return $this->fullClassName;
    }


}
