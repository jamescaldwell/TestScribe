<?php
namespace Box\TestScribe;

use Box\TestScribe\Mock\MockClass;
use Box\TestScribe\Mock\MockObjectFactory;

/**
 * @var MockObjectFactory| ArgumentsCollector |Output
 */
class ClassUnderTestMockCreator
{
    /** @var MockObjectFactory */
    private $mockObjectFactory;

    /** @var ArgumentsCollector */
    private $argumentsCollector;

    /** @var Output */
    private $output;

    /**
     * @param \Box\TestScribe\Mock\MockObjectFactory  $mockObjectFactory
     * @param \Box\TestScribe\ArgumentsCollector $argumentsCollector
     * @param \Box\TestScribe\Output             $output
     */
    function __construct(
        MockObjectFactory $mockObjectFactory,
        ArgumentsCollector $argumentsCollector,
        Output $output
    )
    {
        $this->mockObjectFactory = $mockObjectFactory;
        $this->argumentsCollector = $argumentsCollector;
        $this->output = $output;
    }

    /**
     * @param \Box\TestScribe\Mock\MockClass $mockClassUnderTest
     *
     * @return \Box\TestScribe\ClassUnderTestMockCreationResultValue
     */
    public function createMockObjectForTheClassUnderTest(
        MockClass $mockClassUnderTest
    )
    {
        $constructorMethodObj = $mockClassUnderTest->getConstructorOfTheMockedClass();
        if ($constructorMethodObj) {
            $constructorArgs = $this->argumentsCollector->collect($constructorMethodObj);
            $constructorArgValues = $constructorArgs->getValues();
            $this->output->writeln("\nStart executing the constructor.\n");
        } else {
            // When the class under test doesn't have a constructor defined
            // don't display the constructor execution message.
            $constructorArgs = new Arguments([]);
            $constructorArgValues=[];
        }

        $mockObj = $this->mockObjectFactory->createMockObjectFromMockClass(
            $mockClassUnderTest,
            $constructorArgValues
        );

        if ($constructorMethodObj){
            $this->output->writeln("\nFinish executing the constructor.\n");
        }

        $result = new ClassUnderTestMockCreationResultValue($constructorArgs, $mockObj);

        return $result;
    }
}
