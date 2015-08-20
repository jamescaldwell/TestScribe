<?php
namespace Box\TestScribe\Spec;

/**
 */
class SpecsPerClassPersistenceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Box\TestScribe\Spec\SpecsPerClassPersistence::encodeSpecsPerClass
     * @covers \Box\TestScribe\Spec\SpecsPerClassPersistence
     */
    public function test_encodeSpecsPerClass()
    {
        // Setup mocks for parameters to the method under test.

        $testName = 'test1';
        $oneSpec = new OneSpec($testName, 1);

        $testSpecs = [$testName => $oneSpec];

        $methodName = 'method1';
        $specsPerMethod = new SpecsPerMethod($methodName, $testSpecs);

        $methodName2 = 'method2';
        $specsPerMethod2 = new SpecsPerMethod($methodName2, $testSpecs);

        $specs = [$methodName => $specsPerMethod, $methodName2 => $specsPerMethod2];
        $specsPerClass = new SpecsPerClass(
            'full_class_name',
            $specs
        );

        $specsPerMethodPersistence = new SpecsPerMethodPersistence(new OneSpecPersistence());

        $objectUnderTest = new \Box\TestScribe\Spec\SpecsPerClassPersistence($specsPerMethodPersistence);

        $executionResult = $objectUnderTest->encodeSpecsPerClass($specsPerClass);

        $expected =
            [
                'full class name' => 'full_class_name',
                'methods' => [
                    [
                        'name' => 'method1',
                        'tests' => [
                            ['name' => 'test1', 'result' => 1]
                        ]
                    ],
                    [
                        'name' => 'method2',
                        'tests' => [
                            ['name' => 'test1', 'result' => 1]
                        ]
                    ]
                ]
            ];

        $this->assertSame($expected, $executionResult);
    }

}
