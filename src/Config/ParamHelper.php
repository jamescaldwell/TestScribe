<?php


namespace Box\TestScribe\Config;

use Box\TestScribe\MethodHelper;
use Box\TestScribe\PhpClass;


/**
 * @var MethodHelper
 */
class ParamHelper
{
    /** @var MethodHelper */
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
     * @return \Box\TestScribe\Method
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
