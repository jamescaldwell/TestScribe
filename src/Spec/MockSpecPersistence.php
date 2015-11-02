<?php


namespace Box\TestScribe\Spec;

/**
 * Save and load mock objects.
 * @var InvocationSpecPersistence
 */
class MockSpecPersistence
{
    const NAME = 'name';
    const MOCKED_CLASS_NAME = 'mocked_class_name';
    const INVOCATION = 'invocation';

    /** @var InvocationSpecPersistence */
    private $invocationSpecPersistence;

    /**
     * @param InvocationSpecPersistence $invocationSpecPersistence
     */
    function __construct(
        InvocationSpecPersistence $invocationSpecPersistence
    )
    {
        $this->invocationSpecPersistence = $invocationSpecPersistence;
    }

    /**
     * @param array $data
     *
     * @return \Box\TestScribe\Spec\OneSpec
     */
    public function loadMockSpec($data)
    {
        $mockName = $data[self::NAME];
        $classNameBeingMocked = $data[self::MOCKED_CLASS_NAME];
        $callArray = $data[self::INVOCATION];
        $invocationArray = [];
        foreach($callArray as $invocation){
            $invocationArray[] =
                $this->invocationSpecPersistence->loadInvocationSpec(
                    $invocation
                );
        }
        $mockSpec = new MockSpec(
            $mockName,
            $classNameBeingMocked,
            $invocationArray
        );

        return $mockSpec;
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
            $callInfo =
                $this->invocationSpecPersistence->encodeInvocationSpec($invocation);
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
