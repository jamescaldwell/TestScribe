<?php

namespace Box\TestScribe\Spec;

use Box\TestScribe\Utils\ArrayUtil;

/**
 * @var MockSpecPersistence
 */
class OneSpecPersistence
{
    const RESULT_KEY = 'result';
    const TEST_NAME = 'name';
    const METHOD_PARAM = 'param';
    const CONSTRUCTOR_PARAM = 'constructor_param';
    const MOCK = 'mock';

    /** @var MockSpecPersistence */
    private $mockSpecPersistence;

    /**
     * @param MockSpecPersistence $mockSpecPersistence
     */
    function __construct(
        MockSpecPersistence $mockSpecPersistence
    )
    {
        $this->mockSpecPersistence = $mockSpecPersistence;
    }

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
        $mocksData = ArrayUtil::lookupValueByKey(
            self::MOCK,
            $data,
            []
        );
        $mockSpecs = [];
        foreach ($mocksData as $oneMockData) {
            $oneMockSpec = $this->mockSpecPersistence->loadMockSpec($oneMockData);
            $mockSpecs[]= $oneMockSpec;
        }

        $constructorParameters = ArrayUtil::lookupValueByKey(
            self::CONSTRUCTOR_PARAM,
            $data,
            []
        );

        $oneSpec = new OneSpec(
            $testName,
            $result,
            $constructorParameters,
            $methodParameters,
            $mockSpecs
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
        $mockSpecs = $spec->getMockSpecs();

        $encoded = [
            self::TEST_NAME => $testName
        ];

        if ($mockSpecs) {
            $encodedMocks = [];
            foreach ($mockSpecs as $oneMock) {
                $oneEncodedMock = $this->mockSpecPersistence->encodeMockSpec($oneMock);
                if ($oneEncodedMock) {
                    $encodedMocks[] = $oneEncodedMock;
                }
            }
            if ($encodedMocks) {
                $encoded[self::MOCK] = $encodedMocks;
            }
        }

        if ($constructorParameters) {
            $encoded[self::CONSTRUCTOR_PARAM] = $constructorParameters;
        }

        $encoded[self::METHOD_PARAM] = $methodParameters;
        $encoded[self::RESULT_KEY] = $result;

        return $encoded;
    }
}
