<?php


namespace Box\TestScribe\Spec;

use Box\TestScribe\Config\ConfigParams;
use Box\TestScribe\Config\StaticConfigHelper;


/**
 * Stateful class that holds information about the existing tests/specs
 * @var specPersistence
 */
class SavedSpecs
{
    /** @var  SpecsPerClass */
    private $specPerClass;

    /** @var  string */
    private $specFilePath;

    /** @var specPersistence */
    private $specPersistence;

    /**
     * @param \Box\TestScribe\Spec\specPersistence $specPersistence
     */
    function __construct(
        specPersistence $specPersistence
    )
    {
        $this->specPersistence = $specPersistence;
    }

    /**
     * Load and save the existing tests/specs into the member variable.
     * Call this method first before using other methods of this class.
     *
     * @param \Box\TestScribe\Config\ConfigParams $inputParams
     * @param string $outSourceFileDir
     *
     * @return \Box\TestScribe\Spec\SpecsPerClass
     */
    public function loadExistingSpecs(
        ConfigParams $inputParams,
        $outSourceFileDir
    )
    {
        $specFilePath = StaticConfigHelper::computeSpecFilePath(
            $inputParams->getPhpClassName(),
            $outSourceFileDir
        );

        $this->specFilePath = $specFilePath;

        $inFullClassName = $inputParams->getFullClassName();
        $this->specPerClass = $this->specPersistence->loadSpec(
            $specFilePath,
            $inFullClassName
        );

        return $this->specPerClass;
    }

    /**
     * @return \Box\TestScribe\Spec\SpecsPerClass
     */
    public function getSpecPerClass()
    {
        return $this->specPerClass;
    }

    /**
     * @return string
     */
    public function getSpecFilePath()
    {
        return $this->specFilePath;
    }

    /**
     * Save a new spec to the spec file.
     * Overwrite the existing file if any.
     *
     * @param \Box\TestScribe\Spec\SpecsPerClass $spec
     *
     * @return void
     */
    public function saveNewSpec(SpecsPerClass $spec)
    {
        $this->specPersistence->writeSpec($spec, $this->specFilePath);
    }
}
