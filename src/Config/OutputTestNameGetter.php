<?php


namespace Box\TestScribe\Config;

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
        $testMethodNamePart = $methodName;

        if (!$useDefaultTestMethodName) {
            $message =
                "\nEnter the name of the test. It will be prefixed with 'test_'\n"
                ."Press enter to use the method name ( $methodName ) as the default.";

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
