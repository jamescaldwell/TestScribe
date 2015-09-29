<?php


namespace Box\TestScribe\Config;

use Box\TestScribe\ClassInfo\PhpClassName;


/**
 */
class StaticConfigHelper
{
    /**
     * @param \Box\TestScribe\ClassInfo\PhpClassName $inPhpClassName
     * @param string $outSourcePath
     *
     * @return string
     */
    static public function computeSpecFilePath(
        PhpClassName $inPhpClassName,
        $outSourcePath
    )
    {
        $inClassName = $inPhpClassName->getClassName();
        $specFilePath = $outSourcePath . DIRECTORY_SEPARATOR . $inClassName . '_ts.yaml';

        return $specFilePath;
    }

}
