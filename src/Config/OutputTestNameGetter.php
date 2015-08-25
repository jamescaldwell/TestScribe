<?php


namespace Box\TestScribe\Config;

use Box\TestScribe\Exception\TestScribeException;
use Box\TestScribe\Output;
use Box\TestScribe\Input\RawInputWithPrompt;


/**
 * @var RawInputWithPrompt|Output
 */
class OutputTestNameGetter
{
    /** @var RawInputWithPrompt */
    private $rawInputWithPrompt;

    /** @var Output */
    private $output;

    /**
     * @param \Box\TestScribe\Input\RawInputWithPrompt $rawInputWithPrompt
     * @param \Box\TestScribe\Output             $output
     */
    function __construct(
        RawInputWithPrompt $rawInputWithPrompt,
        Output $output
    )
    {
        $this->rawInputWithPrompt = $rawInputWithPrompt;
        $this->output = $output;
    }

    /**
     * Get the name of the test to create.
     * Method has to begin with 'test'
     *
     * @param string $methodName
     * @param bool   $useDefaultTestMethodName
     *
     * @throws \Box\TestScribe\Exception\TestScribeException
     * @return string
     */
    public function getTestName(
        $methodName,
        $useDefaultTestMethodName
    )
    {
        $defaultTestMethodName = "test_$methodName";

        if ($useDefaultTestMethodName) {
            return $defaultTestMethodName;
        }

        $message =
            "Enter the name of the test. Press enter to use the default test name ( $defaultTestMethodName ).";

        $this->output->writeln($message);

        // rawInput is used instead of InputWithHelp so that
        // users don't have to quote the name as instructed by the help.
        $input = $this->rawInputWithPrompt->getString($message);
        if ($input === '') {
            return $defaultTestMethodName;
        }
        if (0 !== strpos($input, 'test')) {
            $error =
                "Test method must begin with the string 'test'. Please try again.";
            throw new TestScribeException($error);
        }

        return $input;
    }
}
