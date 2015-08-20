<?php


namespace Box\TestScribe\Spec;

/**
 * @var OneSpecPersistence
 */
class SpecsPerMethodPersistence
{
    const TESTS_KEY = 'tests';
    const METHOD_NAME_KEY = 'name';

    /** @var OneSpecPersistence */
    private $oneSpecPersistence;

    /**
     * @param \Box\TestScribe\Spec\OneSpecPersistence $oneSpecPersistence
     */
    function __construct(
        OneSpecPersistence $oneSpecPersistence
    )
    {
        $this->oneSpecPersistence = $oneSpecPersistence;
    }

    /**
     * @param array $data
     *
     * @return \Box\TestScribe\Spec\SpecsPerMethod
     */
    public function loadSpecsPerMethod(array $data)
    {
        // @TODO (ryang 8/19/15) : return a default value when the key doesn't exist.
        $methodName = $data[self::METHOD_NAME_KEY];
        $specsData = $data[self::TESTS_KEY];

        $specs = [];
        foreach ($specsData as $oneSpecData) {
            $oneSpec = $this->oneSpecPersistence->loadOneSpec($oneSpecData);
            $testName = $oneSpec->getTestName();
            $specs[$testName] = $oneSpec;
        }
        $specsPerMethod = new SpecsPerMethod($methodName, $specs);


        return $specsPerMethod;
    }

    /**
     * @param \Box\TestScribe\Spec\SpecsPerMethod $spec
     *
     * @return array
     */
    public function encodeSpecsPerMethod(SpecsPerMethod $spec)
    {
        $methodName = $spec->getMethodName();

        $specs = $spec->getSpecs();
        $values = array_values($specs);
        $encodedSpecs = [];
        foreach ($values as $oneSpec) {
            $encodedOneSpec = $this->oneSpecPersistence->encodeOneSpec($oneSpec);
            $encodedSpecs[] = $encodedOneSpec;
        }

        $encoded = [
            self::METHOD_NAME_KEY => $methodName,
            self::TESTS_KEY => $encodedSpecs
        ];

        return $encoded;
    }
}
