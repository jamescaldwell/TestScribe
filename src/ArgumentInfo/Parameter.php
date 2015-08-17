<?php


namespace Box\TestScribe\ArgumentInfo;

/**
 * Wrapper over ReflectionParameter
 * to have better control over PHPDocs.
 *
 * Our current PHPDoc parser can't get the type information correctly
 * from the builtin class.
 */
class Parameter
{
    /** @var  \ReflectionParameter */
    private $paramObj;

    /**
     * @param \ReflectionParameter $paramObj
     */
    function __construct(
        \ReflectionParameter $paramObj
    )
    {
        $this->paramObj = $paramObj;
    }

    /**
   	 * (PHP 5)<br/>
   	 * Gets parameter name
   	 * @link http://php.net/manual/en/reflectionparameter.getname.php
   	 * @return string The name of the reflected parameter.
   	 */
   	public function getName ()
    {
        $name = $this->paramObj->getName();

        return $name;
    }
}
