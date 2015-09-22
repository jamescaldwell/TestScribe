<?php


namespace Box\TestScribe\Spec;

use Box\TestScribe\Config\GlobalComputedConfig;
use Box\TestScribe\FunctionWrappers\FileFunctionWrapper;
use Box\TestScribe\Utils\FileUtil;
use Box\TestScribe\Utils\YamlUtil;

/**
 * Manage the spec file.
 *
 * @var GlobalComputedConfig|FileFunctionWrapper|SpecsPerClassPersistence|FileUtil|YamlUtil
 */
class SpecPersistence
{
    /** @var GlobalComputedConfig */
    private $globalComputedConfig;

    /** @var FileFunctionWrapper */
    private $fileFunctionWrapper;

    /** @var SpecsPerClassPersistence */
    private $specsPerClassPersistence;

    /** @var FileUtil */
    private $fileUtil;

    /** @var YamlUtil */
    private $yamlUtil;

    /**
     * @param \Box\TestScribe\Config\GlobalComputedConfig $globalComputedConfig
     * @param \Box\TestScribe\FunctionWrappers\FileFunctionWrapper $fileFunctionWrapper
     * @param \Box\TestScribe\Spec\SpecsPerClassPersistence $specsPerClassPersistence
     * @param \Box\TestScribe\Utils\FileUtil $fileUtil
     * @param \Box\TestScribe\Utils\YamlUtil $yamlUtil
     */
    function __construct(
        GlobalComputedConfig $globalComputedConfig,
        FileFunctionWrapper $fileFunctionWrapper,
        SpecsPerClassPersistence $specsPerClassPersistence,
        FileUtil $fileUtil,
        YamlUtil $yamlUtil
    )
    {
        $this->globalComputedConfig = $globalComputedConfig;
        $this->fileFunctionWrapper = $fileFunctionWrapper;
        $this->specsPerClassPersistence = $specsPerClassPersistence;
        $this->fileUtil = $fileUtil;
        $this->yamlUtil = $yamlUtil;
    }


    /**
     * @param \Box\TestScribe\Spec\SpecsPerClass $spec
     *
     * @throws \Box\TestScribe\Exception\TestScribeException
     *
     * @return void
     *
     */
    public function writeSpec(SpecsPerClass $spec)
    {
        $specsArray = $this->specsPerClassPersistence->encodeSpecsPerClass($spec);
        $specAsYamlString = $this->yamlUtil->dumpToString($specsArray);

        $specFilePath = $this->globalComputedConfig->getSpecFilePath();
        $this->fileUtil->putContent($specFilePath, $specAsYamlString);
    }

    /**
     * @return \Box\TestScribe\Spec\SpecsPerClass
     */
    public function loadSpec()
    {
        $specFilePath = $this->globalComputedConfig->getSpecFilePath();
        if ($this->fileFunctionWrapper->file_exists($specFilePath)) {
            $data = $this->yamlUtil->loadYamlFile($specFilePath);
            $specsPerClass = $this->specsPerClassPersistence->loadSpecsPerClass($data);
        } else {
            $fullClassName = $this->globalComputedConfig->getFullClassName();
            $specsPerClass = new SpecsPerClass($fullClassName, []);
        }

        return $specsPerClass;

    }
}
