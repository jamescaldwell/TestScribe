<?php


namespace Box\TestScribe\_fixture\_input;

/**
 * Class TestMethodsProvider
 * @package Box\TestScribe\_fixture\_input
 */
class TestMethodsProvider
{
    /**
     * @return array
     */
    public static function getTestMethods()
    {
        return [
            // className, methodName, answerFileName
            ['StaticCalculator', 'add', 'calculatorAdd'],
            ['CalculatorFactoryUsage', 'calculateWithACalculator', 'calculateWithACalculator'],
            ['CalculatorViaLocator', 'calculateWithACalculator', 'CalculatorViaLocator'],
            ['StaticCalculatorViaLocator', 'calculateWithACalculator', 'StaticCalculatorViaLocator'],
            ['PartialMockingExample', 'calc', 'PartialMockingExample'],
            ['ExceptionInstance', 'throwException', 'ExceptionInstance']
        ];
    }
}
