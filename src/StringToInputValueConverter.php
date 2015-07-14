<?php
/**
 *
 */

namespace Box\TestScribe;

/**
 * Handle converting an expression to an value and associated mock object information.
 *
 * @package Box\TestScribe
 */
class StringToInputValueConverter
{
    /**
     * @var StringToValueConverter
     */
    private $converter;

    /**
     * @var classNameInStringProcessor
     */
    private $classNameInStringProcessorService;

    /**
     * @var InputValueFactory
     */
    private $inputValueFactory;

    /**
     * @param \Box\TestScribe\StringToValueConverter     $converter
     * @param \Box\TestScribe\classNameInStringProcessor $classNameInStringProcessorService
     * @param \Box\TestScribe\InputValueFactory          $inputValueFactory
     */
    function __construct(
        StringToValueConverter $converter,
        classNameInStringProcessor $classNameInStringProcessorService,
        InputValueFactory $inputValueFactory
    )
    {
        $this->converter = $converter;
        $this->classNameInStringProcessorService = $classNameInStringProcessorService;
        $this->inputValueFactory = $inputValueFactory;
    }

    /**
     * Get a PHP value from user input
     *
     * @param string $expression the expression may contain reference to fully qualified class names.
     * 
     * e.g.
     * 
     * 1
     * 1.1
     * false
     * null
     * 'foo'
     * "foo"
     * [1, 2]
     * ['foo', 'bar']
     * ['a' => 1]
     * ['a' => [ 1, 2] ]
     * \Box\TestScribe\InputValue
     * ['a' => \Box\TestScribe\InputValue]
     *
     * @return \Box\TestScribe\InputValue
     */
    public function getValue($expression)
    {
        if ($expression === 'void') {
            $inputValue = $this->inputValueFactory->createVoid();
            
            return $inputValue;
        }
        
        $expressionWithMocks = $this->classNameInStringProcessorService->process($expression);
        $mocksDefinitions = [];
        $mocks = $expressionWithMocks->getMocks();
        foreach ($mocks as $mock) {
            $mockName = $mock->getMockObjectName();
            $mockedObj = $mock->getMockedDynamicClassObj();
            $mocksDefinitions[$mockName] = $mockedObj;
        }
        $processedExpression = $expressionWithMocks->getExpression();
        $value = $this->converter->convert($processedExpression, $mocksDefinitions);
        $inputValue = $this->inputValueFactory->createValue($value, $expressionWithMocks);

        return $inputValue;
    }
}
