<?php


namespace Box\TestScribe\Spec;

/**
 * Save and load mock objects.
 */
class MockSpecPersistence
{
    const NAME = 'name';
    const MOCKED_CLASS_NAME = 'mocked_class_name';
    const INVOCATION = 'invocation';
    const RESULT_KEY = 'result';
    const METHOD_PARAM = 'param';

    /**
     * @param array $data
     *
     * @return \Box\TestScribe\Spec\OneSpec
     */
    public function loadMockSpec($data)
    {

    }

    /**
     * @param MockSpec $mockSpec
     * @return array
     */
    public function encodeMockSpec(MockSpec $mockSpec)
    {
        $calls = $mockSpec->getInvocations();
        $numOfCalls = count($calls);
        if (!$numOfCalls) {
            // If there is no call made to the mock object,
            // do not generate additional mock object descriptions.
            // The default is that the mock object is not used
            // if the description is missing.
            return [];
        }

        $callArray = [];
        foreach ($calls as $invocation) {
            $methodName = $invocation->getMethodName();
            $params = $invocation->getParameters();
            $returnValue = $invocation->getReturnValue();
            $callInfo = [
                self::NAME => $methodName,
                self::METHOD_PARAM => $params,
                self::RESULT_KEY => $returnValue,
            ];
            $callArray[] = $callInfo;
        }
        $mockName = $mockSpec->getObjectName();
        $classNameBeingMocked = $mockSpec->getMockedClassName();

        $encoded = [
            self::NAME => $mockName,
            self::MOCKED_CLASS_NAME => $classNameBeingMocked,
            self::INVOCATION => $callArray,
        ];

        return $encoded;
    }
}
