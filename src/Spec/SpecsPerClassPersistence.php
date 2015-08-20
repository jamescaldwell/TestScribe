<?php


namespace Box\TestScribe\Spec;


/**
 * @var SpecsPerMethodPersistence
 */
class SpecsPerClassPersistence
{
    const METHODS_KEY = 'methods';
    const CLASS_NAME_KEY = 'full_class_name';

    /** @var SpecsPerMethodPersistence */
    private $specsPerMethodPersistence;

    /**
     * @param \Box\TestScribe\Spec\SpecsPerMethodPersistence $specsPerMethodPersistence
     */
    function __construct(
        SpecsPerMethodPersistence $specsPerMethodPersistence
    )
    {
        $this->specsPerMethodPersistence = $specsPerMethodPersistence;
    }

    /**
     * @param array $data
     *
     * @return \Box\TestScribe\Spec\SpecsPerClass
     */
    public function loadSpecsPerClass($data)
    {
        // @TODO (ryang 8/19/15) : return a default value when the key doesn't exist.
        $fullClassName = $data[self::CLASS_NAME_KEY];

        $specsData = $data[self::METHODS_KEY];
        $specs = [];
        foreach ($specsData as $oneSpecData) {
            $specsPerMethod = $this->specsPerMethodPersistence->loadSpecsPerMethod($oneSpecData);
            $methodName = $specsPerMethod->getMethodName();
            $specs[$methodName] = $specsPerMethod;
        }

        $SpecsPerClass = new SpecsPerClass($fullClassName, $specs);

        return $SpecsPerClass;
    }

    /**
     * @param \Box\TestScribe\Spec\SpecsPerClass $spec
     *
     * @return array
     */
    public function encodeSpecsPerClass(SpecsPerClass $spec)
    {
        $fullClassName = $spec->getFullClassName();

        $specs = $spec->getSpecs();
        $encodedSpecs = [];
        $values = array_values($specs);
        foreach ($values as $oneSpecsPerMethod) {
            $encodedSpecsPerMethod = $this->specsPerMethodPersistence->encodeSpecsPerMethod($oneSpecsPerMethod);
            $encodedSpecs[] = $encodedSpecsPerMethod;
        }

        $encoded = [
            self::CLASS_NAME_KEY => $fullClassName,
            self::METHODS_KEY => $encodedSpecs
        ];

        return $encoded;
    }
}
