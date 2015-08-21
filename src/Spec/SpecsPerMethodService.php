<?php


namespace Box\TestScribe\Spec;

/**
 */
class SpecsPerMethodService
{
    /**
     * Update/add a spec for a given specsPerMethod object.
     * It returns a new instance.
     *
     * @param \Box\TestScribe\Spec\SpecsPerMethod $specsPerMethod
     * @param OneSpec $oneSpec
     *
     * @return \Box\TestScribe\Spec\SpecsPerMethod
     */
    public function addOneSpec(
        SpecsPerMethod $specsPerMethod,
        OneSpec $oneSpec
    )
    {
        $testName = $oneSpec->getTestName();
        $specs = $specsPerMethod->getSpecs();
        $methodName = $specsPerMethod->getMethodName();

        $specs[$testName] = $oneSpec;

        $newSpecsPerMethod = new SpecsPerMethod($methodName, $specs);

        return $newSpecsPerMethod;
    }
}
