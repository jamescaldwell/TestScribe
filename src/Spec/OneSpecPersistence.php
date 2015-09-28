<?php

namespace Box\TestScribe\Spec;

/**
 */
class OneSpecPersistence
{
    const RESULT_KEY = 'result';
    const TEST_NAME = 'name';
    const METHOD_PARAM = 'param';

    /**
     * @param array  $data
     *
     * @return \Box\TestScribe\Spec\OneSpec
     */
    public function loadOneSpec($data)
    {
        $testName = $data[self::TEST_NAME];
        $result = $data[self::RESULT_KEY];
        $methodParameters = $data[self::METHOD_PARAM];

        $oneSpec = new OneSpec($testName, $result, $methodParameters);

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
        $methodParameters = $spec->getMethodParameters();

        $encoded = [
            self::TEST_NAME => $testName,
            self::RESULT_KEY => $result,
            self::METHOD_PARAM => $methodParameters
        ];

        return $encoded;
    }
}
