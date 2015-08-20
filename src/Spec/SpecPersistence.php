<?php


namespace Box\TestScribe\Spec;

use Box\TestScribe\Config\GlobalComputedConfig;
use Box\TestScribe\FunctionWrappers\FileFunctionWrapper;
use Symfony\Component\Yaml\Dumper;

/**
 * Manage the spec file.
 *
 * @var GlobalComputedConfig|FileFunctionWrapper|SpecsPerClassPersistence
 */
class SpecPersistence
{
    /** @var GlobalComputedConfig */
    private $globalComputedConfig;

    /** @var FileFunctionWrapper */
    private $fileFunctionWrapper;

    /** @var SpecsPerClassPersistence */
    private $specsPerClassPersistence;

    /**
     * @param GlobalComputedConfig $globalComputedConfig
     * @param FileFunctionWrapper $fileFunctionWrapper
     * @param SpecsPerClassPersistence $specsPerClassPersistence
     */
    function __construct(
        GlobalComputedConfig $globalComputedConfig,
        FileFunctionWrapper $fileFunctionWrapper,
        SpecsPerClassPersistence $specsPerClassPersistence
    )
    {
        $this->globalComputedConfig = $globalComputedConfig;
        $this->fileFunctionWrapper = $fileFunctionWrapper;
        $this->specsPerClassPersistence = $specsPerClassPersistence;
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
        $dumper = new Dumper();
        $dumper->setIndentation(2);
        $specAsYamlString = $dumper->dump($specsArray, 5);
        
        $specFilePath = $this->globalComputedConfig->getSpecFilePath();
        $this->fileFunctionWrapper->file_put_contents($specFilePath, $specAsYamlString);
    }
}
