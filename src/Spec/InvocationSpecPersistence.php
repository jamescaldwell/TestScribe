<?php


namespace Box\TestScribe\Spec;


/**
 */
class InvocationSpecPersistence
{
    const NAME = 'name';
    const RESULT_KEY = 'result';
    const METHOD_PARAM = 'param';

    /**
     * @param array $data
     *
     * @return \Box\TestScribe\Spec\InvocationSpec
     */
    public function loadInvocationSpec($data)
    {
        $methodName = $data[self::NAME];
        $params = $data[self::METHOD_PARAM];
        $returnValue = $data[self::RESULT_KEY];

        $spec = new InvocationSpec(
            $methodName,
            $params,
            $returnValue
        );

        return $spec;
    }

    /**
     * @param InvocationSpec $spec
     * @return array
     */
    public function encodeInvocationSpec(InvocationSpec $spec)
    {
        $methodName = $spec->getMethodName();
        $params = $spec->getParameters();
        $returnValue = $spec->getReturnValue();
        $callInfo = [
            self::NAME => $methodName,
            self::METHOD_PARAM => $params,
            self::RESULT_KEY => $returnValue,
        ];

        return $callInfo;
    }

}
