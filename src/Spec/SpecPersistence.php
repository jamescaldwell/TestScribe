<?php


namespace Box\TestScribe\Spec;

use Box\TestScribe\FunctionWrappers\FileFunctionWrapper;
use Box\TestScribe\Utils\FileUtil;
use Box\TestScribe\Utils\YamlUtil;

/**
 * Manage the spec file.
 *
 * @var FileFunctionWrapper|SpecsPerClassPersistence|FileUtil|YamlUtil
 */
class SpecPersistence
{
    /** @var FileFunctionWrapper */
    private $fileFunctionWrapper;

    /** @var SpecsPerClassPersistence */
    private $specsPerClassPersistence;

    /** @var FileUtil */
    private $fileUtil;

    /** @var YamlUtil */
    private $yamlUtil;

    /**
     * @param \Box\TestScribe\FunctionWrappers\FileFunctionWrapper $fileFunctionWrapper
     * @param \Box\TestScribe\Spec\SpecsPerClassPersistence $specsPerClassPersistence
     * @param \Box\TestScribe\Utils\FileUtil $fileUtil
     * @param \Box\TestScribe\Utils\YamlUtil $yamlUtil
     */
    function __construct(
        FileFunctionWrapper $fileFunctionWrapper,
        SpecsPerClassPersistence $specsPerClassPersistence,
        FileUtil $fileUtil,
        YamlUtil $yamlUtil
    )
    {
        $this->fileFunctionWrapper = $fileFunctionWrapper;
        $this->specsPerClassPersistence = $specsPerClassPersistence;
        $this->fileUtil = $fileUtil;
        $this->yamlUtil = $yamlUtil;
    }


    /**
     * @param \Box\TestScribe\Spec\SpecsPerClass $spec
     *
     * @param string $specFilePath
     *
     * @return void
     */
    public function writeSpec(SpecsPerClass $spec, $specFilePath)
    {
        $specsArray = $this->specsPerClassPersistence->encodeSpecsPerClass($spec);
        $specAsYamlString = $this->yamlUtil->dumpToString($specsArray);

        $this->fileUtil->putContent($specFilePath, $specAsYamlString);
    }

    /**
     * @param string $specFilePath
     *
     * @param string $fullClassName
     *
     * @return \Box\TestScribe\Spec\SpecsPerClass
     */
    public function loadSpec($specFilePath, $fullClassName)
    {
        if ($this->fileFunctionWrapper->file_exists($specFilePath)) {
            $data = $this->yamlUtil->loadYamlFile($specFilePath);
            $specsPerClass = $this->specsPerClassPersistence->loadSpecsPerClass($data);
        } else {
            $specsPerClass = new SpecsPerClass($fullClassName, []);
        }

        return $specsPerClass;
    }
}
