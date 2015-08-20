<?php

namespace Box\TestScribe\Spec;

/**
 */
class OneSpecPersistence
{
    const RESULT_KEY = 'result';
    const TEST_NAME = 'name';

    /**
     * @param array  $data
     *
     * @return \Box\TestScribe\Spec\OneSpec
     */
    public function loadOneSpec(array $data)
    {
        $testName = $data[self::TEST_NAME];
        $result = $data[self::RESULT_KEY];

        $oneSpec = new OneSpec($testName, $result);

        return $oneSpec;
    }

    /**
     * @param \Box\TestScribe\Spec\OneSpec $spec
     *
     * @return array
     */
    public function encodeOneSpec(OneSpec $spec)
    {
        $testName = $spec->getTestName();
        $result = $spec->getResult();

        $encoded = [
            self::TEST_NAME => $testName,
            self::RESULT_KEY => $result
        ];

        return $encoded;
    }
}
