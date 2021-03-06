<?php


namespace Box\TestScribe\Config;

use Box\TestScribe\Input\TestNameSelector;
use Box\TestScribe\Output;
use Box\TestScribe\Input\RawInputWithPrompt;
use Box\TestScribe\Spec\SpecsPerClass;


/**
 * @var RawInputWithPrompt|Output|TestNameSelector
 */
class OutputTestNameGetter
{
    /** @var RawInputWithPrompt */
    private $rawInputWithPrompt;

    /** @var Output */
    private $output;

    /** @var TestNameSelector */
    private $testNameSelector;

    /**
     * @param \Box\TestScribe\Input\RawInputWithPrompt $rawInputWithPrompt
     * @param \Box\TestScribe\Output $output
     * @param \Box\TestScribe\Input\TestNameSelector $testNameSelector
     */
    function __construct(
        RawInputWithPrompt $rawInputWithPrompt,
        Output $output,
        TestNameSelector $testNameSelector
    )
    {
        $this->rawInputWithPrompt = $rawInputWithPrompt;
        $this->output = $output;
        $this->testNameSelector = $testNameSelector;
    }

    /**
     * Get the name of the test to create.
     * Method has to begin with 'test'
     *
     * @param string $methodName
     * @param bool $useDefaultTestMethodName
     * @param \Box\TestScribe\Spec\SpecsPerClass $specPerClass
     *
     * @return string
     */
    public function getTestName(
        $methodName,
        $useDefaultTestMethodName,
        SpecsPerClass $specPerClass
    )
    {
        $specsPerMethod = $specPerClass->getSpecsPerMethodByName($methodName);
        $specs = $specsPerMethod->getSpecs();
        if ($specs) {
            $existingTestNames = array_keys($specs);

            $testMethodName =
                $this->testNameSelector->selectTestName($existingTestNames);
            if ($testMethodName !== '') {
                $msg = "Updating existing test ( $testMethodName ).";
                $this->output->writeln($msg);

                return $testMethodName;
            }
        }

        $testMethodNamePart = $methodName;

        if (!$useDefaultTestMethodName) {
            $message =
                "\nEnter the name of the test. It will be prefixed with 'test_'\n"
                . "Press enter to use the method name ( $methodName ) as the default.";

            $this->output->writeln($message);

            // rawInput is used instead of InputWithHelp so that
            // users don't have to quote the name as instructed by the help.
            $input = $this->rawInputWithPrompt->getString();
            if ($input !== '') {
                $testMethodNamePart = $input;
            }
        }

        $testMethodName = "test_$testMethodNamePart";

        return $testMethodName;
    }
}
