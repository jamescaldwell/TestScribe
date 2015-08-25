<?php
namespace Box\TestScribe\Execution;

use Box\TestScribe\ArgumentInfo\Arguments;
use Box\TestScribe\ArgumentInfo\ArgumentsCollector;
use Box\TestScribe\Mock\MockClass;
use Box\TestScribe\Mock\MockObjectFactory;
use Box\TestScribe\Output;

/**
 * @var MockObjectFactory| ArgumentsCollector |Output|ExpectedExceptionCatcher
 */
class ClassUnderTestMockCreator
{
    /** @var MockObjectFactory */
    private $mockObjectFactory;

    /** @var ArgumentsCollector */
    private $argumentsCollector;

    /** @var Output */
    private $output;

    /** @var ExpectedExceptionCatcher */
    private $expectedExceptionCatcher;

    /**
     * @param \Box\TestScribe\Mock\MockObjectFactory $mockObjectFactory
     * @param \Box\TestScribe\ArgumentInfo\ArgumentsCollector $argumentsCollector
     * @param \Box\TestScribe\Output $output
     * @param \Box\TestScribe\Execution\ExpectedExceptionCatcher $expectedExceptionCatcher
     */
    function __construct(
        MockObjectFactory $mockObjectFactory,
        ArgumentsCollector $argumentsCollector,
        Output $output,
        ExpectedExceptionCatcher $expectedExceptionCatcher
    )
    {
        $this->mockObjectFactory = $mockObjectFactory;
        $this->argumentsCollector = $argumentsCollector;
        $this->output = $output;
        $this->expectedExceptionCatcher = $expectedExceptionCatcher;
    }

    /**
     * @param \Box\TestScribe\Mock\MockClass $mockClassUnderTest
     *
     * @return \Box\TestScribe\Execution\ClassUnderTestMockCreationResultValue
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
            $constructorArgValues = [];
        }

        $result = $this->expectedExceptionCatcher->execute(
            [
                $this->mockObjectFactory,
                'createMockObjectFromMockClass'
            ],
            [
                $mockClassUnderTest,
                $constructorArgValues
            ]
        );

        $mockObj = $result->getResult();
        $exception = $result->getException();

        if ($constructorMethodObj) {
            $this->output->writeln("\nFinish executing the constructor.\n");
        }

        $result = new ClassUnderTestMockCreationResultValue(
            $constructorArgs,
            $mockObj,
            $exception
        );

        return $result;
    }
}
