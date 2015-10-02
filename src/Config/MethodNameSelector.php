<?php


namespace Box\TestScribe\Config;

use Box\TestScribe\ClassInfo\ClassUtil;
use Box\TestScribe\Exception\TestScribeException;
use Box\TestScribe\Input\MenuSelector;

/**
 */
class MethodNameSelector
{
    /** @var ClassUtil */
    private $classUtil;

    /** @var MenuSelector */
    private $menuSelector;

    /**
     * @param \Box\TestScribe\ClassInfo\ClassUtil $classUtil
     * @param \Box\TestScribe\Input\MenuSelector $menuSelector
     */
    function __construct(
        ClassUtil $classUtil,
        MenuSelector $menuSelector
    )
    {
        $this->classUtil = $classUtil;
        $this->menuSelector = $menuSelector;
    }

    /**
     * @param string $fullClassName
     *
     * @return string
     * @throws \Box\TestScribe\Exception\TestScribeException
     */
    public function selectTestMethodName(
        $fullClassName
    )
    {
        $methodNames = $this->classUtil->getMethodNames($fullClassName);
        $numOfMethods = count($methodNames);
        if ($numOfMethods === 0) {
            $msg = "The target class ($fullClassName) has no method.";
            throw new TestScribeException($msg);
        }

        if ($numOfMethods === 1) {
            $methodName = $methodNames[0];
        } else {
            $selectionId = $this->menuSelector->selectFromMenu(
                $methodNames,
                "Select a method from the class ( $fullClassName )."
            );
            $methodName = $methodNames[$selectionId];
        }

        return $methodName;
    }
}
