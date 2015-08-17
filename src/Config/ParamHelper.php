<?php


namespace Box\TestScribe\Config;

use Box\TestScribe\MethodInfo\MethodHelper;
use Box\TestScribe\ClassInfo\PhpClass;


/**
 * @var \Box\TestScribe\MethodInfo\MethodHelper
 */
class ParamHelper
{
    /** @var \Box\TestScribe\MethodInfo\MethodHelper */
    private $methodHelper;

    function __construct(
        MethodHelper $methodHelper
    )
    {
        $this->methodHelper = $methodHelper;
    }

    /**
     * @param \Box\TestScribe\Config\ConfigParams $params
     *
     * @return \Box\TestScribe\MethodInfo\Method
     */
    public function getMethodObjFromParamObj(
        ConfigParams $params
    )
    {
        $inPhpClassName = $params->getPhpClassName();
        $inPhpClass = new PhpClass($inPhpClassName);
        $methodName = $params->getMethodName();
        $inMethodObj = $this->methodHelper->createFromMethodName($inPhpClass, $methodName);

        return $inMethodObj;
    }
}
