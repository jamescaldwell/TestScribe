<?php


namespace Box\TestScribe\Spec;

/**
 * @var SpecsPerMethodService
 */
class SpecsPerClassService
{
    /** @var SpecsPerMethodService */
    private $specsPerMethodService;

    /**
     * @param \Box\TestScribe\Spec\SpecsPerMethodService $specsPerMethodService
     */
    function __construct(
        SpecsPerMethodService $specsPerMethodService
    )
    {
        $this->specsPerMethodService = $specsPerMethodService;
    }

    /**
     * Update/add a spec for a given specsPerClass object.
     * It returns a new instance.
     *
     * @param \Box\TestScribe\Spec\SpecsPerClass $specsPerClass
     * @param string $methodName
     * @param OneSpec $oneSpec
     *
     * @return \Box\TestScribe\Spec\SpecsPerClass
     */
    public function addOneSpec(
        SpecsPerClass $specsPerClass,
        $methodName,
        OneSpec $oneSpec
    )
    {
        $specsPerMethod = $specsPerClass->getSpecsPerMethodByName($methodName);
        $newSpecsPerMethod = $this->specsPerMethodService->addOneSpec(
            $specsPerMethod,
            $oneSpec
        );
        $specs = $specsPerClass->getSpecs();
        $fullClassName = $specsPerClass->getFullClassName();
        $specs[$methodName] = $newSpecsPerMethod;
        $newSpecsPerClass = new SpecsPerClass($fullClassName, $specs);

        return $newSpecsPerClass;
    }
}
