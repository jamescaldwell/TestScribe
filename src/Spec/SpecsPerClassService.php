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
     * @param SpecsPerClass $specsPerClass
     * @param string $methodName
     * @param OneSpec $oneSpec
     *
     * @return SpecsPerClass
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

        return $newSpecsPerMethod;
    }
}
