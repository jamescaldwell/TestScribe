<?php

namespace Box\TestScribe\Spec;

use Box\TestScribe\Utils\ArrayUtil;

/**
 */
class OneSpecPersistence
{
    const RESULT_KEY = 'result';
    const TEST_NAME = 'name';
    const METHOD_PARAM = 'param';
    const CONSTRUCTOR_PARAM = 'constructor_param';


    /**
     * @param array $data
     *
     * @return \Box\TestScribe\Spec\OneSpec
     */
    public function loadOneSpec($data)
    {
        $testName = $data[self::TEST_NAME];
        $methodParameters = $data[self::METHOD_PARAM];
        $result = $data[self::RESULT_KEY];
        $constructorParameters = ArrayUtil::lookupValueByKey(
            self::CONSTRUCTOR_PARAM,
            $data,
            []
        );

        $oneSpec = new OneSpec(
            $testName,
            $result,
            $constructorParameters,
            $methodParameters
        );

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
        $constructorParameters = $spec->getConstructorParameters();

        $encoded = [
            self::TEST_NAME => $testName
        ];

        if ($constructorParameters) {
            $encoded[self::CONSTRUCTOR_PARAM] = $constructorParameters;
        }

        $encoded[self::METHOD_PARAM] = $methodParameters;
        $encoded[self::RESULT_KEY] = $result;

        return $encoded;
    }
}
