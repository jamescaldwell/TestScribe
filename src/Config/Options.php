<?php

namespace Box\TestScribe\Config;

/**
 * Represents other inputs user specifies
 */
class Options
{
    /**
     * @var bool
     */
    private $overwriteExistingDestinationFile;

    /**
     * @var string
     */
    private $testRootPath;

    /**
     * @var string
     */
    private $sourceRootPath;

    /**
     * @var string
     */
    private $outSourceFileDir;

    /**
     * @var string
     */
    private $sourceFilePathRelativeToSourceRoot;

    /**
     * @var bool
     */
    private $generateSpec;

    /** @var  string */
    private $testBaseClassName;

    /**
     * @param string $overwriteExistingDestinationFile
     * @param string $testRootPath
     * @param string $sourceRootPath
     * @param string $outSourceFileDir
     * @param string $sourceFilePathRelativeToSourceRoot
     * @param bool   $generateSpec
     * @param string $testBaseClassName
     */
    function __construct(
        $overwriteExistingDestinationFile,
        $testRootPath,
        $sourceRootPath,
        $outSourceFileDir,
        $sourceFilePathRelativeToSourceRoot,
        $generateSpec,
        $testBaseClassName
    )
    {
        $this->overwriteExistingDestinationFile = $overwriteExistingDestinationFile;
        $this->testRootPath = $testRootPath;
        $this->sourceRootPath = $sourceRootPath;
        $this->outSourceFileDir = $outSourceFileDir;
        $this->sourceFilePathRelativeToSourceRoot = $sourceFilePathRelativeToSourceRoot;
        $this->generateSpec = $generateSpec;
        $this->testBaseClassName = $testBaseClassName;
    }

    /**
     * @return boolean
     */
    public function isOverwriteExistingDestinationFile()
    {
        return $this->overwriteExistingDestinationFile;
    }

    /**
     * @return string
     */
    public function getTestRootPath()
    {
        return $this->testRootPath;
    }

    /**
     * @return string
     */
    public function getSourceRootPath()
    {
        return $this->sourceRootPath;
    }

    /**
     * @return string
     */
    public function getOutSourceFileDir()
    {
        return $this->outSourceFileDir;
    }

    /**
     * @return string
     */
    public function getSourceFilePathRelativeToSourceRoot()
    {
        return $this->sourceFilePathRelativeToSourceRoot;
    }

    /**
     * @return boolean
     */
    public function isGenerateSpec()
    {
        return $this->generateSpec;
    }

    /**
     * @return string
     */
    public function getTestBaseClassName()
    {
        return $this->testBaseClassName;
    }
}
